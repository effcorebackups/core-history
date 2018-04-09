<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class control_actions_list extends markup {

  public $title;
  public $tag_name = 'x-actions-control';
  public $actions = [];
  public $active = [];

  function __construct($title = 'actions', $attributes = [], $weight = 0) {
    $this->title = $title;
    parent::__construct($this->tag_name, $attributes, [], $weight);
  }

  function action_add($url, $title, $is_enabled = true) {
    if ($is_enabled) {
      $this->actions[$url] = $title;
    }
  }

  function render() {
    if ($this->title) $this->child_insert(new markup('x-title', [], $this->title), 'title');
    $this->child_insert(new markup('x-action-list'), 'action_list');
    $list = $this->child_select('action_list');
    foreach ($this->actions as $c_url => $c_action) {
      $c_attr = isset($this->active[$c_action]) ? ['class' => ['active']] : [];
      $list->child_insert(
        new markup('x-action', $c_attr,
          new markup('a', ['href' => $c_url], $c_action)
        )
      );
    }
    return parent::render();
  }

}}