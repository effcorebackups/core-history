<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class table_body extends markup {

  public $tag_name = 'tbody';

  function __construct($attributes = [], $children = [], $weight = 0) {
    parent::__construct($this->tag_name, $attributes, $children, $weight);
  }

  function child_insert($child, $id = null) {
    if ($child instanceof table_body_row) return parent::child_insert($child, $id);
    if ($child instanceof instance)       return parent::child_insert(new table_body_row([], $child->get_values()), $id);
    if (is_array($child))                 return parent::child_insert(new table_body_row([], $child), $id);
  }

}}