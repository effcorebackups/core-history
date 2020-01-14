<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\page {
          use \effcore\area;
          use \effcore\core;
          use \effcore\entity;
          use \effcore\layout;
          use \effcore\markup;
          use \effcore\page_part_preset_link;
          use \effcore\page;
          use \effcore\widget_area_parts;
/* rem */ use \effcore\widget_area_parts_old;
          abstract class events_form_instance_update {

  static function on_init($event, $form, $items) {
    $entity_name = page::get_current()->args_get('entity_name');
    $entity = entity::get($entity_name);
    if ($entity) {
      if ($entity->name == 'page' && !empty($form->_instance)) {
      # disable url field for embedded instance
        if (!empty($form->_instance->is_embed)) {
          $items['#url']->disabled_set(true);
        }
      # build layout
        $layout = core::deep_clone(layout::select($form->_instance->id_layout));
        foreach ($layout->children_select_recursive() as $c_area) {
          if ($c_area instanceof area && $c_area->id) {
            $c_area->managing_is_enabled = true;
            $c_area->tag_name = 'div';
            $c_area->build();
            $c_widget_area_parts = new widget_area_parts('parts_'.$c_area->id.'_');
            $c_widget_area_parts->form_current_set($form);
            $c_widget_area_parts->build();
            $c_widget_area_parts->items_set_once($form->_instance->parts[$c_area->id]);
            $c_area->child_insert($c_widget_area_parts, 'widget_area_parts');
            $form->_widgets_area[$c_area->id] = $c_widget_area_parts;
/* rem */   $c_widget_area_parts_old = new widget_area_parts_old($c_area->id);
/* rem */   $c_widget_area_parts_old->form_current_set($form);
/* rem */   $c_widget_area_parts_old->items_set_once($form->_instance->parts[$c_area->id] ?? null);
/* rem */   $c_widget_area_parts_old->build();
/* rem */   $c_area->child_insert($c_widget_area_parts_old, 'widget_area_parts_old');
/* rem */   $form->_widgets_area_old[$c_area->id] = $c_widget_area_parts_old;
          }
        }
        $form->child_select('fields')->child_insert(
          new markup('x-layout-manager', [], ['layout' => $layout]), 'layout_manager'
        );
      }
    }
  }

  static function on_submit($event, $form, $items) {
    $entity_name = page::get_current()->args_get('entity_name');
    $entity = entity::get($entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'update':
          if ($entity->name == 'page' && !empty($form->_instance)) {
            $all_parts = [];
            foreach ($form->_widgets_area_old as $c_id_area => $c_widget) {
              $c_parts = $c_widget->items_get_sorted();
              if ($c_parts) {
                $all_parts[$c_id_area] = $c_parts;
              }
            }
            if (count($all_parts))
                 $form->_instance->parts = $all_parts;
            else $form->_instance->parts = null;
          }
          break;
      }
    }
  }

}}