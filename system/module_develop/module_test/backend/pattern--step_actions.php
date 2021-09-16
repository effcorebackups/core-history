<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class step_actions {

  function run(&$test, $dpath, &$c_results) {
    foreach ($this->actions as $c_row_id => $c_step) {
      $c_step->run($test, $dpath.'/'.$c_row_id, $c_results);
      if (array_key_exists('return', $c_results)) {
        return;
      }
    }
  }

}}