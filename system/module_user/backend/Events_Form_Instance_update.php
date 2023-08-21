<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore\modules\user;

use effcore\Entity;
use effcore\Field_Password;
use effcore\Page;
use effcore\Text_multiline;
use effcore\Text;
use effcore\Url;

abstract class Events_Form_Instance_update {

    static function on_build($event, $form) {
        if ($form->has_error_on_build === false &&
            $form->has_no_fields      === false) {
            $entity = Entity::get($form->entity_name);
            if ($entity->name === 'relation_role_with_user') {
                # field 'role'
                $form->child_select('fields')->child_select('id_role')->disabled['anonymous' ] = 'anonymous';
                $form->child_select('fields')->child_select('id_role')->disabled['registered'] = 'registered';
            }
            if ($entity->name === 'user') {
                # field 'password'
                $field_password_hash_current = new Field_Password('Current password', null, [], -500);
                $field_password_hash_current->build();
                $field_password_hash_current->name_set('password_hash_current');
                $form->child_select('fields')->child_insert(
                    $field_password_hash_current, 'password_hash_current'
                );
            }
        }
    }

    static function on_init($event, $form, $items) {
        if ($form->has_error_on_build === false &&
            $form->has_no_fields      === false) {
            $entity = Entity::get($form->entity_name);
            if ($entity->name === 'relation_role_with_user') {
                # field 'role'
                if ($form->_instance->id_user === '1' && $form->_instance->id_role === 'admins') {
                    $items['#id_role']->disabled_set();
                }
            }
            if ($entity->name === 'user') {
                # field 'avatar'
                $items['#avatar_path']->fixed_name = 'avatar-'.$form->_instance->id;
            }
        }
    }

    static function on_validate($event, $form, $items) {
        $entity = Entity::get($form->entity_name);
        switch ($form->clicked_button->value_get()) {
            case 'update':
                if ($entity->name === 'relation_role_with_user' && !$form->has_error()) {
                    # field 'user' + field 'role'
                    $id_user     = $items['#id_user']->value_get        ();
                    $id_role_new = $items['#id_role']->value_get        ();
                    $id_role_old = $items['#id_role']->value_get_initial();
                    if ($id_role_new !== $id_role_old) {
                        $result = $entity->instances_select([
                            'where' => ['conjunction_!and' => [
                                'id_user' => ['field_!f' => 'id_user', 'operator' => '=', 'value_!v' => $id_user    ],
                                'id_role' => ['field_!f' => 'id_role', 'operator' => '=', 'value_!v' => $id_role_new] ]],
                            'limit' => 1]);
                        if ($result) {
                            $items['#id_role']->error_set(new Text_multiline([
                                'Field "%%_title" contains an error!',
                                'This combination of values is already in use!'], ['title' => (new Text($items['#id_role']->title))->render() ]
                            ));
                        }
                    }
                }
                if ($entity->name === 'relation_role_with_permission' && !$form->has_error()) {
                    # field 'role' + field 'permission'
                    $id_role           = $items['#id_role'      ]->value_get        ();
                    $id_permission_new = $items['#id_permission']->value_get        ();
                    $id_permission_old = $items['#id_permission']->value_get_initial();
                    if ($id_permission_new !== $id_permission_old) {
                        $result = $entity->instances_select([
                            'where' => [
                                'conjunction_!and' => [
                                    'id_role'       => ['field_!f' => 'id_role',       'operator' => '=', 'value_!v' => $id_role          ],
                                    'id_permission' => ['field_!f' => 'id_permission', 'operator' => '=', 'value_!v' => $id_permission_new] ]],
                            'limit' => 1]);
                        if ($result) {
                            $items['#id_role'      ]->error_set();
                            $items['#id_permission']->error_set(new Text_multiline([
                                'Field "%%_title" contains an error!',
                                'This combination of values is already in use!'], ['title' => (new Text($items['#id_permission']->title))->render() ]
                            ));
                        }
                    }
                }
                if ($entity->name === 'user' && !$form->has_error()) {
                    # field 'new password' + field 'current password'
                    if (!hash_equals($form->_instance->password_hash, $items['#password_hash_current']->value_get())) {
                        $items['#password_hash_current']->error_set(
                            'Field "%%_title" contains an incorrect value!', ['title' => (new Text($items['#password_hash_current']->title))->render() ]
                        );
                        return;
                    }
                    if ($items['#password_hash_current']->value_get() ===
                        $items['#password_hash'        ]->value_get()) {
                        $items['#password_hash']->error_set(
                            'New password should be different from the current password!'
                        );
                        return;
                    }
                }
                break;
        }
    }

    static function on_submit($event, $form, $items) {
        $entity = Entity::get($form->entity_name);
        switch ($form->clicked_button->value_get()) {
            case 'update':
            case 'cancel':
                if ($entity->name === 'user' && Page::get_current()->id === 'user_edit') {
                    if (!Url::back_url_get())
                         Url::back_url_set('back', '/user/'.$items['#nickname']->value_get());
                }
                break;
        }
    }

}
