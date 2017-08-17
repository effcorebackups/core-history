<?php

  #############################################################
  ### Copyright © 2017 Maxim Rysevets. All rights reserved. ###
  #############################################################

namespace effectivecore\modules\user {
          use \effectivecore\entities_factory as entities;
          use \effectivecore\entity_instance as entity_instance;
          abstract class user_factory {

  static $data;

  static function init($id = 0) {
    static::$data = new \stdClass();
    static::$data->id = 0;
    static::$data->roles = ['anonymous' => 'anonymous'];
  # load user from db
    if ($id) {
      $user = (new entity_instance('entities/user/user', ['id' => $id]))->select();
      if ($user) {
        static::$data = (object)($user->get_values());
        static::$data->roles = ['registered' => 'registered'];
        foreach (entities::get('relation_role_ws_user')->select_set(['user_id' => $id]) as $c_role) {
          static::$data->roles[$c_role->role_id] = $c_role->role_id;
        }
      }
    }
  }

  static function get_current() {
    if (!static::$data) static::init();
    return static::$data;
  }

}}