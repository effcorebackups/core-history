<?php

  #############################################################
  ### Copyright © 2017 Maxim Rysevets. All rights reserved. ###
  #############################################################

namespace effectivecore {
          use \effectivecore\messages_factory as messages;
          use \effectivecore\timers_factory as timers;
          use \effectivecore\console_factory as console;
          class storage_instance_pdo {

  public $id;
  public $connection;
  public $directory_name;
  public $host_name;
  public $user_name;
  public $password;
  public $driver;
  public $is_init = false;
  public $queries = [];

  function init() {
    if (empty($this->is_init)) {
      try {
        events::start('on_storage_init_before', 'pdo', [$this->id]);
        $this->connection = new \PDO($this->driver.':host='.
                                     $this->host_name.';dbname='.
                                     $this->directory_name,
                                     $this->user_name,
                                     $this->password);
        events::start('on_storage_init_after', 'pdo', [$this->id]);
        $this->is_init = true;
      } catch (\PDOException $e) {
        factory::send_header_and_exit('access_denided',
          'The PDO database "'.$this->id.'" is unavailable!'
        );
      }
    }
  }

  function transaction_begin()     {$this->$connection->beginTransaction();}
  function transaction_roll_back() {$this->$connection->rollBack();}
  function transaction_commit()    {$this->$connection->commit();}

  function query($query) {
    $this->queries[] = $query;
    events::start('on_query_before', 'pdo', [&$query]);
    $result = $this->connection->query($query);
    $errors = $this->connection->errorInfo();
    events::start('on_query_after', 'pdo', [$query, &$result, $errors]);
    if ($errors[0] != '00000') {
      messages::add_new(
        'Query error! '.br.
        'SQLSTATE: '.$errors[0].br.
        'Driver error code: '.$errors[1].br.
        'Driver error text: '.$errors[2], 'error'
      );
    }
    switch (substr($query, 0, 6)) {
      case 'SELECT': return $result ? $result->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\effectivecore\entity_instance') : null;
      case 'UPDATE': return $result->rowCount();
      case 'DELETE': return $result->rowCount();
      case 'INSERT': return $this->connection->lastInsertId();
    }
  }

  function install_entity($entity) {
    $this->init();
    $field_desc = [];
    foreach ($entity->get_fields_info() as $c_name => $c_info) {
      $c_properties = [$c_info->type.(isset($c_info->size) ? '('.$c_info->size.')' : '')];
      if (property_exists($c_info, 'unsigned')       && $c_info->unsigned)       $c_properties[] = 'unsigned';
      if (property_exists($c_info, 'auto_increment') && $c_info->auto_increment) $c_properties[] = 'auto_increment';
      if (property_exists($c_info, 'not_null')       && $c_info->not_null)       $c_properties[] = 'not null';
      if (property_exists($c_info, 'null')           && $c_info->null)           $c_properties[] = 'null';
      if (property_exists($c_info, 'default')) {
        if     ($c_info->default === 0)                   $c_properties[] = 'default 0';
        elseif ($c_info->default === null)                $c_properties[] = 'default null';
        elseif ($c_info->default === 'current_timestamp') $c_properties[] = 'default current_timestamp';
        else                                              $c_properties[] = 'default "'.$c_info->default.'"';
      }
      $field_desc[] = '`'.$c_name.'` '.implode(' ', $c_properties);
    }
    foreach ($entity->get_indexes_info() as $c_info) {
      $field_desc[] = $c_info->type.' (`'.implode('`, `', $c_info->fields).'`)';
    }
    $this->query(
      'CREATE TABLE `'.$entity->get_name().'` ('.implode(', ', $field_desc).') '.
      'default charset='.$entity->charset.';'
    );
  }

  function uninstall_entity($entity) {
    $this->init();
    $this->query('DROP TABLE `'.$entity->get_name().'`;');
  }

  function select_instance_set($entity, $conditions = [], $order = [], $count = 0, $offset = 0) {
    $this->init();
    $result = $this->query(
      'SELECT `'.implode('`, `', $entity->get_fields()).'` '.
      'FROM `'.$entity->get_name().'`'.
      (count($conditions) ? ' WHERE '.factory::data_to_attr($conditions, ' and ', '`') : '').
      (count($order)      ? ' ORDER BY `'.str_replace('!', ' DESC ', implode('`, `', $order)).'`' : '').
      ($count             ? ' LIMIT ' .$count  : '').
      ($offset            ? ' OFFSET '.$offset : '').';'
    );
    foreach ($result as $c_instance) {
      $c_instance->set_npath('entities/user/'.$entity->name); # @todo: make universal
    }
    return $result;
  }

  function select_instance($instance, $custom_ids = []) {
    $this->init();
    $result = $this->query(
      'SELECT `'.implode('`, `', $instance->get_fields()).'` '.
      'FROM `'.$instance->get_name().'` '.
      'WHERE '.factory::data_to_attr($instance->get_values($custom_ids ?: $instance->get_ids()), ' and ', '`').' '.
      'LIMIT 1;'
    );
    if (isset($result[0])) {
      $instance->values = $result[0]->values;
      return $instance;
    }
  }

  function insert_instance($instance) {
    $this->init();
    $result = $this->query(
      'INSERT INTO `'.$instance->get_name().'` (`'.implode('`, `', array_keys($instance->get_values())).'`) '.
      'VALUES ("'.implode('", "', $instance->get_values()).'");'
    );
    if (!empty($result) && count($instance->get_ids()) == 1) { # only for autoincrement field
      $id = $instance->get_ids()[0];
      $instance->values[$id] = $result;
      return $instance;
    }
  }

  function update_instance($instance) {
    $this->init();
    return $this->query(
      'UPDATE `'.$instance->get_name().'` '.
      'SET '.factory::data_to_attr($instance->get_values(), ', ', '`').' '.
      'WHERE '.factory::data_to_attr($instance->get_values($instance->get_ids()), ' and ', '`').';'
    );
  }

  function delete_instance($instance) {
    $this->init();
    $result = $this->query(
      'DELETE FROM `'.$instance->get_name().'` '.
      'WHERE '.factory::data_to_attr($instance->get_values($instance->get_ids()), ' and ', '`').';'
    );
    if ($result) {
      $instance->set_values([]);
      return $instance;
    }
  }

}}