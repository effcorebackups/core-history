<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\core {
          use \effcore\block;
          use \effcore\core;
          use \effcore\decorator;
          use \effcore\language;
          use \effcore\locale;
          use \effcore\markup_simple;
          use \effcore\markup;
          use \effcore\module;
          use \effcore\node;
          use \effcore\session;
          use \effcore\storage;
          use \effcore\text;
          abstract class events_page_info {

  static function on_show_block_system_info($page) {
    $logo      = new markup('x-logo',      [], new markup_simple('img', ['src' => '/'.module::get('page')->path.'frontend/images/logo-system.svgd', 'alt' => new text('system logotype'), 'width' => '300']));
    $copyright = new markup('x-copyright', [], '© 2017—2019 Maxim Rysevets. All rights reserved.');
    $build     = new markup('x-build',     [], [
      new markup('x-title', [], 'Build number'),
      new markup('x-value', [], storage::get('files')->select('bundle/system/build'))
    ]);
    return new block('', ['data-id' => 'info_system'], [
      $logo,
      $copyright,
      $build
    ]);
  }

  static function on_show_block_service_info($page) {
    $settings            = module::settings_get('core');
    $is_required_updates = module::is_required_updates();
    $is_required_updates_fixlink = new markup('a', ['href' => '/manage/modules/update'], 'fix');
    $is_required_updates_sticker = new markup('x-sticker', ['data-state' => !$is_required_updates ? 'ok' : 'warning'], $is_required_updates ? 'yes' : 'no');
    $cron_last_run_sticker       = new markup('x-sticker', ['data-state' => !empty($settings->cron_last_run_date) && $settings->cron_last_run_date > core::datetime_get('-'.session::period_expired_d.' second') ? 'ok' : 'warning'], $settings->cron_last_run_date ?? 'no');
    $cron_link = new markup('a', ['target' => 'cron', 'href' => '/manage/cron/'.core::key_get('cron')], '/manage/cron/'.core::key_get('cron'));
    $decorator = new decorator('dl');
    $decorator->id = 'service_info';
    $decorator->data = [[
      'prov_key'      => ['title' => 'Provisioning key',        'value' => 'not applicable'                                                                                                                                   ],
      'subscr_to_upd' => ['title' => 'Subscribe to updates',    'value' => 'not applicable'                                                                                                                                   ],
      'upd_is_req'    => ['title' => 'Data update is required', 'value' => new node([], $is_required_updates ? [$is_required_updates_sticker, new text(' → '), $is_required_updates_fixlink] : [$is_required_updates_sticker])],
      'cron_last_run' => ['title' => 'Cron last run',           'value' => $cron_last_run_sticker                                                                                                                             ],
      'cron_url'      => ['title' => 'Cron URL',                'value' => $cron_link                                                                                                                                         ]
    ]];
    return new block('Service', ['data-id' => 'info_service'], [
      $decorator
    ]);
  }

  static function on_show_block_environment_info($page) {
    $storage_sql = storage::get('sql');
    $is_enabled_opcache = function_exists('opcache_get_status') && !empty(opcache_get_status(false)['opcache_enabled']);
    $is_enabled_opcache_sticker = new markup('x-sticker', ['data-state' => $is_enabled_opcache ? 'ok' : 'warning'], $is_enabled_opcache ? 'yes' : 'no');
    $decorator = new decorator('dl');
    $decorator->id = 'environment_info';
    $decorator->data = [[
      'web_server'    => ['title' => 'Web server',             'value' => core::server_get_software()                              ],
      'php_version'   => ['title' => 'PHP Version',            'value' => phpversion().' ('.php_uname('m').')'                     ],
      'opcache_state' => ['title' => 'PHP OPcache is anebled', 'value' => $is_enabled_opcache_sticker                              ],
      'storage_sql'   => ['title' => 'Storage SQL',            'value' => $storage_sql->title_get().' '.$storage_sql->version_get()],
      'os_name'       => ['title' => 'Operating System',       'value' => php_uname('s')                                           ],
      'os_version'    => ['title' => 'OS Version',             'value' => php_uname('v')                                           ],
      'hostname'      => ['title' => 'Hostname',               'value' => php_uname('n')                                           ],
      'timezone'      => ['title' => 'Server timezone',        'value' => date_default_timezone_get()                              ],
      'datetime'      => ['title' => 'Server UTC date / time', 'value' => core::datetime_get()                                     ],
    ]];
    return new block('Environment', ['data-id' => 'info_environment'], [
      $decorator
    ]);
  }

}}