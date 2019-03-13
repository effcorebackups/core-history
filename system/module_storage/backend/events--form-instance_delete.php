<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\storage {
          use \effcore\core;
          use \effcore\entity;
          use \effcore\instance;
          use \effcore\markup;
          use \effcore\message;
          use \effcore\page;
          use \effcore\text;
          use \effcore\url;
          abstract class events_form_instance_delete {

  static function on_init($form, $items) {
    $entity_name = page::current_get()->args_get('entity_name');
    $instance_id = page::current_get()->args_get('instance_id');
    $entity = entity::get($entity_name);
    if ($entity) {
      $id_keys   = $entity->real_id_get();
      $id_values = explode('+', $instance_id);
      if (count($id_keys) ==
          count($id_values)) {
        $instance = new instance($entity_name, array_combine($id_keys, $id_values));
        if ($instance->select()) {
          if (!empty($instance->is_embed)) core::send_header_and_exit('access_forbidden');
          $question = new markup('p', [], new text('Do you want to delete instance of entity "%%_entity_name" with id = "%%_instance_id"?', ['entity_name' => $entity_name, 'instance_id' => $instance_id]));
          $items['info']->child_insert($question);
        } else core::send_header_and_exit('page_not_found');
      }   else core::send_header_and_exit('page_not_found');
    }     else core::send_header_and_exit('page_not_found');
  }

  static function on_submit($form, $items) {
    $base        = page::current_get()->args_get('base');
    $entity_name = page::current_get()->args_get('entity_name');
    $instance_id = page::current_get()->args_get('instance_id');
    $entity = entity::get($entity_name);
    switch ($form->clicked_button->value_get()) {
      case 'delete':
        $id_keys   = $entity->real_id_get();
        $id_values = explode('+', $instance_id);
        $instance  = new instance($entity_name, array_combine($id_keys, $id_values));
        if ($instance->select() && $instance->delete())
             message::insert(new text('Instance of entity "%%_entity_name" with id = "%%_instance_id" was deleted.',     ['entity_name' => $entity_name, 'instance_id' => $instance_id]));
        else message::insert(new text('Instance of entity "%%_entity_name" with id = "%%_instance_id" was not deleted!', ['entity_name' => $entity_name, 'instance_id' => $instance_id]), 'error');
        url::go(url::back_url_get() ?: $base.'/select/'.$entity_name);
        break;
      case 'cancel':
        url::go(url::back_url_get() ?: $base.'/select/'.$entity_name);
        break;
    }
  }

}}