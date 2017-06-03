<?php

namespace effectivecore {
          use \effectivecore\translate_factory as translations;
          class text {

  public $text;
  public $weight;

  function __construct($text = '', $weight = 0) {
    $this->text = $text;
    $this->weight = $weight;
  }

  function render() {
    return translations::get($this->text);
  }

}}