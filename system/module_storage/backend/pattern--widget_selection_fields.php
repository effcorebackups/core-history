<?php

  ##################################################################
  ### Copyright © 2017—2022 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class widget_selection_fields extends widget_items {

  public $title = 'Fields';
  public $title__not_selected__widget_insert = '- select -';
  public $item_title = 'Field';
  public $attributes = ['data-type' => 'items-entity_fields'];
  public $name_complex = 'widget_selection_fields';
  public $main_entity_name = null;

  function value_get($options = []) { # return: array | serialize(array)
    $value_external = [];
    $value_internal = $this->items_get();
    foreach ($value_internal as $c_row_id => $c_item) {
      if ($c_item->type === 'main') {
        $value_external['main'][$c_row_id] = new \stdClass;
        $value_external['main'][$c_row_id]->title                 =       $c_item->title;
        $value_external['main'][$c_row_id]->entity_field_name     =       $c_item->entity_field_name;
        $value_external['main'][$c_row_id]->weight                =       $c_item->weight;
        $value_external['main'][$c_row_id]->is_apply_translation  = empty($c_item->value_settings['is_apply_translation']) ? false : true;
        $value_external['main'][$c_row_id]->is_apply_tokens       = empty($c_item->value_settings['is_apply_tokens'])      ? false : true;
        $value_external['main'][$c_row_id]->is_trimmed            = empty($c_item->value_settings['is_trimmed'])           ? false : true;
        $value_external['main'][$c_row_id]->is_not_formatted      = empty($c_item->value_settings['is_not_formatted'])     ? false : true;
        $value_external['main'][$c_row_id]->is_not_visible        = empty($c_item->value_settings['is_not_visible'])       ? false : true;
      }
    }
    if (!empty($options['return_serialized']))
         return serialize($value_external);
    else return           $value_external;
  }

  function value_set($value, $options = []) {
    $this->value_set_initial($value);
    if (core::data_is_serialized($value)) $value = unserialize($value);
    if ($value === null) $value = [];
    if ($value ===  '' ) $value = [];
    if (is_array($value)) {
      $value_internal = [];
      if (!empty($value['main']) && is_array($value['main'])) {
        foreach ($value['main'] as $c_row_id => $c_value) {
          $value_internal[$c_row_id] = new \stdClass;
          $value_internal[$c_row_id]->type              = 'main';
          $value_internal[$c_row_id]->entity_name       = $this->main_entity_name;
          $value_internal[$c_row_id]->entity_field_name = $c_value->entity_field_name;
          $value_internal[$c_row_id]->title             = $c_value->title ?? null;
          $value_internal[$c_row_id]->weight            = $c_value->weight ?? 0;
          if (!empty($c_value->is_apply_translation)) $value_internal[$c_row_id]->value_settings['is_apply_translation'] = 'is_apply_translation';
          if (!empty($c_value->is_apply_tokens     )) $value_internal[$c_row_id]->value_settings['is_apply_tokens']      = 'is_apply_tokens';
          if (!empty($c_value->is_trimmed          )) $value_internal[$c_row_id]->value_settings['is_trimmed']           = 'is_trimmed';
          if (!empty($c_value->is_not_formatted    )) $value_internal[$c_row_id]->value_settings['is_not_formatted']     = 'is_not_formatted';
          if (!empty($c_value->is_not_visible      )) $value_internal[$c_row_id]->value_settings['is_not_visible']       = 'is_not_visible';
        }
      }
      $this->items_set($value_internal, !empty($options['once']));
    }
  }

  ###########################
  ### static declarations ###
  ###########################

  static function widget_manage_get($widget, $item, $c_row_id) {
    $result = parent::widget_manage_get($widget, $item, $c_row_id);
  # info markup
    $entity = entity::get($item->entity_name);
    $entity_field = $entity ? $entity->field_get($item->entity_field_name) : null;
    $title_markup = isset($entity_field->title) ?
                         [$entity      ->title, ': ',
                          $entity_field->title] : 'LOST FIELD';
    $info_markup = new markup('x-info',  [], [
        'title' => new markup('x-title', [], $title_markup),
        'id'    => new markup('x-id',    [], 'row_id: '.$c_row_id) ]);
  # create widget_settings
    $widget_settings = new widget_selection_field_settings($widget, $item, $c_row_id);
    $widget_settings->build();
  # grouping of previous elements in widget 'manage'
    $result->child_insert($info_markup, 'info');
    $result->child_insert($widget_settings, 'settings');
    return $result;
  }

  static function widget_insert_get($widget) {
    $result = new markup('x-widget', ['data-type' => 'insert']);
  # control with type of new item
    $disabled_items = [];
    $entities = entity::get_all();
    foreach ($entities as $c_entity) {
      if (!empty($c_entity->managing_is_enabled)) {
        foreach ($c_entity->fields as $c_field_name => $c_field_info) {
          if ($widget->main_entity_name !== $c_entity->name) {
            $disabled_items[$c_entity->name.'|'.$c_field_name] =
                            $c_entity->name.'|'.$c_field_name; }}}}
    $field_select_entity_field_name = new field_select_entity_field_name('New field');
    $field_select_entity_field_name->title__not_selected = $widget->title__not_selected__widget_insert;
    $field_select_entity_field_name->cform = $widget->cform;
    $field_select_entity_field_name->disabled = $disabled_items;
    $field_select_entity_field_name->build();
    $field_select_entity_field_name->name_set($widget->name_get_complex().'__insert');
    $field_select_entity_field_name->required_set(false);
  # button for insertion of the new item
    $button_insert = new button(null, ['data-style' => 'insert', 'title' => new text('insert')]);
    $button_insert->break_on_validate = true;
    $button_insert->build();
    $button_insert->value_set($widget->name_get_complex().'__insert');
    $button_insert->_type = 'insert';
  # relate new controls with the widget
    $widget->controls['#insert'] = $field_select_entity_field_name;
    $widget->controls['~insert'] = $button_insert;
    $result->child_insert($field_select_entity_field_name, 'field_select_entity_field_name');
    $result->child_insert($button_insert, 'button_insert');
    return $result;
  }

  # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

  static function on_button_click_insert($widget, $form, $npath, $button) {
    $widget->controls['#insert']->required_set(true);
    $result_validation = field_select::on_validate($widget->controls['#insert'], $form, $npath);
    $widget->controls['#insert']->required_set(false);
    if ($result_validation) {
      $params = explode('|', $widget->controls['#insert']->value_get());
      if ($params[0] === $widget->main_entity_name) { # main entity
        $min_weight = 0;
        $items = $widget->items_get();
        foreach ($items as $c_row_id => $c_item)
          $min_weight = min($min_weight, $c_item->weight);
        $new_item = new \stdClass;
        $new_item->weight = count($items) ? $min_weight - 5 : 0;
        $new_item->type              = 'main';
        $new_item->entity_name       = $params[0];
        $new_item->entity_field_name = $params[1];
        $entity = entity::get($new_item->entity_name);
        if ($entity && isset($entity->fields[$new_item->entity_field_name])) {
          $new_item->title = $entity->fields[$new_item->entity_field_name]->title;
        }
        if (array_key_exists($params[1], $items))
               $new_row_id = $params[1].core::number_part_get($params[1], array_keys($items));
        else   $new_row_id = $params[1];
        $items[$new_row_id] = $new_item;
      }
      $widget->items_set($items);
      $widget->controls['#insert']->value_set('');
      message::insert(new text_multiline([
        'Item of type "%%_type" was inserted.',
        'Do not forget to save the changes!'], [
        'type' => (new text($widget->item_title))->render() ]));
      return true;
    }
  }

}}
