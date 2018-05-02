<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class field_url extends field {

  public $title = 'URL';
  public $attributes = ['x-type' => 'url'];
  public $element_attributes_default = [
    'type'      => 'url',
    'name'      => 'url',
    'required'  => 'required',
    'minlength' => 5,
    'maxlength' => 255
  ];

}}