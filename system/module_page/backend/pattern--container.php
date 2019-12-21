<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class container extends markup {

  public $tag_name = 'x-container';
  public $template = 'container';
# ─────────────────────────────────────────────────────────────────────
  public $title;
  public $title_tag_name = 'x-title';
  public $title_position = 'top';
  public $content_tag_name;
  public $description;
  public $description_tag_name = 'x-description';
  public $description_position = 'bottom';
  public $cform;

  function __construct($tag_name = null, $title = null, $description = null, $attributes = [], $children = [], $weight = 0) {
    if ($title !== null) $this->title       = $title;
    if ($description   ) $this->description = $description;
    parent::__construct($tag_name, $attributes, $children, $weight);
  }

  function form_current_set($form) {
    $this->cform = $form;
  }

  function render() {
    $is_bottom_title    = !empty($this->title_position)       && $this->title_position       == 'bottom';
    $is_top_description = !empty($this->description_position) && $this->description_position == 'top';
    return (template::make_new($this->template, [
      'tag_name'      => $this->tag_name,
      'attributes'    => $this->render_attributes(),
      'self_t'        => $is_bottom_title    ? '' : $this->render_self(),
      'self_b'        => $is_bottom_title    ?      $this->render_self()        : '',
      'description_t' => $is_top_description ?      $this->render_description() : '',
      'description_b' => $is_top_description ? '' : $this->render_description(),
      'children'      => $this->content_tag_name ? (new markup($this->content_tag_name, [],
                         $this->render_children($this->children_select(true)) ))->render() :
                         $this->render_children($this->children_select(true))
    ]))->render();
  }

  function render_self() {
    if ($this->title) {
      return (new markup($this->title_tag_name, ['data-mark-required' => $this->attribute_select('required') ? 'true' : null],
        $this->title
      ))->render();
    }
  }

  # ─────────────────────────────────────────────────────────────────────
  # functionality for errors
  # ─────────────────────────────────────────────────────────────────────

  function has_error() {
    foreach ($this->children_select_recursive() as $c_child) {
      if ($c_child instanceof container &&
          $c_child->has_error()) {
        return true;
      }
    }
  }

}}