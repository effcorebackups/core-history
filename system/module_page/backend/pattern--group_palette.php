<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class group_palette extends group_radiobuttons {

  public $title_tag_name = 'label';
  public $content_tag_name = 'x-group-content';
  public $attributes = [
    'data-type' => 'palette',
    'role'      => 'group'
  ];

  function build() {
    if (!$this->is_builded) {
    # the "parent::build()" is not required here
      $c_new_group_name = null;
      $c_old_group_name = null;
      foreach (color::get_all() as $c_color) {
            $c_new_group_name  = $c_color->group ?? null;
        if ($c_new_group_name != $c_old_group_name) $this->child_insert(hr);
            $c_old_group_name  = $c_new_group_name;
        $this->field_insert(null, null, [
          'value' => $c_color->id,
          'title' => translation::get('color id = "%%_id" and value = "%%_value"', ['id' => $c_color->id, 'value' => $c_color->value]),
          'style' => ['background: '.$c_color->value]
        ], $c_color->id);}
      $this->is_builded = true;
    }
  }

  function render_self() {
    if ($this->title) {
      return $this->render_opener().(new markup($this->title_tag_name, ['for' => 'f_opener_'.$this->name_get_first()], [$this->title]))->render();
    }
  }

  function render_opener() {
    $color_id    = $this->value_get();
    $color_value = color::get($color_id ?: 'white')->value;
    return (new markup_simple('input', [
      'type' => 'checkbox',
      'role' => 'button',
      'data-opener-type' => 'palette',
      'title' => new text('press to show or hide available colors'),
      'id' => 'f_opener_'.$this->name_get_first(),
      'value' => $color_value,
      'style' => ['background: '.$color_value],
      'checked' => true
    ]))->render();
  }

}}