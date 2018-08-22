<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\test {
          use \effcore\fieldset;
          use \effcore\markup;
          use \effcore\message;
          use \effcore\test;
          use \effcore\translation;
          abstract class events_form extends \effcore\events_form {

  ##################
  ### form: test ###
  ##################

  static function on_init_test($form, $items) {
    $items['#select_test']->option_insert('- select -', 'not_selected');
    if (!extension_loaded('curl')) {
      $items['#select_test']->disabled_set();
      $items['~run']->disabled_set();
      message::insert(
        translation::get('The PHP extension "%%_name" is not available!', ['name' => 'curl']), 'warning'
      );
    } else {
      $tests = test::all_get(false);
      foreach ($tests as $c_test) {
        $items['#select_test']->option_insert($c_test->title, $c_test->id);
      }
    }
  }

  static function on_submit_test($form, $items) {
    $test_id = $items['#select_test']->value_get();
    if ($test_id) {
      $test = test::get($test_id);
      $test_result = $test->run();
    # show message
      if (!empty($test_result['return']))
           message::insert('The test was successful.');
      else message::insert('The test was failed!', 'error');
    # make report
      if (!empty($test_result['reports'])) {
        $report = new markup('x-document', ['class' => ['report' => 'report']]);
        $report_wrapper = new fieldset('Report', '', [], $report);
        $items['test']->child_insert($report_wrapper);
        foreach ($test_result['reports'] as $c_report) {
          $report->child_insert(
            new markup('p', [], $c_report)
          );
        }
      }
    }
  }

}}