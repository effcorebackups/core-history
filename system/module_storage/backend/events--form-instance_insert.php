<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\storage {
          use \effcore\complex_control;
          use \effcore\entity;
          use \effcore\field_checkbox;
          use \effcore\instance;
          use \effcore\markup;
          use \effcore\message;
          use \effcore\page;
          use \effcore\text;
          use \effcore\url;
          abstract class events_form_instance_insert {

  static function on_build($event, $form) {
    if (!$form->managing_group_id) $form->managing_group_id = page::get_current()->args_get('managing_group_id');
    if (!$form->entity_name      ) $form->entity_name       = page::get_current()->args_get('entity_name');
  }

  static function on_init($event, $form, $items) {
    if (isset($items['~insert_and_update']))
              $items['~insert_and_update']->disabled_set(true);
              $items['~insert'           ]->disabled_set(true);
    $entity = entity::get($form->entity_name);
    $groups = entity::get_managing_group_ids();
    if ($form->managing_group_id === null || isset($groups[$form->managing_group_id])) {
      if ($entity) {
        if ($entity->managing_is_enabled) {
          $form->attribute_insert('data-entity_name', $form->entity_name);
          $form->_instance = new instance($entity->name);
          foreach ($entity->fields as $c_name => $c_field) {
            if (!empty($c_field->managing_is_enabled_on_insert) &&
                 isset($c_field->managing_control_class)) {
              $c_control = new $c_field->managing_control_class;
              $c_control->title = $c_field->title;
              $c_control->element_attributes['name'] = $c_name;
              $c_control->element_attributes = ($c_field->managing_control_element_attributes           ?? []) + $c_control->element_attributes;
              $c_control->element_attributes = ($c_field->managing_control_element_attributes_on_insert ?? []) + $c_control->element_attributes;
              foreach ($c_field->managing_control_properties           ?? [] as $c_prop_name => $c_prop_value) $c_control->{$c_prop_name} = $c_prop_value;
              foreach ($c_field->managing_control_properties_on_insert ?? [] as $c_prop_name => $c_prop_value) $c_control->{$c_prop_name} = $c_prop_value;
              $c_control->cform = $form;
              $c_control->entity_name = $entity->name;
              $c_control->entity_field_name = $c_name;
              $c_control->build();
              $c_control->value_set_initial('', true);
              $items['fields']->child_insert($c_control, $c_name);
              if (isset($items['~insert_and_update']) && $items['~insert_and_update']->disabled_get() === true) $items['~insert_and_update']->disabled_set(false);
              if (isset($items['~insert'           ]) && $items['~insert'           ]->disabled_get() === true) $items['~insert'           ]->disabled_set(false);
            }
          }
          if ($items['fields']->children_select_count() === 0) {
            $form->child_update(
              'fields', new markup('x-no-items', ['data-style' => 'table'], 'no fields')
            );
          }
          if (empty($entity->has_button_insert_and_update)) {
            $form->child_delete('button_insert_and_update');
          }
          if (empty($entity->has_message_for_additional_controls) === false) {
            $form->child_select('fields')->child_insert(
              new markup('x-form-message', [], ['message' => new text(
                'Additional controls will become available after insertion (in update mode).')
              ], -500), 'form_message'
            );
          }
        } else {$items['fields']->child_insert(new markup('p', [], new text('management for this entity is not available')), 'error_message'); $form->has_error_on_init = true;}
      }   else {$items['fields']->child_insert(new markup('p', [], new text('wrong entity name'                          )), 'error_message'); $form->has_error_on_init = true;}
    }     else {$items['fields']->child_insert(new markup('p', [], new text('wrong management group'                     )), 'error_message'); $form->has_error_on_init = true;}
  }

  static function on_validate($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
        case 'insert_and_update':
        # preliminary definition of instance ID
          if (!$form->has_error()) {
            foreach ($entity->id_get() as $c_name) {
              if (isset($items['#'.$c_name])) {
                $c_value = $items['#'.$c_name]->value_get();
                if ($c_value) {
                  $form->_instance->{$c_name} = $c_value;
                } else return;
                } else return; }
            $form->instance_id = implode('+', $form->_instance->values_id_get());
            page::get_current()->args_set('instance_id', $form->instance_id);
          }
          break;
      }
    }
  }

  static function on_submit($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
        case 'insert_and_update':
          foreach ($entity->fields as $c_name => $c_field) {
            if (!empty($c_field->managing_is_enabled_on_insert) &&
                 isset($c_field->managing_control_class)) {
              $c_value = null;
              $c_reflection = new \ReflectionClass($c_field->managing_control_class);
              $c_prefix = $c_reflection->implementsInterface('\\effcore\\complex_control') ? '*' : '#';
              if     ($items[$c_prefix.$c_name] instanceof complex_control        ) $c_value = $items[$c_prefix.$c_name]->value_get_complex();
              elseif ($items[$c_prefix.$c_name] instanceof field_checkbox !== true) $c_value = $items[$c_prefix.$c_name]->value_get        ();
              elseif ($items[$c_prefix.$c_name] instanceof field_checkbox === true) $c_value = $items[$c_prefix.$c_name]->checked_get      () ? 1 : 0;
              if (!empty($c_field->managing_control_value_manual_get_if_empty) && $c_value === '') continue;
              if (!empty($c_field->managing_control_value_manual_get         )                   ) continue;
              $form->_instance->{$c_name} = $c_value;
            }
          }
        # insert action
          $form->_result = $form->_instance->insert();
        # show messages
          if ($form->is_show_result_message && $form->_result !== null) message::insert(new text('Item of type "%%_type" with ID = "%%_id" was inserted.',     ['type' => (new text($entity->title))->render(), 'id' => implode('+', $form->_instance->values_id_get()) ])           );
          if ($form->is_show_result_message && $form->_result === null) message::insert(new text('Item of type "%%_type" with ID = "%%_id" was not inserted!', ['type' => (new text($entity->title))->render(), 'id' => 'n/a'                                           ]), 'warning');
        # ↓↓↓ no break ↓↓↓
        case 'cancel':
          if ($form->is_redirect_enabled) {
            if ($form->clicked_button->value_get() === 'insert') url::go(url::back_url_get() ?: $entity->make_url_for_select_multiple());
            if ($form->clicked_button->value_get() === 'cancel') url::go(url::back_url_get() ?: $entity->make_url_for_select_multiple());
            if ($form->clicked_button->value_get() === 'insert_and_update') {
              if ($form->_result instanceof instance) {
                url::go($form->_result->make_url_for_update().'?'.url::back_part_make__custom($entity->make_url_for_select_multiple()));
              }
            }
          }
          break;
      }
    }
  }

}}