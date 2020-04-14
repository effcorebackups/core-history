<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class field_switcher extends field_checkbox {

  public $title = null;
  public $title_position = 'bottom';
  public $attributes = ['data-type' => 'switcher'];
  public $element_attributes = [
    'data-type' => 'switcher',
    'type'      => 'checkbox',
    'name'      => 'checkbox',
    'value'     => 'on',
  ];

}}