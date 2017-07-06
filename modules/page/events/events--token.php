<?php

namespace effectivecore\modules\page {
          use \effectivecore\modules\storage\storage_factory as storages;
          abstract class events_token extends \effectivecore\events_token {

  static function on_color_get($match, $arg_1_num = null) {
    $decoration = storages::get('settings')->select('decoration');
    $colors     = storages::get('settings')->select('colors');
    switch ($match) {
      case '%%_color'   : return $colors['page'][$decoration['page']->color   ]->value;
      case '%%_color_bg': return $colors['page'][$decoration['page']->color_bg]->value;
    }
  }

}}