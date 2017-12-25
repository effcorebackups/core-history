<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effectivecore {
          class language {

  public $code;
  public $title;

  ######################
  ### static methods ###
  ######################

  static protected $cache;

  static function init() {
    foreach (storage::get('files')->select_group('languages') as $c_module_id => $c_module_languages) {
      foreach ($c_module_languages as $c_row_id => $c_language) {
        static::$cache[$c_language->code] = $c_language;
      }
    }
  }

  static function get($code) {
    if   (!static::$cache) static::init();
    return static::$cache[$code];
  }

}}