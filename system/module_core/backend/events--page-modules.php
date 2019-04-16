<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\core {
          use \effcore\url;
          abstract class events_page_modules {

  static function on_page_init($page) {
    $action = $page->get_args('action');
    if ($action == null) {
      url::go($page->get_args('base').'/install');
    }
  }

}}