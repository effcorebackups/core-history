<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class storage_nosql_files implements has_external_cache {

  public $name;

  function select($dpath, $expand_cache = false) {
    $parts = explode('/', $dpath);
    $catalog_name = array_shift($parts);
    if (isset(static::$data[$catalog_name]) == false) static::init($catalog_name);
    if (isset(static::$data[$catalog_name])) {
      $c_pointer = static::$data[$catalog_name];
      foreach ($parts as $c_part) {
        $c_pointer = &core::arrobj_value_select($c_pointer, $c_part);
        if ($expand_cache && $c_pointer instanceof external_cache) {
          $c_pointer = $c_pointer->external_cache_load();
        }
      }
      return $c_pointer;
    }
  }

  function changes_insert($module_id, $action, $dpath, $value = null, $rebuild = true) {
  # insert new dynamic changes
    $changes_d = data::select('changes') ?: [];
    $changes_d[$module_id]->{$action}[$dpath] = $value;
    data::update('changes', $changes_d, '', ['build_date' => core::datetime_get()]);
  # prevent opcache work
    static::$changes_dynamic['changes'] = $changes_d;
    if ($rebuild) {
      static::data_cache_update();
    }
  }

  function changes_delete($module_id, $action, $dpath, $rebuild = true) {
  # delete old dynamic changes
    $changes_d = data::select('changes') ?: [];
    if (isset($changes_d[$module_id]->{$action}[$dpath]))                                           unset($changes_d[$module_id]->{$action}[$dpath]);
    if (isset($changes_d[$module_id]->{$action}) && (array)$changes_d[$module_id]->{$action} == []) unset($changes_d[$module_id]->{$action});
    if (isset($changes_d[$module_id])            && (array)$changes_d[$module_id]            == []) unset($changes_d[$module_id]);
    data::update('changes', $changes_d, '', ['build_date' => core::datetime_get()]);
  # prevent opcache work
    static::$changes_dynamic['changes'] = $changes_d;
    if ($rebuild) {
      static::data_cache_update();
    }
  }

  ###########################
  ### static declarations ###
  ###########################

  static public $data = [];
  static public $changes_dynamic;

  static function not_external_properties_get() {
    return ['name' => 'name'];
  }

  static function init($catalog_name) {
    console::log_add('storage', 'init.', 'catalog %%_catalog_name in storage %%_storage_name will be initialized', 'ok', 0, ['catalog_name' => $catalog_name, 'storage_name' => 'files']);
    $cache = cache::select('data--'.$catalog_name);
    if ($cache) static::$data[$catalog_name] = $cache;
    else        static::data_cache_update();
  }

  static function data_cache_cleaning() {
    foreach (file::select_recursive(cache::directory, '', true) as $c_path => $c_object) {
      if ($c_path != cache::directory.'readme.mark') {
        if ($c_object instanceof file) $c_result = @unlink($c_path);
        else                                       @rmdir ($c_path);
        if (!$c_result) {
          $c_file = new file($c_path);
          message::insert(
            'Can not delete file "'.$c_file->file_get().'" in the directory "'.$c_file->dirs_relative_get().'"!'.br.
            'Check directory permissions.', 'error'
          );
        }
      }
    }
  }

  static function data_cache_update($reset_orig = false, $with_paths = []) {
  # init data and original data
    static::$data = [];
    $data_orig = cache::select('data_original');
    if (!$data_orig || $reset_orig) {
      $data_orig = static::data_static_find($with_paths);
      cache::update('data_original', $data_orig, '', ['build_date' => core::datetime_get()]);
    }
  # init dynamic and static changes
    $changes_d = data::select('changes') ?: [];
    $changes_s =   $data_orig['changes'] ?? [];
  # apply all changes to original data and get the final data
    $data = core::array_clone_deep($data_orig);
    static::data_changes_apply($changes_d, $data);
    static::data_changes_apply($changes_s, $data);
    unset($data['changes']);
  # save cache
    foreach ($data as $c_catalog_name => $c_data) {
      static::$data[$c_catalog_name] = $c_data;
      foreach (core::arrobj_values_select_recursive($c_data, true) as $c_dpath => &$c_value) {
        if ($c_value instanceof has_external_cache) {
          $c_cache_id = 'data--'.$c_catalog_name.'-'.str_replace('/', '-', $c_dpath);
          $c_not_external_properties = array_intersect_key((array)$c_value, $c_value::not_external_properties_get());
          cache::update($c_cache_id, $c_value);
          $c_value = new external_cache(
            $c_cache_id,
            $c_not_external_properties
          );
        }
      }
      cache::update('data--'.$c_catalog_name, $c_data);
    }
  }

  static function data_changes_apply($changes, &$data) {
    foreach ($changes as $module_id => $c_module_changes) {
      foreach ($c_module_changes as $c_action => $c_changes) {
        foreach ($c_changes as $c_dpath => $c_data) {
          $c_pointers = core::dpath_pointers_get($data, $c_dpath);
          $c_parent_name = array_keys($c_pointers)[count($c_pointers)-2];
          $c_child_name  = array_keys($c_pointers)[count($c_pointers)-1];
          $c_parent      =           &$c_pointers[$c_parent_name];
          $c_child       =           &$c_pointers[$c_child_name];
          switch ($c_action) {
            case 'insert': foreach ($c_data as $c_key => $c_value) core::arrobj_value_insert($c_child, $c_key, $c_value);        break; # supported types: array|object
            case 'update':                                         core::arrobj_value_insert($c_parent, $c_child_name, $c_data); break; # supported types: array|object|string|numeric|bool|null
            case 'delete':                                         core::arrobj_child_delete($c_parent, $c_child_name);          break;
          }
        }
      }
    }
  }

  static function data_static_find($with_paths = []) {
    $result = [];
    $parsed = [];
    $bundles_path = [];
    $modules_path = [];
    $files = [];
    foreach (file::select_recursive(dir_system,  '%^.*/module\\.data$%') +
             file::select_recursive(dir_system,  '%^.*/bundle\\.data$%') +
             file::select_recursive(dir_modules, '%^.*/module\\.data$%') +
             file::select_recursive(dir_modules, '%^.*/bundle\\.data$%') as $c_file) {
      $files[$c_file->path_relative_get()] = $c_file;
    }
  # collect *.data from enabled modules
    foreach (core::boot_select('enabled') + $with_paths as $c_module_path) {
      $files += file::select_recursive($c_module_path,  '%^.*\\.data$%');
    }
  # parse each *.data
    foreach ($files as $c_file) {
      $c_data = static::text_to_data($c_file->load(), $c_file);
      $c_path_relative = $c_file->path_relative_get();
      $parsed[$c_path_relative] = new \stdClass();
      $parsed[$c_path_relative]->file = $c_file;
      $parsed[$c_path_relative]->data = $c_data;
    }
  # collect modules and bundles paths
    foreach ($parsed as $c_file_path => $c_info) {
      if ($c_info->file->name == 'bundle') $bundles_path[$c_info->data->bundle->id] = $c_info->file->dirs_relative_get();
      if ($c_info->file->name == 'module') $modules_path[$c_info->data->module->id] = $c_info->file->dirs_relative_get();
    }
  # build the result
    foreach ($parsed as $c_file_path => $c_info) {
    # define the module_id for each *.data file
      $c_module_id = null;
      foreach ($modules_path as $c_id => $c_path) {
        if (strpos($c_file_path, $c_path) === 0) {
          $c_module_id = $c_id;
          break;
        }
      }
    # fill the $result
      foreach ($c_info->data as $c_type => $c_data) {
        if ($c_type == 'bundle' && isset($bundles_path[$c_data->id])) {$c_module_id = $c_data->id; $c_data->path = $bundles_path[$c_data->id];};
        if ($c_type == 'module' && isset($modules_path[$c_data->id])) {$c_module_id = $c_data->id; $c_data->path = $modules_path[$c_data->id];};
        if ($c_module_id) {
          if (is_object($c_data)) $result[$c_type][$c_module_id] = $c_data;
          elseif (is_array($c_data)) {
            if (!isset($result[$c_type][$c_module_id]))
                       $result[$c_type][$c_module_id] = [];
            $result[$c_type][$c_module_id] += $c_data;
          }
        }
      }
    }
    return $result;
  }

  static function data_to_text($data, $entity_name = '', $entity_prefix = '  ', $depth = 0) {
    $result = [];
    if ($entity_name) {
      $result[] = str_repeat('  ', $depth-1).($depth ? $entity_prefix : '').$entity_name;
    }
    foreach ($data as $c_key => $c_value) {
      if (is_array ($c_value) && !count($c_value))           continue;
      if (is_object($c_value) && !get_object_vars($c_value)) continue;
      if (is_array ($c_value))     $result[] = static::data_to_text($c_value, $c_key, is_array($data) ? '- ' : '  ', $depth + 1);
      elseif (is_object($c_value)) $result[] = static::data_to_text($c_value, $c_key, is_array($data) ? '- ' : '  ', $depth + 1);
      elseif ($c_value === null)   $result[] = str_repeat('  ', $depth).(is_array($data) ? '- ' : '  ').$c_key.': null';
      elseif ($c_value === false)  $result[] = str_repeat('  ', $depth).(is_array($data) ? '- ' : '  ').$c_key.': false';
      elseif ($c_value === true)   $result[] = str_repeat('  ', $depth).(is_array($data) ? '- ' : '  ').$c_key.': true';
      else                         $result[] = str_repeat('  ', $depth).(is_array($data) ? '- ' : '  ').$c_key.': '.$c_value;
    }
    return implode(nl, $result);
  }

  # ┌─────────────────────╥───────────────────────────────────────────────────────┐
  # │ valid strings       ║ interpretation                                        │
  # ╞═════════════════════╬═══════════════════════════════════════════════════════╡
  # │ root                ║                                                       │
  # │ - name: value       ║ root[name]  = value:null|string|float|integer|boolean │
  # │   name: value       ║ root->name  = value:null|string|float|integer|boolean │
  # │ - =: value          ║ root[value] = value:null|string|float|integer|boolean │
  # │   =: value          ║ root->value = value:null|string|float|integer|boolean │
  # │ - name              ║ root[name]  = new stdClass | […]                      │
  # │   name              ║ root->name  = new stdClass | […]                      │
  # │ - name|classname    ║ root[name]  = new classname                           │
  # │   name|classname    ║ root->name  = new classname                           │
  # │ - name|_empty_array ║ root[name]  = []                                      │
  # │   name|_empty_array ║ root->name  = []                                      │
  # └─────────────────────╨───────────────────────────────────────────────────────┘

  static function text_to_data($data, $file = null) {
    $result = new \stdClass;
    $p = [-1 => &$result];
    $postconstructor_objects = [];
    $postinit_objects        = [];
    $postparse_objects       = [];
    $line_number = 0;
    foreach (explode(nl, preg_replace('%\n[!]+%', '', $data)) as $c_line) {
      $line_number++;
    # skip comments
      if (substr(ltrim($c_line, ' '), 0, 1) === '#') continue;
      $matches = [];
      preg_match('%^(?<indent>[ ]*)'.
                   '(?<prefix>- |)'.
                   '(?<name>.+?)'.
                   '(?<delimiter>(?<!\\\\): |(?<!\\\\)\\||$)'.
                   '(?<value>.*)$%S', $c_line, $matches);
      if (strlen($matches['name'])) {
        $c_prefix    = $matches['prefix'];
        $c_depth     = intval(strlen($matches['indent'].$c_prefix) / 2);
        $c_name      = str_replace(['\\:', '\\|'], [':', '|'], $matches['name']);
        $c_delimiter = $matches['delimiter'];
        $c_value     = $matches['value'];
        if ($c_name == '=') $c_name = $c_value;
      # define each value
        if ($c_delimiter == ': ') {
          $c_value = core::string_to_data($c_value);
        } else {
          if ($c_value == '_empty_array') {
            $c_value = [];
          } else {
            $c_class_name = $c_value ? '\\effcore\\'.$c_value : 'stdClass';
            $c_reflection = new \ReflectionClass($c_class_name);
            $c_is_postconstructor = $c_reflection->implementsInterface('\\effcore\\has_postconstructor');
            $c_is_postinit        = $c_reflection->implementsInterface('\\effcore\\has_postinit');
            $c_is_postparse       = $c_reflection->implementsInterface('\\effcore\\has_postparse');
            if ($c_is_postconstructor)
                 $c_value = core::class_instance_new_get($c_class_name);
            else $c_value = core::class_instance_new_get($c_class_name, [], true);
            if ($c_is_postconstructor) $postconstructor_objects[] = $c_value;
            if ($c_is_postinit)        $postinit_objects[]        = $c_value;
            if ($c_is_postparse)       $postparse_objects[]       = $c_value;
          }
        }
      # add new item to tree
        if (!($c_value instanceof \stdClass && is_object($p[$c_depth-1]) &&  property_exists($p[$c_depth-1], $c_name) && is_array($p[$c_depth-1]->{$c_name})) &&
            !($c_value instanceof \stdClass &&  is_array($p[$c_depth-1]) && array_key_exists($c_name, $p[$c_depth-1]) && is_array($p[$c_depth-1]  [$c_name])))
          core::arrobj_value_insert($p[$c_depth-1], $c_name, $c_value);
        $p[$c_depth] = &core::arrobj_value_select($p[$c_depth-1], $c_name);
      # convert parent item to array
        if ($c_prefix == '- ' && !is_array($p[$c_depth-1])) {
          $p[$c_depth-1] = (array)$p[$c_depth-1];
        }
      } else {
        $messages = ['Function: text_to_data', 'Wrong syntax in data at line: '.$line_number];
        if ($file) $messages[] = 'File relative path: '.$file->path_relative_get();
        message::insert(implode(br, $messages), 'error');
      }
    }
  # call the interface dependent functions
    foreach ($postconstructor_objects as $c_object) $c_object->__construct();
    foreach ($postinit_objects        as $c_object) $c_object->_postinit();
    foreach ($postparse_objects       as $c_object) $c_object->_postparse();
    return $result;
  }

}}