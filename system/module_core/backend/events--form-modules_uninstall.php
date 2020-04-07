<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\core {
          use \effcore\cache;
          use \effcore\core;
          use \effcore\event;
          use \effcore\group_checkboxes;
          use \effcore\markup;
          use \effcore\message;
          use \effcore\module;
          use \effcore\text;
          use \effcore\translation;
          abstract class events_form_modules_uninstall {

  static function on_init($event, $form, $items) {
    $info = $form->child_select('info');
    $installed = module::get_installed();
    $enabled   = module::get_enabled  ();
    $embed     = module::get_embed    ();
    $modules   = module::get_all      ();
    $checkboxes = new group_checkboxes;
    $checkboxes->description = 'The removing module must be disabled at first. Embed modules cannot be disabled.';
    $checkboxes->build();
    core::array_sort_by_text_property($modules);
    foreach ($modules as $c_module) {
      if  (!isset($embed    [$c_module->id]) &&
            isset($installed[$c_module->id])) {
        if (isset($enabled  [$c_module->id]))
        $checkboxes->disabled[$c_module->id] = $c_module->id;
        $checkboxes->field_insert(
          $c_module->title, null, ['name' => 'uninstall[]', 'value' => $c_module->id], $c_module->id
        );
      }
    }
    if ($checkboxes->children_select_count())
         $info->child_insert($checkboxes, 'checkboxes');
    else $form->child_update('info', new markup('x-no-items', ['data-style' => 'table'], 'no modules'));
    if (count($checkboxes->disabled) ==
              $checkboxes->children_select_count()) {
      $items['~apply']->disabled_set();
    }
  }

  static function on_validate($event, $form, $items) {
    switch ($form->clicked_button->value_get()) {
      case 'apply':
        $embed   = module::get_embed();
        $modules = module::get_all  ();
        $modules_to_uninstall = [];
      # collect information
        if  (isset($items['*uninstall'])) {
          foreach ($items['*uninstall']->values_get() as $c_module_id) {
            $c_module = $modules[$c_module_id];
            if (!isset($embed[$c_module->id])) {
              $modules_to_uninstall[$c_module->id] = $c_module;
            }
          }
        }
      # if no one item is selected
        if (!$modules_to_uninstall) {
          message::insert('No one item was selected!', 'warning');
          $items['*uninstall']->error_set_in_container();
        }
        break;
    }
  }

  static function on_submit($event, $form, $items) {
    switch ($form->clicked_button->value_get()) {
      case 'apply':
        $embed   = module::get_embed();
        $modules = module::get_all  ();
        $modules_to_uninstall = [];
        $include_paths        = [];
      # collect information
        if  (isset($items['*uninstall'])) {
          foreach ($items['*uninstall']->values_get() as $c_module_id) {
            $c_module = $modules[$c_module_id];
            if (!isset($embed[$c_module->id])) {
              $modules_to_uninstall[$c_module->id] = $c_module;
              $include_paths       [$c_module->id] = $c_module->path;
            }
          }
        }
      # uninstall modules
        if ($modules_to_uninstall) {
          cache::update_global($include_paths);
          foreach ($modules_to_uninstall as $c_module) {
            event::start('on_module_uninstall', $c_module->id);
          }
        }
      # update caches and this form
        cache::update_global();
        $form->child_select('info')->children_delete();
        static::on_init(null, $form, $items);
        break;
    }
  }

}}