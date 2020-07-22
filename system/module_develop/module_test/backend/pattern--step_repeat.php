<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class step_repeat {

  public $id;
  public $quantity = 1;
  public $actions = [];

  function run(&$test, &$c_scenario, &$c_results) {
    $quantity = $this->quantity instanceof param_from_form ?
                $this->quantity->get() :
                $this->quantity;
    for ($i = 1; $i <= $quantity; $i++) {
      $c_results['reports'][] = new text('repeat %%_cur from %%_max', ['cur' => $i, 'max' => $quantity]);
      foreach ($this->actions as $c_step) {
        if ($this->id) token::insert('test_step_repeat_i_'.$this->id,
                                  '%%_test_step_repeat_i_'.$this->id, 'text', $i, null, 'test');
        $c_step->run($test, $this->actions, $c_results);
        if (array_key_exists('return', $c_results)) {
          return;
        }
      }
    }
  }

}}