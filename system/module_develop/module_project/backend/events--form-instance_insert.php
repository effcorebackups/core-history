<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\project {
          use \effcore\entity;
          use \effcore\text_multiline;
          use \effcore\text;
          abstract class events_form_instance_insert {

  static function on_validate($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
        case 'insert_and_update':
          if ($entity->name === 'release' && !$form->has_error()) {
          # field 'id_project' + field 'build'
            $id_project = $items['#id_project']->value_get();
            $build      = $items['#build'     ]->value_get();
            $result = $entity->instances_select(['conditions' => [
              'id_project_!f'       => 'id_project',
              'id_project_operator' => '=',
              'id_project_!v'       => $id_project,
              'conjunction'         => 'and',
              'build_!f'            => 'build',
              'build_operator'      => '=',
              'build!v'             => $build], 'limit' => 1]);
            if ($result) {
              $items['#id_project']->error_set();
              $items['#build']->error_set(new text_multiline([
                'Field "%%_title" contains an error!',
                'This combination of values is already in use!'], ['title' => (new text($items['#build']->title))->render() ]
              ));
            }
          }
          break;
      }
    }
  }

}}