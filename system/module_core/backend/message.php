<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class message {

  static protected $cache;

  static function init() {
    static::$cache = [];
  }

  static function cache_cleaning() {
    static::$cache = null;
  }

  static function cleaning($id_session = null) {
    if ($id_session) $condition = ['id_!f'      => 'id_session', '=', 'id_!v'      => $id_session         ];
    else             $condition = ['expired_!f' => 'expired',    '<', 'expired_!v' => core::datetime_get()];
    $storage = storage::get(entity::get('message')->storage_name);
    $storage->query([
      'action' => 'DELETE',
      'target_begin' => 'FROM',
      'target_!t' => '~message',
      'condition_begin' => 'WHERE',
      'condition' => $condition
    ]);
  }

  static function select_all() {
    if    (static::$cache == null) static::init();
    return static::$cache;
  }

  static function select_from_storage() {
    $result = [];
    $instances = entity::get('message')->instances_select(['conditions' => [
      'id_!f'    => 'id_session',
      'operator' => '=',
      'id_!v'    => session::id_get()
    ]]);
    if (count($instances)) {
      foreach ($instances as $c_instance)
        $result[$c_instance->type][] = unserialize($c_instance->data);
      static::cleaning(
        session::id_get()
      );
    }
    return $result;
  }

  static function insert($message, $type = 'ok') {
    if (static::$cache == null) static::init();
    if (!isset(static::$cache[$type]))
               static::$cache[$type] = [];
    if (!in_array($message, static::$cache[$type]))
                            static::$cache[$type][] = $message;
  }

  static function insert_to_storage($message, $type = 'ok', $period = 30) {
    (new instance('message', [
      'id_session' => session::id_get(),
      'type'       => $type,
      'expired'    => core::datetime_get('+'.$period.' second'),
      'data'       => serialize($message)
    ]))->insert();
  }

  static function markup_get() {
    $messages = new markup('x-messages');
    foreach (static::select_all() as $c_type => $c_messages) {
      if (!$messages->child_select($c_type))
           $messages->child_insert(new markup('ul', ['class' => [$c_type => $c_type]]), $c_type);
      $c_grpoup = $messages->child_select($c_type);
      foreach ($c_messages as $c_message) {
        $c_grpoup->child_insert(
          new markup('li', [], $c_message)
        );
      }
    }
    return $messages->children_count() ?
           $messages : new node();
  }

}}