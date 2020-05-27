<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class console {

  const directory = dir_dynamic.'logs/';

  static protected $data = [];

  static function logs_select() {
    return static::$data;
  }

  static function &log_insert($object, $action, $description = null, $value = '', $time = 0, $args = []) {
    $new_log = new \stdClass;
    $new_log->object      = $object;
    $new_log->action      = $action;
    $new_log->description = $description;
    $new_log->value       = $value;
    $new_log->time        = $time;
    $new_log->args        = $args;
    static::$data[] = $new_log;
    return $new_log;
  }

  static function log_insert_about_duplicate($type, $id, $module_id = null) {
    if ($module_id && !storage::get('sql')->is_installed()) { # for page '/install' + redirect
      $module = module::get($module_id);
      if ($module instanceof module_as_profile) {
        return;
      }
    }
    return $module_id ? static::log_insert('storage', 'load', 'duplicate of type "%%_type" with ID = "%%_id" was found in module with ID = "%%_module_id"', 'error', 0, ['type' => $type, 'id' => $id, 'module_id' => $module_id]) :
                        static::log_insert('storage', 'load', 'duplicate of type "%%_type" with ID = "%%_id" was found',                                    'error', 0, ['type' => $type, 'id' => $id                           ]);
  }

  static function log_store($log_level = 'error') {
    $file = new file(static::directory.core::date_get().'/'.
                       $log_level.'--'.core::date_get().'.log');
    foreach (static::$data as $c_log) {
      if ($c_log->value == $log_level) {
        $c_info = $c_log->description;
        foreach ($c_log->args as $c_key => $c_value)
          $c_info = str_replace('%%_'.$c_key, $c_value, $c_info);
          $c_info = str_replace(br, ' | ', $c_info);
        if (!$file->append_direct(core::time_get().' | '.
                                    $c_log->object.' | '.
                                    $c_log->action.' | '.$c_info.nl)) {
          message::insert(new text_multiline([
            'Can not insert or update file "%%_file" in the directory "%%_directory"!',
            'Check file (if exists) and directory permissions.'], [
            'file'      => $file->file_get(),
            'directory' => $file->dirs_get_relative()]), 'error'
          );
        }
      }
    }
  }

  # ─────────────────────────────────────────────────────────────────────
  # console output as markup
  # ─────────────────────────────────────────────────────────────────────

  static function markup_get() {
    return new markup('x-page-section', ['data-page-section-id' => 'console'],
      new markup('x-console', [], [
        static::markup_get_block_information (),
        static::markup_get_block_diagram_load(),
        static::markup_get_block_logs        ()
    ]));
  }

  static function markup_get_block_information() {
    $user = user::get_current();
    $decorator = new decorator('table-dl');
    $decorator->id = 'page_information';
    $decorator->data = [[
      'gen_time' => ['title' => 'Total generation time',  'value' => locale::format_msecond(timer::period_get('total', 0, 1))],
      'memory'   => ['title' => 'Memory for PHP (bytes)', 'value' => locale::format_number(memory_get_usage(true))           ],
      'language' => ['title' => 'Current language',       'value' => language::code_get_current()                            ],
      'roles'    => ['title' => 'User roles',             'value' => implode(', ', $user->roles)                             ] ]];
    return new block('Current page information', ['data-id' => 'info', 'data-title-is-styled' => 'false'], [
      $decorator
    ]);
  }

  static function markup_get_block_diagram_load() {
    $statistics = [];
    $total = 0;
    foreach (static::$data as $c_log) {
      if (floatval($c_log->time)) {
        if (!isset($statistics[$c_log->object]))
                   $statistics[$c_log->object] = 0;
        $statistics[$c_log->object] += floatval($c_log->time);
        $total += floatval($c_log->time);}}
    $diagram = new diagram(null, 'radial');
    $colors = core::diagram_colors;
    foreach ($statistics as  $c_key => $c_value)
      $diagram->slice_insert($c_key,   $c_value / $total * 100, locale::format_msecond($c_value).' '.translation::apply('sec.'), array_shift($colors), ['data-id' => $c_key]);
    return new block('Total load', ['data-id' => 'diagram_load'], [
      $diagram
    ]);
  }

  static function markup_get_block_logs() {
    $total_sequence_hash = '';
    $total_data_hash     = '';
    $logs = static::logs_select();
    $decorator = new decorator('table');
    $decorator->id = 'logs';
    $decorator->result_attributes = ['data-compact' => true];
    foreach (static::logs_select() as $c_row_id => $c_log) {
      $c_sequence_hash      = core::hash_get_data(['time' => 0, 'args' => []] + (array)$c_log);
      $c_data_hash          = core::hash_get_data(['time' => 0]               + (array)$c_log);
      $total_sequence_hash  = core::hash_get($total_sequence_hash.$c_sequence_hash);
      $total_data_hash      = core::hash_get($total_data_hash    .$c_data_hash    );
      $c_row_attributes  = ['data-object' => core::sanitize_id($c_log->object)];
      $c_row_attributes += ['data-action' => core::sanitize_id($c_log->action)];
      $c_row_attributes += ['data-value'  => core::sanitize_id($c_log->value )];
      if ($c_log->time  >= .000099) $c_row_attributes['data-loading-level'] = 1;
      if ($c_log->time  >=  .00099) $c_row_attributes['data-loading-level'] = 2;
      if ($c_log->time  >=   .0099) $c_row_attributes['data-loading-level'] = 3;
      if ($c_log->time  >=    .099) $c_row_attributes['data-loading-level'] = 4;
      if ($c_log->time  >=     .99) $c_row_attributes['data-loading-level'] = 5;
      $decorator->data[] = [
        'attributes'  => $c_row_attributes,
        'time'        => ['title' => 'Time',        'value' => locale::format_msecond($c_log->time)       ],
        'object'      => ['title' => 'Object',      'value' => new text($c_log->object,      $c_log->args)],
        'action'      => ['title' => 'Action',      'value' => new text($c_log->action,      $c_log->args)],
        'description' => ['title' => 'Description', 'value' => new text($c_log->description, $c_log->args)],
        'value'       => ['title' => 'Val.',        'value' => new text($c_log->value                    )]];}
    return new block('Execution plan', ['data-id' => 'logs', 'data-title-is-styled' => 'false'], [$decorator, new markup('x-total', [], [
      new markup('x-param', ['data-id' => 'count'], [new markup('x-title', [], 'Total'        ), new markup('x-value', [], count($logs)        )]),
      new markup('x-param', ['data-id' => 'shash'], [new markup('x-title', [], 'Sequence hash'), new markup('x-value', [], $total_sequence_hash)]),
      new markup('x-param', ['data-id' => 'dhash'], [new markup('x-title', [], 'Data hash'    ), new markup('x-value', [], $total_data_hash    )])]),
    ]);
  }

  # ─────────────────────────────────────────────────────────────────────
  # console output as text (for *.jsd | *.cssd)
  # ─────────────────────────────────────────────────────────────────────

  static function text_get() {
    return static::text_get_block_information ().
           static::text_get_block_diagram_load().
           static::text_get_block_logs        ();
  }

  static function text_get_block_information() {
    $information = [];
    $information['Total generation time'] = locale::format_msecond(timer::period_get('total', 0, 1));
    $information['Memory for PHP (bytes)'] = locale::format_number(memory_get_usage(true));
    $result = '  CURRENT PAGE INFORMATION'.nl.nl;
    foreach ($information as $c_key => $c_value) {
      $result.= '  '.str_pad($c_key, 38, ' ', STR_PAD_LEFT).' : ';
      $result.=      $c_value.nl;}
    return nl.$result.nl;
  }

  static function text_get_block_diagram_load() {
    $statistics = [];
    $total = 0;
    foreach (static::$data as $c_log) {
      if (floatval($c_log->time)) {
        if (!isset($statistics[$c_log->object]))
                   $statistics[$c_log->object] = 0;
        $statistics[$c_log->object] += floatval($c_log->time);
        $total += floatval($c_log->time);}}
    $result = '  TOTAL LOAD'.nl.nl;
    foreach ($statistics as $c_key => $c_value) {
      $c_percent = $c_value / $total * 100;
      $result.= '  '.str_pad($c_key, 15, ' ', STR_PAD_LEFT).                           ' | ';
      $result.=      str_pad(str_repeat('#', (int)($c_percent / 10)), 10, '-').          ' | ';
      $result.=      str_pad(core::format_number($c_percent, 2), 5, ' ', STR_PAD_LEFT).' % | ';
      $result.=      locale::format_msecond($c_value).' sec.'.nl;}
    return nl.$result.nl;
  }

  static function text_get_block_logs() {
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
      $result.=    (new text($c_log->description, $c_log->args, false))->render().nl;}
    $result.= '  ------------------------------------------------------------'.nl;
    $result.= nl.'  '.str_pad('Total: ',         16).count($logs);
    $result.= nl.'  '.str_pad('Sequence hash: ', 16).$total_sequence_hash;
    $result.= nl.'  '.str_pad('Data hash: ',     16).$total_data_hash;
    return nl.$result.nl;
  }

}}