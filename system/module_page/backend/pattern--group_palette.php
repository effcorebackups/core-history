<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class group_palette extends group_radiobuttons {

  public $title_tag_name = 'label';
  public $content_tag_name = 'x-group-content';
  public $required_any = true;
  public $attributes = [
    'data-type' => 'palette',
    'role'      => 'group'
  ];

  function build() {
    if (!$this->is_builded) {
    # the method 'parent::build' is not required here
      $previous_group_name = '';
      foreach (color::get_all() as $c_color) {
        if ($previous_group_name != '' &&
            $previous_group_name != $c_color->group) $this->child_insert(hr);
            $previous_group_name  = $c_color->group;
        $this->field_insert(null, null, [
          'value' => $c_color->id,
          'title' => translation::apply('color ID = "%%_id" and value = "%%_value"', ['id' => $c_color->id, 'value' => $c_color->value]),
          'style' => ['background: '.$c_color->value]
        ], $c_color->id);}
      $this->is_builded = true;
    }
  }

  function render_self() {
    if ($this->title && $this->title_is_visible == 0) return $this->render_opener().(new markup($this->title_tag_name, ['for' => 'f_opener_'.$this->name_get_complex(), 'aria-hidden' => 'true'], $this->title))->render();
    if ($this->title && $this->title_is_visible != 0) return $this->render_opener().(new markup($this->title_tag_name, ['for' => 'f_opener_'.$this->name_get_complex()                         ], $this->title))->render();
  }

  function render_opener() {
    $color_id    = $this->value_get();
    $color_value = color::get($color_id ?: 'white')->value;
    return (new markup_simple('input', [
      'type' => 'checkbox',
      'role' => 'button',
      'data-opener-type' => 'palette',
      'title' => new text('press to show or hide available colors'),
      'id' => 'f_opener_'.$this->name_get_complex(),
      'value' => $color_value,
      'style' => ['background: '.$color_value],
      'checked' => $this->has_error_in_container() ? false : true
    ]))->render();
  }

}}