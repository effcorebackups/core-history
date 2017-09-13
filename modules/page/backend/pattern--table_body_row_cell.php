<?php

  #############################################################
  ### Copyright © 2017 Maxim Rysevets. All rights reserved. ###
  #############################################################

namespace effectivecore {
          class table_body_row_cell extends \effectivecore\markup {

  public $tag_name = 'td';

  function __construct($attributes = [], $children = [], $weight = 0) {
    parent::__construct($this->tag_name, $attributes, $children, $weight);
  }

  function child_insert($child, $id = null) {
    if (is_string($child) || is_numeric($child)) return parent::child_insert(new text($child), $id);
    else                                         return parent::child_insert($child, $id);
  }

}}