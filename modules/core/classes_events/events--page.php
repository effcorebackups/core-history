<?php

namespace effectivecore {
          use \effectivecore\modules\page\page_factory as pages;
          use \effectivecore\modules\storage\storage_factory as storages;
          abstract class events_page extends events {

  static function on_show_install() {
    foreach (static::get()->on_install as $c_event) {
      call_user_func($c_event->handler);
    }
  }

  static function on_show_modules() {
    $head = [[
      'Title',
      'ID',
      'Path',
      'Description',
      'Version',
      'State',
    ]];
    $body = [];
    foreach (storages::get('settings')->select('module') as $c_module) {
      $body[] = [
        $c_module->title,
        $c_module->id,
        $c_module->path,
        $c_module->description,
        $c_module->version,
        $c_module->state,
      ];
    }
    return new table([], $body, $head);
  }

}}