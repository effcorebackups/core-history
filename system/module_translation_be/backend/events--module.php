<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\translation_be {
          use \effcore\language;
          use \effcore\message;
          use \effcore\module;
          use \effcore\page;
          use \effcore\storage;
          use \effcore\text;
          use \effcore\translation;
          abstract class events_module {

  static function on_enable($event) {
    if ((page::get_current()->id == 'install' && language::code_get_current() == 'be') ||
        (page::get_current()->id != 'install')) {
      $module = module::get('translation_be');
      $module->enable();
      message::insert(
        new text('You can enable or disable the language "%%_language" on page "%%_page".', ['language' => language::get('be')->title_en, 'page' => translation::get('Locales')])
      );
    }
  }

  static function on_disable($event) {
    $module = module::get('translation_be');
    $module->disable();
    if (language::code_get_current() == 'be') {
      storage::get('files')->changes_insert('locales', 'update', 'settings/locales/lang_code', 'en');
      language::code_set_current('en');
    }
  }

}}