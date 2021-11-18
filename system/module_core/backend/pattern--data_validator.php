<?php

  ##################################################################
  ### Copyright © 2017—2022 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class data_validator implements has_external_cache {

  public $id;
  public $scenario;

  function validate($data) {
    $c_results = [];
    $c_results['errors'] = [];
    $c_results['trace_info'] = [];
    $c_results['parents_info'] = [];
    $c_results['break_nested'] = [];
    $c_results['break_global'] = false;
    $data_as_array = is_array($data) ? $data : [$data];
    $recursive_values = core::arrobj_select_values_recursive($data_as_array);
    foreach ($recursive_values as $c_dpath_value => $c_value) {
      if ($c_results['break_global'] === true) break;
      if ($c_results['break_nested'] && core::array_search__any_array_item_in_value($c_dpath_value,
          $c_results['break_nested'])) continue;
      $c_value_depth = count(explode('/', $c_dpath_value));
      $c_results['parents_info'][$c_value_depth] = $c_value;
      $c_results['parents_info'] = array_slice($c_results['parents_info'], 0, $c_value_depth, true);
      foreach ($this->scenario as $c_dpath_scenario => $c_step) {
        $c_step->run($this, $c_dpath_scenario, $c_dpath_value, $c_value, $c_results);
      }
    }
    return $c_results;
  }

  ###########################
  ### static declarations ###
  ###########################

  static protected $cache;

  static function not_external_properties_get() {
    return [
      'id' => 'id',
    ];
  }

  static function cache_cleaning() {
    static::$cache = null;
  }

  static function init() {
    if (static::$cache === null) {
      foreach (storage::get('data')->select_array('data_validators') as $c_module_id => $c_validators) {
        foreach ($c_validators as $c_row_id => $c_validator) {
          if (isset(static::$cache[$c_validator->id])) console::report_about_duplicate('data_validators', $c_validator->id, $c_module_id, static::$cache[$c_validator->id]);
                    static::$cache[$c_validator->id] = $c_validator;
                    static::$cache[$c_validator->id]->module_id = $c_module_id;
        }
      }
    }
  }

  static function get($id, $load = true) {
    static::init();
    if (isset(static::$cache[$id]) === false) return;
    if (static::$cache[$id] instanceof external_cache && $load)
        static::$cache[$id] =
        static::$cache[$id]->load_from_nosql_storage();
    return static::$cache[$id];
  }

  static function get_all($load = true) {
    static::init();
    if ($load)
      foreach (static::$cache as $id => $c_item)
           if (static::$cache[$id] instanceof external_cache)
               static::$cache[$id] =
               static::$cache[$id]->load_from_nosql_storage();
    return static::$cache;
  }

}}