<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\demo {
          use const \effcore\nl;
          use \effcore\console;
          use \effcore\event;
          use \effcore\session;
          use \effcore\user;
          abstract class events_file {

  static function process_demotype($file_info) {
    $session = session::select();
    if ($session &&
        $session->id_user) {
      $user = user::current_get();
      if (!isset($user->roles['registered'])) {
        user::init($session->id_user, false); # false - do not load roles from the storage
        $user = user::current_get();
      }
      if (isset($user->roles['registered'])) {
        $data = '';
        event::start('on_file_process_demotype', null, [$file_info, &$data]);
        header('Content-Length: '.strlen($data));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=demo.txt');
        header('Cache-Control: private, no-cache, no-store, must-revalidate');
        header('Expires: 0');
        print $data;
      }
    }
    console::log_store();
    exit();
  }

  static function on_process_demotype($file_info, &$data) {
    $user = user::current_get();
    $data = 'dirs: '.$file_info->dirs.nl;
    $data.= 'name: '.$file_info->name.nl;
    $data.= 'type: '.$file_info->type.nl;
    $data.= 'call \effcore\modules\demo\events_file::on_process_demotype'.nl;
    $data.= 'current user: '.$user->nick.nl;
    $data.= 'current user roles: '.implode(', ', $user->roles);
  }

}}