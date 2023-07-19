<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

#[\AllowDynamicProperties]

class Test_step_Repeat {

    public $id;
    public $quantity = 1;
    public $actions = [];

    function run(&$test, $dpath, &$c_results) {
        $quantity = $this->quantity instanceof Param_from_form ?
                    $this->quantity->get() :
                    $this->quantity;
        for ($i = 1; $i <= $quantity; $i++) {
            $c_results['reports'][$dpath.':'.$i]['dpath'] = '### dpath: '.$dpath.':'.$i;
            $c_results['reports'][$dpath.':'.$i][] = new Text('repeat %%_cur from %%_max', ['cur' => $i, 'max' => $quantity]);
            foreach ($this->actions as $c_dpath_in_cycle => $c_step) {
                if ($this->id) Token::insert('test_step_repeat_i_'.$this->id, 'text', $i, null, 'test');
                $c_step->run($test, $dpath.':'.$i.'/'.$c_dpath_in_cycle, $c_results);
                if (array_key_exists('return', $c_results)) {
                    return;
                }
            }
        }
    }

}
