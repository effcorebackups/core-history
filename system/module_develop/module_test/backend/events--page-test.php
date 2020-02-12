<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\test {
          use \effcore\core;
          use \effcore\page;
          use \effcore\tab_item;
          use \effcore\test;
          use \effcore\url;
          abstract class events_page_test {

  static function on_tab_build_before($event, $tab) {
    $id = page::get_current()->args_get('id');
    $tests = test::get_all(false);
    core::array_sort_by_text_property($tests);
    if (empty($tests[$id])) url::go(page::get_current()->args_get('base').'/'.reset($tests)->id);
    foreach ($tests as $c_test) {
      tab_item::insert($c_test->title,
        'test_execution_'.$c_test->id,
        'test_execution', 'tests', $c_test->id
      );
    }
  }

}}
