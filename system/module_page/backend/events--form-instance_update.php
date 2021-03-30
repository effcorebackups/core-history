<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\page {
          use \effcore\access;
          use \effcore\area;
          use \effcore\core;
          use \effcore\entity;
          use \effcore\field_number;
          use \effcore\layout;
          use \effcore\markup;
          use \effcore\text_multiline;
          use \effcore\text;
          use \effcore\widget_area_blocks;
          abstract class events_form_instance_update {

  static function on_init($event, $form, $items) {
    if ($form->has_error_on_init === false) {
      $entity = entity::get($form->entity_name);
      if ($entity) {
        if ($entity->name === 'page' && !empty($form->_instance)) {
        # disable field 'url' for embedded instance
          if (!empty($form->_instance->is_embedded)) {
            $items['#url']->disabled_set(true);
          }
        # field 'min width' + field 'max width'
          $width_min = new field_number('Minimum width', new text_multiline(['Value in pixels.', 'Leave 0 if you want to use global page size settings.']), [], +140);
          $width_max = new field_number('Maximum width', new text_multiline(['Value in pixels.', 'Leave 0 if you want to use global page size settings.']), [], +140);
          $width_min->build();
          $width_max->build();
          $width_min->name_set('width_min');
          $width_max->name_set('width_max');
          $width_min->value_set($form->_instance->data['width_min'] ?? 0);
          $width_max->value_set($form->_instance->data['width_max'] ?? 0);
          $width_min->min_set(0    );
          $width_max->min_set(0    );
          $width_min->max_set(10000);
          $width_max->max_set(10000);
          $form->child_select('fields')->child_insert($width_min, 'width_min');
          $form->child_select('fields')->child_insert($width_max, 'width_max');
        # meta
          if (!access::check((object)['roles'       => ['admins'      => 'admins'     ],
                                      'permissions' => ['manage__seo' => 'manage__seo']])) {
            $items['#meta']->disabled_set(true);
            $items['#is_use_global_meta']->disabled_set(true);
          }
        # layout and its blocks
          $layout = core::deep_clone(layout::select($form->_instance->id_layout));
          if ($layout) {
            foreach ($layout->children_select_recursive() as $c_area) {
              if ($c_area instanceof area) {
                  $c_area->managing_enable();
                  $c_area->build();
                  if ($c_area->id) {
                    $c_widget_area_blocks = new widget_area_blocks($c_area->id);
                    $c_widget_area_blocks->name_complex = 'widget_area_blocks__'.$c_area->id;
                    $c_widget_area_blocks->cform = $form;
                    $c_widget_area_blocks->build();
                    $c_widget_area_blocks->value_set_complex($form->_instance->blocks[$c_area->id] ?? null, true);
                    $c_area->child_insert($c_widget_area_blocks, 'widget_area_blocks');
                    $form->_widgets_area[$c_area->id] = $c_widget_area_blocks;
                  }
              }
            }
            $form->child_select('fields')->child_insert(
              new markup('x-layout-manager', ['data-layout-id' => $layout->id], ['manager' => $layout], -500), 'layout_manager'
            );
          } else {
            $form->child_select('fields')->child_insert(
              new markup('x-form-message', [], ['message' => new text(
                'LOST LAYOUT: %%_id', ['id' => $form->_instance->id_layout ?: 'n/a'])
              ], -500), 'form_message'
            );
          }
        }
      }
    }
  }

  static function on_submit($event, $form, $items) {
    $entity = entity::get($form->entity_name);
    if ($entity) {
      switch ($form->clicked_button->value_get()) {
        case 'update':
          if ($entity->name === 'page' && !empty($form->_instance)) {
          # field 'min width' + field 'max width'
            $data = $form->_instance->data;
            $data['width_min'] = $items['#width_min']->value_get();
            $data['width_max'] = $items['#width_max']->value_get();
            $form->_instance->data = $data;
          # save layout blocks
            if (layout::select($form->_instance->id_layout)) {
              $all_blocks = [];
              foreach ($form->_widgets_area as $c_id_area => $c_widget) {
                $c_blocks_by_area = $c_widget->value_get_complex();
                if ($c_blocks_by_area) {
                  $all_blocks[$c_id_area] = $c_blocks_by_area;
                }
              }
              if (count($all_blocks))
                   $form->_instance->blocks = $all_blocks;
              else $form->_instance->blocks = null;
            }
          }
          break;
      }
    }
  }

}}