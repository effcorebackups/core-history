<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class widget_selection_field_insert_old extends container {

  public $tag_name = 'x-widget';
  public $attributes = ['data-type' => 'insert'];
  public $on_button_click_insert_handler;

  function build() {
    if (!$this->is_builded) {
      $entities = entity::get_all();
      core::array_sort_by_text_property($entities);
      $options = ['not_selected' => '- no -'];
      foreach ($entities as $c_entity) {
        if (!empty($c_entity->managing_is_enabled)) {
          foreach ($c_entity->fields as $c_field_name => $c_field_info) {
            if (!empty($c_field_info->managing_on_select_is_enabled)) {
              if (!isset($options[$c_entity->name])) {
                         $options[$c_entity->name] = new \stdClass;
                         $options[$c_entity->name]->title = $c_entity->title;}
              $options[$c_entity->name]->values[$c_entity->name.'.'.$c_field_name] = new text_multiline([
                'title' => $c_field_info->title, 'id' => '('.$c_entity->name.'.'.$c_field_name.')'], [], ' '
              );
            }
          }
        }
      }
      $select = new field_select('Insert field');
      $select->values = $options;
      $select->build();
      $select->name_set('field_insert');
      $select->required_set(false);
      $button = new button(null, ['data-style' => 'narrow-insert', 'title' => new text('insert')]);
      $button->build();
      $button->value_set('button_field_insert');
      $this->child_insert($select, 'select');
      $this->child_insert($button, 'button');
      $this->is_builded = true;
    }
  }

  ###########################
  ### static declarations ###
  ###########################

  static function on_validate($group, $form, $npath) {
    $select = $group->child_select('select');
    $button = $group->child_select('button');
    if ($button->is_clicked() && !$select->value_get()) {
      $select->error_set(
        'Field "%%_title" must be selected!', ['title' => translation::get($select->title)]
      );
    } else {
      return true;
    }
  }

  static function on_submit(&$group, $form, $npath) {
    $select = $group->child_select('select');
    $button = $group->child_select('button');
    if ($button->is_clicked() && $select->value_get()) {
      if ($group->on_button_click_insert_handler) {
        return call_user_func($group->on_button_click_insert_handler, $group, $form, $npath, $select->value_get());
      }
    }
  }

}}