<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\core {
          use \effcore\core;
          use \effcore\fieldset;
          use \effcore\group_checkboxes;
          use \effcore\markup;
          use \effcore\message;
          use \effcore\module;
          use \effcore\storage;
          use \effcore\text;
          use \effcore\translation;
          abstract class events_form_modules_update {

  static function on_init($event, $form, $items) {
    $info = $form->child_select('info');
    $info->children_delete();
    $has_updates = false;
    $modules = module::get_all();
    core::array_sort_by_text_property($modules);
    foreach ($modules as $c_module) {
      $c_updates            = module::updates_get           ($c_module->id);
      $c_update_last_number = module::update_get_last_number($c_module->id);
      if (count($c_updates)) {
        $c_fieldset = new fieldset($c_module->title);
        $c_fieldset->state = 'closed';
        $c_checkboxes = new group_checkboxes;
        $c_checkboxes->build();
        $c_fieldset->child_insert($c_checkboxes, 'checkboxes');
        $info->child_insert($c_fieldset, $c_module->id);
        core::array_sort_by_property($c_updates, 'number');
        foreach ($c_updates as $c_update) {
          if ($c_update->number > $c_update_last_number == true) {$has_updates = true; $c_fieldset->state = 'opened';}
          if ($c_update->number > $c_update_last_number != true)
            $c_checkboxes->disabled[$c_update->number] =
                                    $c_update->number;
          $c_checkboxes->field_insert(
            $c_update->number.': '.translation::get($c_update->title),
            $c_update->description ?? null, ['name' => 'update_'.$c_module->id.'[]', 'value' => $c_update->number], $c_module->id.'-'.$c_update->number
          );
        }
      }
    }
    if ($info->children_select_count() == 0) {
      $form->child_update('info', new markup('x-no-items', [], 'no updates'));
      $items['~apply']->disabled_set();
    }
    if ($has_updates == false) {
      $items['~apply']->disabled_set();
    }
  }

  static function on_submit($event, $form, $items) {
    switch ($form->clicked_button->value_get()) {
      case 'apply':
        $has_selection = false;
        $modules = module::get_all();
        core::array_sort_by_text_property($modules);
        foreach ($modules as $c_module) {
          $c_updates            = module::updates_get           ($c_module->id);
          $c_update_last_number = module::update_get_last_number($c_module->id);
          if (count($c_updates)) {
            core::array_sort_by_property($c_updates, 'number', 'd');
            foreach ($c_updates as $c_update) {
              if ($c_update->number > $c_update_last_number) {
                if ($items['#update_'.$c_module->id.':'.$c_update->number]->checked_get()) {
                  $has_selection = true;
                  $c_result = call_user_func($c_update->handler, $c_update);
                  if ($c_result) {
                    storage::get('files')->changes_insert($c_module->id, 'update', 'settings/'.$c_module->id.'/update_last_number', $c_update->number);
                           message::insert(new text('Update #%%_number for module "%%_title" (%%_id) was applied.',     ['title' => translation::get($c_module->title), 'id' => $c_module->id, 'number' => $c_update->number])         );
                  } else { message::insert(new text('Update #%%_number for module "%%_title" (%%_id) was not applied!', ['title' => translation::get($c_module->title), 'id' => $c_module->id, 'number' => $c_update->number]), 'error');
                    break;
                  }
                }
              }
            }
          }
        }
        if (!$has_selection) {
          message::insert(
            'No one item was selected!', 'warning'
          );
        }
        static::on_init(null, $form, $items);
        break;
    }
  }

}}