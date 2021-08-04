<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class instance implements should_clear_cache_after_on_install {

  public $entity_name;
  public $values;
  public $_id_fields_original;

  function __construct($entity_name = '', $values = []) {
    $this->entity_set_name($entity_name);
    $this->values_set($values);
  }

  function __get  ($name)         {return       $this->values[$name];         }
  function __set  ($name, $value) {             $this->values[$name] = $value;}
  function __isset($name)         {return isset($this->values[$name]);        }

  function values_set($values) {$this->values = $values;}
  function values_get($names = []) {
    if (count($names)) {
      return array_intersect_key($this->values, core::array_kmap($names));
    } else {
      return $this->values;
    }
  }

  function values_id_get() {
    return $this->entity_get()->id_from_values_get($this->values_get());
  }

  function entity_get() {return entity::get($this->entity_name);}
  function entity_set_name($entity_name) {$this->entity_name = $entity_name;}

  function select() {
    event::start('on_instance_select_before', $this->entity_name, ['instance' => &$this]);
    $result = $this->entity_get()->storage_get()->instance_select($this);
    event::start('on_instance_select_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
    return $result;
  }

  function insert() {
    event::start('on_instance_insert_before', $this->entity_name, ['instance' => &$this]);
    if ($this->entity_get()->field_get('created') && empty($this->entity_get()->field_get('created')->managing_on_insert_is_enabled)) $this->created = core::datetime_get();
    if ($this->entity_get()->field_get('updated') && empty($this->entity_get()->field_get('updated')->managing_on_insert_is_enabled)) $this->updated = core::datetime_get();
    $result = $this->entity_get()->storage_get()->instance_insert($this);
    event::start('on_instance_insert_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
    return $result;
  }

  function update() {
    event::start('on_instance_update_before', $this->entity_name, ['instance' => &$this]);
    if ($this->entity_get()->field_get('updated') && empty($this->entity_get()->field_get('updated')->managing_on_update_is_enabled)) $this->updated = core::datetime_get();
    $result = $this->entity_get()->storage_get()->instance_update($this);
    event::start('on_instance_update_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
    return $result;
  }

  function delete() {
    event::start('on_instance_delete_before', $this->entity_name, ['instance' => &$this]);
    $result = $this->entity_get()->storage_get()->instance_delete($this);
    event::start('on_instance_delete_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
    return $result;
  }

  function make_url_for_select() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get());          }
  function make_url_for_update() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get()).'/update';}
  function make_url_for_delete() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get()).'/delete';}

  ###########################
  ### static declarations ###
  ###########################

  static protected $cache;
  static protected $cache_orig;

  static function cache_cleaning() {
    static::$cache      = null;
    static::$cache_orig = null;
  }

  static function init() {
    if (static::$cache === null) {
      static::$cache_orig = storage::get('files')->select('instances');
      foreach (static::$cache_orig ?? [] as $c_module_id => $c_instances) {
        foreach ($c_instances as $c_row_id => $c_instance) {
          if (isset(static::$cache[$c_row_id])) console::report_about_duplicate('instance', $c_row_id, $c_module_id);
                    static::$cache[$c_row_id] = $c_instance;
                    static::$cache[$c_row_id]->module_id = $c_module_id;
        }
      }
    }
  }

  static function get($row_id) {
    static::init();
    return static::$cache[$row_id] ?? null;
  }

  static function get_all_by_module($name) {
    static::init();
    return static::$cache_orig[$name] ?? [];
  }

}}