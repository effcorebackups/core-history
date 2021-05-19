<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\user {
          use \effcore\access;
          use \effcore\page;
          use \effcore\user;
          abstract class events_token {

  static function on_apply($name, $args = []) {
    user::init(false);
    if (access::check((object)['roles' => ['registered' => 'registered']])) {
      switch ($name) {
        case 'user_id'   : return     user::get_current()->id;
        case 'nickname'  : return     user::get_current()->nickname;
        case 'email'     : return     user::get_current()->email;
        case 'avatar_url': return '/'.user::get_current()->avatar_path.'?thumb=small';
        case 'nickname_page_context':
          if (!empty($args[0])) {
            return page::get_current()->args_get($args[0]);
          }
      }
    }
    switch ($name) {
      case 'page_id_context':
        return page::get_current()->id;
    }
    return '';
  }

}}