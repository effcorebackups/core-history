<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class console {

  const directory = dir_dynamic.'logs/';
  const is_visible_for_nobody   = 0b00;
  const is_visible_for_admin    = 0b01;
  const is_visible_for_everyone = 0b10;

  static protected $data = [];
  static protected $file_log_err = null;
  static protected $is_init = false;
  static protected $visible_mode = self::is_visible_for_nobody;

  static function init($reset = false) {
    if (!static::$is_init || $reset) {
         static::$is_init = true;
      static::$data[] = (object)['object' => 'file', 'action' => 'insertion', 'description' => 'system/boot.php',                           'value' => 'ok', 'time' => 0, 'args' => []];
      static::$data[] = (object)['object' => 'file', 'action' => 'insertion', 'description' => 'system/module_core/backend/core.php',       'value' => 'ok', 'time' => 0, 'args' => []];
      static::$data[] = (object)['object' => 'file', 'action' => 'insertion', 'description' => 'system/module_storage/backend/markers.php', 'value' => 'ok', 'time' => 0, 'args' => []];
      static::$file_log_err = new file(static::directory.core::date_get().'/error--'.core::date_get().'.log');
      static::$visible_mode = static::is_visible_for_nobody;
      if (module::is_enabled('develop')) {
        $settings = module::settings_get('page');
        if ($settings->console_visibility === static::is_visible_for_everyone                                                           ) static::$visible_mode = static::is_visible_for_everyone;
        if ($settings->console_visibility === static::is_visible_for_admin && access::check((object)['roles' => ['admins' => 'admins']])) static::$visible_mode = static::is_visible_for_admin;
      }
    }
  }

  static function visible_mode_get() {
    static::init();
    return static::$visible_mode;
  }

  static function logs_select() {
    static::init();
    return static::$data;
  }

  static function &log_insert($object, $action, $description = null, $value = '', $time = 0, $args = []) {
    static::init();
    $new_log = new \stdClass;
    if (static::visible_mode_get()) {
      $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
      if ($stack[0]['function'] === 'log_insert'            ) array_shift($stack);
      if ($stack[0]['function'] === 'report_about_duplicate') array_shift($stack);
      $new_log->stack       = core::format_debug_backtrace($stack);
    } $new_log->object      = $object;
      $new_log->action      = $action;
      $new_log->description = $description;
      $new_log->value       = $value;
      $new_log->time        = $time;
      $new_log->args        = $args;
    static::$data[] = $new_log;
  # store errors to the static::$file_log_err
    if ($value === 'error') {
      $c_info = $new_log->description;
      foreach ($new_log->args as $c_key => $c_value) $c_info = str_replace('%%_'.$c_key, $c_value, $c_info);
      $c_line = core::time_get().' | '.$new_log->object.
                                 ' | '.$new_log->action.
                                 ' | '.str_replace(br, ' | ', $c_info).nl;
      if (!static::$file_log_err->append_direct($c_line)) {
        message::insert(new text_multiline([
          'File "%%_file" was not written to disc!',
          'File permissions (if the file exists) and directory permissions should be checked.'], [
          'file' => static::$file_log_err->path_get_relative()]), 'error'
        );
      }
    }
    return $new_log;
  }

  static function report_about_duplicate($type, $id, $module_id = null) {
    if ($module_id)                  message::insert(new text('duplicate of type "%%_type" with ID = "%%_id" was found in module with ID = "%%_module_id"',             ['type' => $type, 'id' => $id, 'module_id' => $module_id]), 'error');
    else                             message::insert(new text('duplicate of type "%%_type" with ID = "%%_id" was found',                                                ['type' => $type, 'id' => $id                           ]), 'error');
    return $module_id ? static::log_insert('storage', 'load', 'duplicate of type "%%_type" with ID = "%%_id" was found in module with ID = "%%_module_id"', 'error', 0, ['type' => $type, 'id' => $id, 'module_id' => $module_id]) :
                        static::log_insert('storage', 'load', 'duplicate of type "%%_type" with ID = "%%_id" was found',                                    'error', 0, ['type' => $type, 'id' => $id                           ]);
  }

  # ─────────────────────────────────────────────────────────────────────
  # console output as markup
  # ─────────────────────────────────────────────────────────────────────

  static function markup_get() {
    return new markup('x-console', [], [
      static::block_markup__information (),
      static::block_markup__diagram_load(),
      static::block_markup__logs        ()
    ]);
  }

  static function block_markup__information() {
    $user = user::get_current();
    $user_roles = $user->roles;
    $user_permissions = role::related_permissions_by_roles_select($user_roles);
    $decorator = new decorator('table-dl');
    $decorator->id = 'page_information';
    $decorator->data = [[
      'gen_time'    => ['title' => 'Total generation time',  'value' => locale::format_msecond(timer::period_get('total', 0, 1))  ],
      'memory'      => ['title' => 'Memory for PHP',         'value' => locale::format_bytes(memory_get_usage(true))              ],
      'language'    => ['title' => 'Current language',       'value' => language::code_get_current()                              ],
      'roles'       => ['title' => 'User roles',             'value' => $user_roles       ? implode(', ', $user_roles      ) : '—'],
      'permissions' => ['title' => 'User permissions',       'value' => $user_permissions ? implode(', ', $user_permissions) : '—'] ]];
    return new block('Current page information', ['data-id' => 'block__info', 'data-style' => 'title-is-simple'], [$decorator]);
  }

  static function block_markup__diagram_load() {
    $statistics = [];
    $total = 0;
    foreach (static::$data as $c_log) {
      if (floatval($c_log->time)) {
        if (!isset($statistics[$c_log->object]))
                   $statistics[$c_log->object] = 0;
        $statistics[$c_log->object] += floatval($c_log->time);
        $total += floatval($c_log->time); }}
    $diagram = new diagram(null, 'radial');
    $colors = core::diagram_colors;
    foreach ($statistics as  $c_key => $c_value)
      $diagram->slice_insert($c_key,   $c_value / $total * 100, locale::format_msecond($c_value).' '.translation::apply('sec.'), array_shift($colors), ['data-id' => $c_key]);
    return new block('Total load', ['data-id' => 'block__diagram_load'], [$diagram]);
  }

  static function block_markup__logs() {
    $total_sequence_hash = '';
    $total_data_hash     = '';
    $logs = static::logs_select();
    $decorator = new decorator('table');
    $decorator->id = 'logs';
    $decorator->result_attributes = ['data-style' => 'compact'];
    foreach (static::logs_select() as $c_row_id => $c_log) {
      $c_sequence_hash      = core::hash_get_data(['time' => 0, 'args' => []] + (array)$c_log);
      $c_data_hash          = core::hash_get_data(['time' => 0]               + (array)$c_log);
      $total_sequence_hash  = core::hash_get($total_sequence_hash.$c_sequence_hash);
      $total_data_hash      = core::hash_get($total_data_hash    .$c_data_hash    );
      $c_row_attributes  = ['data-hash'   => core::hash_get_mini($c_log->object.$c_log->action.$c_log->description)];
      $c_row_attributes += ['data-object' => core::sanitize_id(trim($c_log->object, '.'))];
      $c_row_attributes += ['data-action' => core::sanitize_id(trim($c_log->action, '.'))];
      $c_row_attributes += ['data-value'  => core::sanitize_id(trim($c_log->value,  '.'))];
      $c_stack_opener = isset($c_log->stack) ? (new markup_simple('input', ['type' => 'checkbox', 'role' => 'button', 'data-opener-type' => 'stack', 'title' => new text('press to show stack')]))->render() : '';
      $c_stack        = isset($c_log->stack) ? (new markup('x-stack', [], $c_log->stack))->render() : '';
      if ($c_log->time  >= .000099) $c_row_attributes['data-loading-level'] = 1;
      if ($c_log->time  >=  .00099) $c_row_attributes['data-loading-level'] = 2;
      if ($c_log->time  >=   .0099) $c_row_attributes['data-loading-level'] = 3;
      if ($c_log->time  >=    .099) $c_row_attributes['data-loading-level'] = 4;
      if ($c_log->time  >=     .99) $c_row_attributes['data-loading-level'] = 5;
      $decorator->data[] = [
        'attributes'  => $c_row_attributes,
        'time'        => ['title' => 'Time',        'value' => locale::format_msecond($c_log->time)                     ],
        'object'      => ['title' => 'Object',      'value' =>               new text($c_log->object,      $c_log->args)],
        'action'      => ['title' => 'Action',      'value' =>               new text($c_log->action,      $c_log->args)],
        'description' => ['title' => 'Description', 'value' =>   !$c_stack ? new text($c_log->description, $c_log->args) : new text_multiline([$c_log->description, $c_stack_opener, $c_stack], $c_log->args, '')],
        'value'       => ['title' => 'Val.',        'value' =>               new text($c_log->value                    )] ]; }
    return new block('Execution plan', ['data-id' => 'block__logs', 'data-style' => 'title-is-simple'], [$decorator, new markup('x-total', [], [
      new markup('x-param', ['data-id' => 'count'], [new markup('x-title', [], 'Total'        ), new markup('x-value', [], count($logs)        )]),
      new markup('x-param', ['data-id' => 'shash'], [new markup('x-title', [], 'Sequence hash'), new markup('x-value', [], $total_sequence_hash)]),
      new markup('x-param', ['data-id' => 'dhash'], [new markup('x-title', [], 'Data hash'    ), new markup('x-value', [], $total_data_hash    )])])
    ]);
  }

  # ─────────────────────────────────────────────────────────────────────
  # console output as text (for *.jsd | *.cssd)
  # ─────────────────────────────────────────────────────────────────────

  static function text_get() {
    return static::block_text__information ().
           static::block_text__diagram_load().
           static::block_text__logs        ();
  }

  static function block_text__information() {
    $information = [];
    $information['Total generation time'] = locale::format_msecond(timer::period_get('total', 0, 1));
    $information['Memory for PHP'] = locale::format_bytes(memory_get_usage(true));
    $result = '  CURRENT PAGE INFORMATION'.nl.nl;
    foreach ($information as $c_key => $c_value) {
      $result.= '  '.str_pad($c_key, 38, ' ', STR_PAD_LEFT).' : ';
      $result.=      $c_value.nl; }
    return nl.$result.nl;
  }

  static function block_text__diagram_load() {
    $statistics = [];
    $total = 0;
    foreach (static::$data as $c_log) {
      if (floatval($c_log->time)) {
        if (!isset($statistics[$c_log->object]))
                   $statistics[$c_log->object] = 0;
        $statistics[$c_log->object] += floatval($c_log->time);
        $total += floatval($c_log->time); }}
    $result = '  TOTAL LOAD'.nl.nl;
    foreach ($statistics as $c_key => $c_value) {
      $c_percent = $c_value / $total * 100;
      $result.= '  '.str_pad($c_key, 15, ' ', STR_PAD_LEFT).                           ' | ';
      $result.=      str_pad(str_repeat('#', (int)($c_percent / 10)), 10, '-').          ' | ';
      $result.=      str_pad(core::format_number($c_percent, 2), 5, ' ', STR_PAD_LEFT).' % | ';
      $result.=      locale::format_msecond($c_value).' sec.'.nl; }
    return nl.$result.nl;
  }

  static function block_text__logs() {
    $total_sequence_hash = '';
    $total_data_hash     = '';
    $logs = static::logs_select();
    $result = '  EXECUTION PLAN'.nl.nl;
    $result.= '  ------------------------------------------------------------'.nl;
    $result.= '  Time     | Object     | Action     | Value | Description    '.nl;
    $result.= '  ------------------------------------------------------------'.nl;
    foreach (static::logs_select() as $c_log) {
      $c_sequence_hash      = core::hash_get_data(['time' => 0, 'args' => []] + (array)$c_log);
      $c_data_hash          = core::hash_get_data(['time' => 0]               + (array)$c_log);
      $total_sequence_hash  = core::hash_get($total_sequence_hash.$c_sequence_hash);
      $total_data_hash      = core::hash_get($total_data_hash    .$c_data_hash    );
      $result.= '  '.str_pad(locale::format_msecond($c_log->time), 8).' | ';
      $result.=      str_pad($c_log->object, 10).                     ' | ';
      $result.=      str_pad($c_log->action, 10).                     ' | ';
      $result.=      str_pad($c_log->value,   5).                     ' | ';
      $result.=    (new text($c_log->description.(isset($c_log->stack) ? '   …   '.$c_log->stack : ''), $c_log->args, false))->render().nl; }
    $result.= '  ------------------------------------------------------------'.nl;
    $result.= nl.'  '.str_pad('Total: ',         16).count($logs);
    $result.= nl.'  '.str_pad('Sequence hash: ', 16).$total_sequence_hash;
    $result.= nl.'  '.str_pad('Data hash: ',     16).$total_data_hash;
    return nl.$result.nl;
  }

}}