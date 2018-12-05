<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\user {
          use \effcore\access;
          use \effcore\message;
          use \effcore\translation;
          abstract class events_form_access {

  static function on_init($form, $items) {
    $access = null;
    switch ($form->_args['entity_name']) {
      case 'page': $access = $form->_page->access; break;
    }
    $items['settings/roles']->values = access::roles_get();
    $items['settings/roles']->checked = $access->roles;
    $items['settings/roles']->build();
  }

  static function on_submit($form, $items) {
    foreach ($items['settings/roles']->values_get() as $c_id) {
      message::insert(translation::get('Role %%_id was selected.', ['id' => $c_id]));
    }
  }

}}