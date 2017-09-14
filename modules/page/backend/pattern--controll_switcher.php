<?php

  #############################################################
  ### Copyright © 2017 Maxim Rysevets. All rights reserved. ###
  #############################################################

namespace effectivecore {
          class control_switcher extends \effectivecore\markup {

  public $tag_name = 'x-switcher-control';
  public $state = 'off';

  function __construct($state = 'off', $attributes = [], $weight = 0) {
    $this->state = $state;
    parent::__construct(null, $attributes, [], $weight);
  }

  function render() {
    $this->attribute_insert('x-state', $this->state);
    $this->child_insert(
      new markup('a', ['href' => '?action='.($this->state == 'off' ? 'on' : 'off')],
      new markup('x-switcher'))
    );
    return parent::render();
  }

}}