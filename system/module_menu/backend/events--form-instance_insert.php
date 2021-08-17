<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\menu {
          use \effcore\entity;
          use \effcore\page;
          use \effcore\text_multiline;
          use \effcore\text;
          use \effcore\tree_item;
          use \effcore\tree;
          use \effcore\url;
          abstract class events_form_instance_insert {

  static function on_init($event, $form, $items) {
    if ($form->has_error_on_init === false) {
      if (!$form->category_id) $form->category_id = page::get_current()->args_get('category_id');
      $entity = entity::get($form->entity_name);
      if ($entity) {
      # field 'id_tree'
        if ($entity->name === 'tree_item') {
          $items['#id_tree']->value_set($form->category_id);
          $items['#id_parent']->is_builded = false;
          $items['#id_parent']->query_settings['conditions'] = ['id_tree_!f' => 'id_tree', 'operator' => '=', 'id_tree_!v' => $form->category_id];
          $items['#id_parent']->build();
        }
      }
    }
  }

  static function on_validate($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
        case 'insert_and_update':
          if ($entity->name === 'tree') {
          # field 'id' (check the uniqueness of SQL + NoSQL data)
            if ($items['#id']->value_get()) {
              if (tree::select($items['#id']->value_get())) {
                $items['#id']->error_set(new text_multiline([
                  'Field "%%_title" contains an error!',
                  'Previously used value was specified.',
                  'Only unique value is allowed.'], ['title' => (new text($items['#id']->title))->render() ]
                ));
              }
            }
          }
          if ($entity->name === 'tree_item') {
          # field 'id' (check the uniqueness of SQL + NoSQL data)
            if ($items['#id']->value_get()) {
              if (tree_item::select($items['#id']->value_get(), null)) {
                $items['#id']->error_set(new text_multiline([
                  'Field "%%_title" contains an error!',
                  'Previously used value was specified.',
                  'Only unique value is allowed.'], ['title' => (new text($items['#id']->title))->render() ]
                ));
              }
            }
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
        case 'cancel':
          if ($entity->name === 'tree_item') {
            if (!url::back_url_get()) {
              $id_tree = $items['#id_tree']->value_get();
              url::get_current()->query_arg_insert('back', $entity->make_url_for_select_multiple().'///'.$id_tree);
            }
          }
          break;
      }
    }
  }

}}