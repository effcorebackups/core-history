<?php

  #############################################################
  ### Copyright © 2017 Maxim Rysevets. All rights reserved. ###
  #############################################################

namespace effectivecore\modules\develop {
          use \effectivecore\message_factory as message;
          use \effectivecore\entities_factory as entities;
          use \effectivecore\translations_factory as translations;
          abstract class events_module extends \effectivecore\events_module {

  static function on_start() {
  }

  static function on_install() {
    foreach (entities::get_by_module('develop') as $c_entity) {
      if ($c_entity->install()) message::add_new(translations::get('Entity %%_name was installed.',     ['name' => $c_entity->get_name()]));
      else                      message::add_new(translations::get('Entity %%_name was not installed!', ['name' => $c_entity->get_name()]), 'error');
    }
  }

}}