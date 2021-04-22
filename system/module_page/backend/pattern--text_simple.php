<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class text_simple {

  public $text = '';
  public $weight = 0;

  function __construct($text = '', $weight = 0) {
    if ($text !== '') $this->text_update($text);
    $this->weight = $weight;
  }

  function text_length() {return strlen($this->render());}
  function text_select() {return $this->text;}
  function text_update($new_text) {$this->text = $new_text;}
  function text_append($new_text) {$this->text.= $new_text;}

  function render() {
    return $this->text;
  }

}}