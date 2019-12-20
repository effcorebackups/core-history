<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\polls {
          use \effcore\core;
          use \effcore\entity;
          use \effcore\fieldset;
          use \effcore\instance;
          use \effcore\page;
          use \effcore\url;
          use \effcore\widget_poll_fields;
          abstract class events_form_instance_insert {

  static function on_init($event, $form, $items) {
    $entity_name = page::get_current()->args_get('entity_name');
    $entity = entity::get($entity_name);
    if ($entity) {
      if ($entity->name == 'poll') {
        page::get_current()->args_set('back_insert_is_canceled', true);
        if ($items['#expired']->value_get() == null)
            $items['#expired']->value_set(core::datetime_get('+'.core::date_period_w.' second'));
        $widget_answers = new widget_poll_fields;
        $widget_answers->unique_prefix = 'answer_';
        $widget_answers->form_current_set($form);
        $widget_answers->items_set_once([
          (object)['id' => 0, 'weight' =>  0, 'text' => 'Answer 1'],
          (object)['id' => 0, 'weight' => -5, 'text' => 'Answer 2']]);
        $widget_answers->build();
        $fieldset_answers = new fieldset('Answers');
        $fieldset_answers->child_insert($widget_answers, 'widget_answers');
        $form->child_select('fields')->child_insert($fieldset_answers, 'answers');
      }
    }
  }

  static function on_submit($event, $form, $items) {
    $back_insert_0 = page::get_current()->args_get('back_insert_0');
    $back_insert_n = page::get_current()->args_get('back_insert_n');
    $entity_name   = page::get_current()->args_get('entity_name'  );
    $entity = entity::get($entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'insert':
          if ($entity->name == 'poll' && !empty($form->_instance)) {
            $c_weight = 0;
            for ($i = 0; $i < 2; $i++) {
              $c_answer_text = $items['#answer_text_'.$i]->value_get();
              if ($c_answer_text) {
                (new instance('poll_answer', [
                  'id_poll' => $form->_instance->id,
                  'answer'  => $c_answer_text,
                  'weight'  => -($c_weight++ * 5)
                ]))->insert();
              }
            }
            url::go($back_insert_0 ?: (url::back_url_get() ?: (
                    $back_insert_n ?: '/manage/data/'.$entity->group_managing_get_id().'/'.$entity->name)));
          }
          break;
      }
    }
  }

}}