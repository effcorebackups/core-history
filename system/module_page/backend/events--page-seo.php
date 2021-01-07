<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\page {
          use \effcore\url;
          abstract class events_page_seo {

  static function on_redirect($event, $page) {
    $type = $page->args_get('type');
    if ($type === null) url::go($page->args_get('base').'/meta');
  }

}}