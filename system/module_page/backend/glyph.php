<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class glyph {

  static protected $cache;

  static function cache_cleaning() {
    static::$cache = null;
  }

  static function init() {
    if (!static::$cache) {
      foreach (storage::get('files')->select_array('glyphs') as $c_module_id => $c_items) {
        foreach ($c_items as $c_row_id => $c_item) {
          if (isset(static::$cache[$c_item->glyph])) console::report_about_duplicate('glyph', $c_item->glyph, $c_module_id, static::$cache[$c_item->glyph]);
                    static::$cache[$c_item->glyph] = (string)$c_item->character;
        }
      }
    }
  }

  static function get_all() {
    static::init();
    return static::$cache;
  }

  static function get_by_character($character) {
    static::init();
    $result = [];
    foreach (static::$cache as $c_glyph => $c_character) {
      if ((string)$c_character === (string)$character) {
        $result[$c_glyph] = $c_character;
      }
    }
    return $result;
  }

  static function get_sizes($glyph) {
    $width = 0;
    $rows = explode('|', $glyph);
    foreach ($rows as $c_row)
      $width = max($width, strlen($c_row));
    $result = new \stdClass;
    $result->width = $width;
    $result->height = count($rows);
    return $result;
  }

}}