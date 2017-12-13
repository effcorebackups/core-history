<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effectivecore {
          use \effectivecore\url as url;
          use \effectivecore\token as token;
          use \effectivecore\translation as translation;
          use \effectivecore\modules\user\access as access;
          class tree_item extends \effectivecore\node {

  public $id;
  public $id_parent;
  public $parent_is_tree;
  public $title = '';
  public $template = 'tree_item';
  public $template_children = 'tree_item_children';

  function __construct($title = '', $attributes = [], $children = [], $weight = 0) {
    if ($title) $this->title = $title;
    parent::__construct($attributes, $children, $weight);
  }

  function render() {
    if (!isset($this->access) ||
        (isset($this->access) && access::check($this->access))) {
      $rendered_children = count($this->children) ? (new template($this->template_children, [
        'children' => $this->render_children($this->children)]
      ))->render() : '';
      return (new template($this->template, [
        'self'     => $this->render_self(),
        'children' => $rendered_children
      ]))->render();
    }
  }

  function render_self() {
    $href = $this->attribute_select('href');
    if ($href) {
      $href = token::replace($href);
      $this->attribute_insert('href', $href);
      if (url::is_active($href)) {
        $this->attribute_insert('class', ['active' => 'active']);
      }
    }
    return (new markup('a', $this->attribute_select(),
      token::replace(translation::get($this->title))
    ))->render();
  }

}}