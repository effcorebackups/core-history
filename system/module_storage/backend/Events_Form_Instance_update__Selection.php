<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore\modules\storage;

use effcore\Entity;
use effcore\Form_part;
use effcore\Text;

abstract class Events_Form_Instance_update__Selection {

    static function on_build($event, $form) {
        if ($form->has_error_on_build === false &&
            $form->has_no_fields      === false) {
            $entity = Entity::get($form->entity_name);
            if ($entity->name === 'selection') {
                $form->child_select('fields')->child_select('fields'            )->_instance = $form->_instance;
                $form->child_select('fields')->child_select('query_settings'    )->_instance = $form->_instance;
                $form->child_select('fields')->child_select('decorator_settings')->_instance = $form->_instance;
                $form->child_select('fields')->child_insert(Form_part::get('form_instance_update__selection_pager_settings'), 'pager_settings');
            }
        }
    }

    static function on_init($event, $form, $items) {
        if ($form->has_error_on_build === false &&
            $form->has_no_fields      === false) {
            $entity = Entity::get($form->entity_name);
            if ($entity->name === 'selection') {
                $data = $form->_instance->data;
                if (isset($data['pager_is_enabled'])) $items['#pager_is_enabled']->checked_set($data['pager_is_enabled']);
                if (isset($data['pager_name'      ])) $items['#pager_name'      ]->  value_set($data['pager_name']);
                if (isset($data['pager_id'        ])) $items['#pager_id'        ]->  value_set($data['pager_id']);
            }
        }
    }

    static function on_validate($event, $form, $items) {
        $entity = Entity::get($form->entity_name);
        switch ($form->clicked_button->value_get()) {
            case 'update':
                if ($entity->name === 'selection') {
                    if (empty($items['*fields']->value_get()['main'])) {
                        $form->error_set('Group "%%_title" should contain a minimum %%_number item%%_plural(number|s)!', ['title' => (new Text($items['*fields']->title))->render(), 'number' => 1]);
                    }
                }
                break;
        }
    }

    static function on_submit($event, $form, $items) {
        $entity = Entity::get($form->entity_name);
        switch ($form->clicked_button->value_get()) {
            case 'update':
                if ($entity->name === 'selection') {
                    $data = $form->_instance->data;
                    $data['pager_is_enabled'] = $items['#pager_is_enabled']->checked_get();
                    $data['pager_name'      ] = $items['#pager_name'      ]->  value_get();
                    $data['pager_id'        ] = $items['#pager_id'        ]->  value_get();
                    $form->_instance->data = $data;
                }
                break;
        }
    }

}
