<?php

namespace effectivecore {
          use \effectivecore\url_factory as urls;
          use \effectivecore\token_factory as tokens;
          use \effectivecore\translate_factory as translations;
          use \effectivecore\modules\user\access_factory as access;
          class tree_item extends \effectivecore\node {

  public $title;

  function __construct($title = '', $attributes = null, $children = null, $weight = 0) {
    parent::__construct($attributes, $children, $weight);
    $this->title = $title;
  }

  function render() {
    if (!isset($this->access) ||
        (isset($this->access) && access::check($this->access))) {
      $rendered_children = '';
      if (count($this->children)) {
        $rendered_children = (new template('tree_item_children', [
          'children' => $this->render_children($this->children)
        ]))->render();
      }
      return (new template('tree_item', [
        'self'     => $this->render_self(),
        'children' => $rendered_children
      ]))->render();
    }
  }

  function render_self() {
    $attr = clone $this->attributes;
    if (isset($attr->href)) {
      $attr->href = tokens::replace($attr->href);
      if (urls::is_active($attr->href)) {
        $attr->class = isset($attr->class) ? $attr->class.' active' : 'active';
      }
    }
    return (new template('tree_item_self', [
      'attributes' => factory::data_to_attr($attr, ' '),
      'title'      => tokens::replace(translations::get($this->title))
    ]))->render();
  }

}}