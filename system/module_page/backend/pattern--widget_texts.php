<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class widget_texts extends widget_items {

  public $attributes = ['data-type' => 'items'];
  public $name_complex = 'widget_texts';

  ###########################
  ### static declarations ###
  ###########################

  static function widget_manage_get(&$widget, $item, $c_row_id) {
    $result = parent::widget_manage_get($widget, $item, $c_row_id);
  # control for text
    $field_text = new field_text;
    $field_text->description_state = 'hidden';
    $field_text->cform = $widget->cform;
    $field_text->build();
    $field_text->name_set($widget->name_get_complex().'__text__'.$c_row_id);
    $field_text->value_set($item->text ?? '');
  # relate new controls with the widget
    $widget->controls['#text__'.$c_row_id] = $field_text;
    $result->child_insert($field_text, 'text');
    return $result;
  }

  # ─────────────────────────────────────────────────────────────────────

  static function on_button_click_insert(&$widget, $form, $npath, $button) {
    $min_weight = 0;
    $items = $widget->items_get();
    foreach ($items as $c_row_id => $c_item)
      $min_weight = min($min_weight, $c_item->weight);
    $new_item = new \stdClass;
    $new_item->weight = count($items) ? $min_weight - 5 : 0;
    $new_item->text = '';
    $items[] = $new_item;
    $new_item->id = core::array_key_last($items);
    $widget->items_set($items);
    message::insert(new text_multiline([
      'Item of type "%%_type" was inserted.',
      'Do not forget to save the changes!'], [
      'type' => (new text($widget->item_title))->render() ]));
    return true;
  }

  static function on_request_value_set(&$widget, $form, $npath) {
    $items = $widget->items_get();
    foreach ($items as $c_row_id => $c_item) {
      if (isset($widget->controls['#weight__'.$c_row_id])) $c_item->weight = (int)$widget->controls['#weight__'.$c_row_id]->value_get();
      if (isset($widget->controls['#text__'.  $c_row_id])) $c_item->text   =      $widget->controls['#text__'.  $c_row_id]->value_get(); }
    $widget->items_set($items);
  }

}}