<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class storage {

  static protected $cache;

  static function cache_cleaning() {
    static::$cache = null;
  }

  static function init($name) {
    if (!isset(static::$cache[$name])) {
      storage_nosql_files::init('storages');
      foreach (storage_nosql_files::$data['storages'] as $c_module_id => $c_module_storages) {
        foreach ($c_module_storages as $c_row_id => $c_storage) {
          if ($c_storage->name == $name) {
            static::$cache[$c_storage->name] = $c_storage;
          }
        }
      }
    }
  }

  static function get($name, $load = true) {
    static::init($name);
    if (isset(static::$cache[$name]) == false) return;
    if (static::$cache[$name] instanceof external_cache && $load)
        static::$cache[$name] =
        static::$cache[$name]->external_cache_load();
    return static::$cache[$name];
  }

}}