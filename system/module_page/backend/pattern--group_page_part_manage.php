<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class group_page_part_manage extends fieldset {

  public $tag_name = 'x-part-manage';
  public $content_tag_name = null;
  public $id_area;
  public $id_preset;

  function build() {
    if (!$this->is_builded) {
      parent::build();
      $preset = page_part_preset::select($this->id_preset);
      $button_delete = new button('', ['data-style' => 'narrow-delete']);
      $button_delete->build();
      $button_delete->value_set('button_delete_'.$this->id_preset.'_in_'.$this->id_area);
      $this->child_insert($button_delete, 'button_delete');
      $this->child_insert(new markup('x-title', [], $preset->managing_title ?? 'LOST PART'), 'title');
      $this->child_insert(new markup('x-id',    [], new text_simple($this->id_preset)     ), 'id'   );
      $this->is_builded = true;
    }
  }

  ###########################
  ### static declarations ###
  ###########################

  static function submit(&$group, $form, $npath) {
    $button = $group->child_select('button_delete');
    if ($button->is_clicked()) {
      return (object)[
        'id_area'   => $group->id_area,
        'id_preset' => $group->id_preset];
    }
  }

}}