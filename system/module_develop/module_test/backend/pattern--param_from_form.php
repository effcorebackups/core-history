<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class param_from_form {

  public $name;

  function get() {
    if ($this->name) {
      return field::request_value_get($this->name);
    }
  }

}}