<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\menu {
          use \effcore\entity;
          use \effcore\page;
          use \effcore\text_multiline;
          use \effcore\translation;
          use \effcore\tree_item;
          use \effcore\tree;
          abstract class events_form_instance_insert {

  static function on_init($event, $form, $items) {
    if (!isset($form->category_id)) $form->category_id = page::get_current()->args_get('category_id');
    $entity = entity::get($form->entity_name);
    if ($entity) {
    # field 'id_tree'
      if ($entity->name == 'tree_item') {
        $items['#id_tree']->value_set(
          tree::select($form->category_id) ?
                       $form->category_id : null
        );
      }
    }
  }

  static function on_validate($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
        # field 'id'
          if ($entity->name == 'tree') {
            if ($items['#id']->value_get()) {
              if (tree::select($items['#id']->value_get())) {
                $items['#id']->error_set(new text_multiline([
                  'Field "%%_title" contains the previously used value!',
                  'Only unique value is allowed.'], ['title' => translation::get($items['#id']->title)]
                ));
              }
            }
          }
        # field 'id'
          if ($entity->name == 'tree_item') {
            if ($items['#id']->value_get()) {
              if (tree_item::select($items['#id']->value_get(), null)) {
                $items['#id']->error_set(new text_multiline([
                  'Field "%%_title" contains the previously used value!',
                  'Only unique value is allowed.'], ['title' => translation::get($items['#id']->title)]
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
          if ($entity->name == 'tree_item') {
            $id_tree = $items['#id_tree']->value_get();
            page::get_current()->args_set('back_insert_0', '/manage/data/'.$entity->group_managing_get_id().'/'.$entity->name.'///'.$id_tree);
          }
          break;
      }
    }
  }

}}