<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\page {
          use \effcore\dynamic;
          use \effcore\file;
          use \effcore\message;
          use \effcore\text_multiline;
          abstract class events_form_global_css {

  static function on_init($event, $form, $items) {
    $file = new file(dynamic::dir_files.'global.css');
    if ($file->is_exists()) {
      $items['#content']->value_set(
        $file->load()
      );
    }
  }

  static function on_submit($event, $form, $items) {
    switch ($form->clicked_button->value_get()) {
      case 'save':
        $file = new file(dynamic::dir_files.'global.css');
        $new_value = $items['#content']->value_get();
        if (strlen($new_value) !== 0) {
          $file->data_set($new_value);
          if ($file->save())
               message::insert(new text_multiline(['File "%%_file" was written to disc.'                                                                                          ], ['file' => $file->path_get_relative()])         );
          else message::insert(new text_multiline(['File "%%_file" was not written to disc!', 'File permissions (if the file exists) and directory permissions should be checked.'], ['file' => $file->path_get_relative()]), 'error');
        }
        if (strlen($new_value) === 0 && $file->is_exists()) {
          if (@unlink($file->path_get()))
               message::insert(new text_multiline(['File "%%_file" was deleted.'                                                ], ['file' => $file->path_get_relative()])         );
          else message::insert(new text_multiline(['File "%%_file" was not deleted!', 'Directory permissions should be checked.'], ['file' => $file->path_get_relative()]), 'error');
        }
        break;
    }
  }

}}