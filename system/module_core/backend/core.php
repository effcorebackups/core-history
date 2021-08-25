<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class core {

  const date_period_h = 60 * 60;
  const date_period_d = 60 * 60 * 24;
  const date_period_w = 60 * 60 * 24 * 7;
  const date_period_m = 60 * 60 * 24 * 30;
  const empty_ip = '::';
  const diagram_colors = [
    'chocolate',
    'darkorange',
    'limegreen',
    'aquamarine',
    'dodgerblue',
    'tomato',
    'yellowgreen',
    'gold',
    'lightcoral',
    'crimson'
  ];

  ####################
  ### boot modules ###
  ####################

  static function boot_select($type = 'enabled') {
    $boot = data::select('boot');
    return $boot->{'modules_'.$type} ?? [];
  }

  static function boot_insert($module_id, $module_path, $type) {
    $boot = data::select('boot') ?: new \stdClass;
    $boot_buffer = [];
    if ($boot && isset($boot->{'modules_'.$type}))
        $boot_buffer = $boot->{'modules_'.$type};
    $boot_buffer[$module_id] = $module_path;
    asort($boot_buffer);
    $boot->{'modules_'.$type} = $boot_buffer;
    return data::update('boot', $boot, '', ['build_date' => static::datetime_get()]);
  }

  static function boot_delete($module_id, $type) {
    $boot = data::select('boot') ?: new \stdClass;
    $boot_buffer = [];
    if ($boot && isset($boot->{'modules_'.$type}))
        $boot_buffer = $boot->{'modules_'.$type};
    unset($boot_buffer[$module_id]);
    $boot->{'modules_'.$type} = $boot_buffer;
    return data::update('boot', $boot, '', ['build_date' => static::datetime_get()]);
  }

  ###############################################
  ### functionality for class|trait|interface ###
  ###############################################

  static function structure_autoload($name) {
    $name = strtolower($name);
    if ($name === 'effcore\\cache'              ) {require_once(dir_system.'module_core/backend/cache.php'                          ); console::log_insert('file', 'insertion', 'system/module_core/backend/cache.php',                           'ok'); return;}
    if ($name === 'effcore\\console'            ) {require_once(dir_system.'module_core/backend/console.php'                        ); console::log_insert('file', 'insertion', 'system/module_core/backend/console.php',                         'ok'); return;}
    if ($name === 'effcore\\data'               ) {require_once(dir_system.'module_core/backend/data.php'                           ); console::log_insert('file', 'insertion', 'system/module_core/backend/data.php',                            'ok'); return;}
    if ($name === 'effcore\\dynamic'            ) {require_once(dir_system.'module_core/backend/dynamic.php'                        ); console::log_insert('file', 'insertion', 'system/module_core/backend/dynamic.php',                         'ok'); return;}
    if ($name === 'effcore\\file'               ) {require_once(dir_system.'module_core/backend/file.php'                           ); console::log_insert('file', 'insertion', 'system/module_core/backend/file.php',                            'ok'); return;}
    if ($name === 'effcore\\markup'             ) {require_once(dir_system.'module_page/backend/pattern--markup.php'                ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--markup.php',                 'ok'); return;}
    if ($name === 'effcore\\message'            ) {require_once(dir_system.'module_core/backend/pattern--message.php'               ); console::log_insert('file', 'insertion', 'system/module_core/backend/pattern--message.php',                'ok'); return;}
    if ($name === 'effcore\\module_as_profile'  ) {require_once(dir_system.'module_core/backend/pattern--module_as_profile.php'     ); console::log_insert('file', 'insertion', 'system/module_core/backend/pattern--module_as_profile.php',      'ok'); return;}
    if ($name === 'effcore\\module_embedded'    ) {require_once(dir_system.'module_core/backend/pattern--module_embedded.php'       ); console::log_insert('file', 'insertion', 'system/module_core/backend/pattern--module_embedded.php',        'ok'); return;}
    if ($name === 'effcore\\module'             ) {require_once(dir_system.'module_core/backend/pattern--module.php'                ); console::log_insert('file', 'insertion', 'system/module_core/backend/pattern--module.php',                 'ok'); return;}
    if ($name === 'effcore\\node_simple'        ) {require_once(dir_system.'module_page/backend/pattern--node_simple.php'           ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--node_simple.php',            'ok'); return;}
    if ($name === 'effcore\\node'               ) {require_once(dir_system.'module_page/backend/pattern--node.php'                  ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--node.php',                   'ok'); return;}
    if ($name === 'effcore\\storage_nosql_files') {require_once(dir_system.'module_storage/backend/pattern--storage_nosql_files.php'); console::log_insert('file', 'insertion', 'system/module_storage/backend/pattern--storage_nosql_files.php', 'ok'); return;}
    if ($name === 'effcore\\text_multiline'     ) {require_once(dir_system.'module_page/backend/pattern--text_multiline.php'        ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--text_multiline.php',         'ok'); return;}
    if ($name === 'effcore\\text_simple'        ) {require_once(dir_system.'module_page/backend/pattern--text_simple.php'           ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--text_simple.php',            'ok'); return;}
    if ($name === 'effcore\\text'               ) {require_once(dir_system.'module_page/backend/pattern--text.php'                  ); console::log_insert('file', 'insertion', 'system/module_page/backend/pattern--text.php',                   'ok'); return;}
    if ($name === 'effcore\\timer'              ) {require_once(dir_system.'module_core/backend/timer.php'                          ); console::log_insert('file', 'insertion', 'system/module_core/backend/timer.php',                           'ok'); return;}
    console::log_insert('autoload', 'search', $name, 'ok');
    if (isset(static::structures_select()[$name])) {
      $c_item_info = static::structures_select()[$name];
      $c_file = new file($c_item_info->file);
      $c_file->require();
    }
  }

  static function structures_cache_cleaning_after_on_install() {
    foreach (static::structures_select() as $c_full_name => $c_structure) {
      if (isset($c_structure->implements['effcore\\should_clear_cache_after_on_install'])) {
        $c_full_name::cache_cleaning();
      }
    }
  }

  static function structures_select($modules_to_include = []) {
    $result = cache::select('structures') ?? [];
    if ($result) {
      return $result;
    } else {
      $files        = [];
      $preparse     = storage_nosql_files::data_find_and_parse_modules_and_bundles();
      $modules_path = $preparse->modules_path;
      $enabled      = static::boot_select('enabled') + $modules_to_include; # === module::get_enabled() + $modules_to_include
    # if no modules in the boot (when installing)
      if ($enabled === []) {
        foreach ($preparse->parsed as $c_info) {
          if (!empty($c_info->data->module) &&
                     $c_info->data->module->enabled === 'yes') {
            $enabled[$c_info->data->module->id] = $c_info->data->module->path;
          }
        }
      }
      arsort($enabled);
    # collect *.php files
      foreach ($enabled as $c_enabled_path) {
        $c_files = file::select_recursive($c_enabled_path, '%^.*\\.php$%');
        foreach ($c_files as $c_path_relative => $c_file) {
          $c_module_id = key(static::in_array_strpos($c_path_relative, $modules_path));
          if (isset($enabled[$c_module_id])) {
            $files[$c_path_relative] = $c_file;
          }
        }
      }
    # parse each collected file
      foreach ($files as $c_file) {
        $c_matches = [];
        preg_match_all('%(?:namespace (?<namespace>[a-zA-Z0-9_\\\\]+)\\s*[{;]\\s*(?<use>.*?|)|)\\s*'.
                                     '(?<modifier>abstract|final|)\\s*'.
                                     '(?<type>class|trait|interface)\\s+'.
                                     '(?<name>[a-zA-Z0-9_]+)\\s*'.
                          '(?:extends (?<extends>[a-zA-Z0-9_\\\\]+)|)\\s*'.
                       '(?:implements (?<implements>[a-zA-Z0-9_,\\s\\\\]+)|)\\s*{%sS', $c_file->load(), $c_matches, PREG_SET_ORDER);
        foreach ($c_matches as $c_match) {
          if (!empty($c_match['name'])) {
            $c_item = new \stdClass;
          # define modifier (abstract|final)
            if (!empty($c_match['modifier'])) {
              $c_item->modifier = $c_match['modifier'];
            }
          # define namespace, name, type = class|trait|interface
            $c_item->namespace = !empty($c_match['namespace']) ? $c_match['namespace'] : '';
            $c_item->name = $c_match['name'];
            $c_item->type = $c_match['type'];
          # define parent class
            if (!empty($c_match['extends'])) {
              if ($c_match['extends'][0] === '\\')
                   $c_item->extends = ltrim($c_match['extends'], '\\');
              else $c_item->extends = ltrim($c_item->namespace.'\\'.$c_match['extends'], '\\');
            }
          # define implements interfaces
            if (!empty($c_match['implements'])) {
              foreach (explode(',', $c_match['implements']) as $c_implement) {
                $c_implement = trim($c_implement);
                if ($c_implement[0] === '\\')
                     $c_implement = ltrim($c_implement, '\\');
                else $c_implement = ltrim($c_item->namespace.'\\'.$c_implement, '\\');
                $c_item->implements[$c_implement] = $c_implement;
              }
            }
          # define file path
            $c_item->file = $c_file->path_get_relative();
          # insert to result pool
            if (!$c_item->namespace)
                 $result[strtolower(                        $c_item->name)] = $c_item;
            else $result[strtolower($c_item->namespace.'\\'.$c_item->name)] = $c_item;
          }
        }
      }
      ksort($result);
      cache::update('structures', $result, '', ['build_date' => static::datetime_get()]);
      return $result;
    }
  }

  static function structure_is_exists($name) {
    $name = trim(strtolower($name), '\\');
    if (isset(static::structures_select()[$name])) {
      return true;
    }
  }

  static function structure_is_local($name) {
    $parts = static::structure_get_parts($name);
    return $parts[0] === 'effcore';
  }

  static function structure_get_parts($name) {
    return explode('\\', trim($name, '\\'));
  }

  static function structure_get_part_name($name) {
    $parts = static::structure_get_parts($name);
    return end($parts);
  }

  static function class_get_new_instance($name, $args = [], $use_constructor = false) {
    $reflection = new \ReflectionClass($name);
    return $use_constructor ? $reflection->newInstanceArgs($args) :
                              $reflection->newInstanceWithoutConstructor();
  }

  static function is_handler($string) {
    return strpos($string, '::') !== false;
  }

  static function handler_exists($handler) {
    return method_exists(static::handler_get_class($handler), static::handler_get_method($handler));
  }

  static function handler_get_class($handler) {
    $parts = explode('::', $handler);
    return $parts[0] ?? null;
  }

  static function handler_get_method($handler) {
    $parts = explode('::', $handler);
    return $parts[1] ?? null;
  }

  ##############################
  ### functionality for data ###
  ##############################

  static function string_to_data($string) {
  # ─────────────────────────────────────────────────────────────────────
  # hexadecimal notation is not allowed (example: '0x123')
  #       octal notation is not allowed (example: '0123')
  #      binary notation is not allowed (example: '0b101')
  # ─────────────────────────────────────────────────────────────────────
    if (is_numeric($string)) return $string += 0;
    if ($string === 'true' ) return true;
    if ($string === 'false') return false;
    if ($string === 'null' ) return null;
    return $string;
  }

  static function data_to_string($data) {
    switch (gettype($data)) {
      case 'string' : return '\''.addcslashes($data, "'\\").'\'';
      case 'boolean': return $data ? 'true' : 'false';
      case 'NULL'   : return 'null';
      case 'object' :
      case 'array'  :
        $expressions = [];
        foreach ($data as $c_key => $c_value) {
          $expressions[] = static::data_to_string($c_key).' => '.
                           static::data_to_string($c_value);
        }
        return gettype($data) === 'object' ?
          '(object)['.implode(', ', $expressions).']' :
                  '['.implode(', ', $expressions).']';
      default: return (string)$data;
    }
  }

  static function data_to_code($data, $prefix = '', $array_defaults = null) {
    $result = '';
    switch (gettype($data)) {
      case 'array':
        if (count($data)) {
          foreach ($data as $c_key => $c_value) {
            if (is_array($array_defaults) && array_key_exists($c_key,
                         $array_defaults) &&
                         $array_defaults[$c_key] === $c_value) continue;
            $result.= static::data_to_code($c_value, $prefix.(is_int($c_key) ?
                                                                 '['.$c_key.']' :
                                                   '[\''.addcslashes($c_key, "'\\").'\']'));
          }
        } else {
          $result.= $prefix.' = [];'.nl;
        }
        break;
      case 'object':
        $class_name = get_class($data);
        $reflection = new \ReflectionClass($class_name);
        $defaults           = $reflection->getDefaultProperties();
        $is_postconstructor = $reflection->implementsInterface('\\effcore\\has_postconstructor');
        $is_postinit        = $reflection->implementsInterface('\\effcore\\has_postinit'       );
        if ($is_postconstructor)
             $result = $prefix.' = core::class_get_new_instance(\''.addcslashes('\\'.$class_name, "'\\").'\');'.nl;
        else $result = $prefix.' = new \\'.$class_name.';'.nl;
        foreach ($data as $c_key => $c_value) {
          if (array_key_exists($c_key, $defaults) && $defaults[$c_key] === $c_value) continue;
          $result.= static::data_to_code($c_value, $prefix.'->'.$c_key, $defaults[$c_key] ?? null);
        }
        if ($is_postconstructor) $result.= $prefix.'->__construct();'.nl;
        if ($is_postinit)        $result.= $prefix.  '->_postinit();'.nl;
        break;
      case 'string' : $result.= $prefix.' = '.'\''.addcslashes($data, "'\\").'\';'.nl; break;
      case 'boolean': $result.= $prefix.' = '.($data ? 'true' : 'false').';'.nl;       break;
      case 'NULL'   : $result.= $prefix.' = null;'.nl;                                 break;
      default       : $result.= $prefix.' = '.(string)$data.';'.nl;
    }
    return $result;
  }

  static function data_to_attr($data, $is_xml_style = false, $join_part = ' ', $name_wrapper = '', $value_wrapper = '"') {
    $result = [];
    foreach ((array)$data as $c_name => $c_value) {
      if ($is_xml_style && $c_value === true) $c_value = $c_name;
      switch (gettype($c_value)) {
        case 'NULL'   :                                                                                                                                                                                            break;
        case 'boolean': if ($c_value) $result[] = $name_wrapper.$c_name.$name_wrapper;                                                                                                                             break;
        case 'array'  :               $result[] = $name_wrapper.$c_name.$name_wrapper.'='.$value_wrapper.str_replace('"', '&quot;',                         implode(' ', $c_value)               ).$value_wrapper; break;
        case 'object' :               $result[] = $name_wrapper.$c_name.$name_wrapper.'='.$value_wrapper.str_replace('"', '&quot;', (method_exists($c_value, 'render') ? $c_value->render() : '')).$value_wrapper; break;
        default       :               $result[] = $name_wrapper.$c_name.$name_wrapper.'='.$value_wrapper.str_replace('"', '&quot;',                                      $c_value                ).$value_wrapper; break;
      }
    }
    if ($join_part) return implode($join_part, $result);
    else            return                     $result;
  }

  static function data_serialize($data, $is_effective = true) {
    $result = '';
    switch (gettype($data)) {
      case 'string' : return 's:'.strlen($data).':"'.$data            .'";';
      case 'boolean': return 'b:'.                  ($data ? '1' : '0').';';
      case 'integer': return 'i:'.                   $data             .';';
      case 'double' : return 'd:'.                   $data             .';';
      case 'NULL'   : return 'N'                                       .';';
      case 'array'  :
        $result_children = [];
        foreach ($data as $c_key => $c_val) {
        $result_children[] = static::data_serialize($c_key, $is_effective);
        $result_children[] = static::data_serialize($c_val, $is_effective);}
        $result = 'a:'.count($data).':{'.implode('', $result_children).'}';
        break;
      case 'object':
        $class_name = get_class($data);
        $reflection = new \ReflectionClass($class_name);
        $defaults = $reflection->getDefaultProperties();
        $result_children = [];
        foreach ($data as $c_key => $c_val) {
          if ($is_effective && array_key_exists($c_key,  $defaults)
                            &&        $defaults[$c_key] === $c_val) continue;
        $result_children[] = static::data_serialize($c_key, $is_effective);
        $result_children[] = static::data_serialize($c_val, $is_effective);}
        $result = 'O:'.strlen($class_name).':"'.
                              $class_name.'":'.(int)(count($result_children) / 2).':{'.
                                               implode('', $result_children).'}';
        break;
      default:
    }
    return $result;
  }

  ################################
  ### functionality for arrays ###
  ################################

  static function array_rotate($data) {
    $result = [];
    foreach ($data as $c_row) {                  # convert │1│2│ to │1│3│
      for ($i = 0; $i < count($c_row); $i++) {   #         │3│4│    │2│4│
        $result[$i][] = $c_row[$i];
      }
    }
    return $result;
  }

  # ┌───────────────────────────────────┐  ┌─────────┐  ┌────────┐  ┌───────┐  ┌──────┐  ┌─────┐  ┌────┐  ┌───┐  ┌──┐  ┌─┐
  # │ weight scale by element direction │  │123456789│  │12345678│  │1234567│  │123456│  │12345│  │1234│  │123│  │12│  │1│
  # ╞═══════════════════════════════════╡  │         │  │9       │  │89     │  │789   │  │6789 │  │5678│  │456│  │34│  │2│
  # │                 │ +100            │  │         │  │        │  │       │  │      │  │     │  │9   │  │789│  │56│  │3│
  # │                 │                 │  │         │  │        │  │       │  │      │  │     │  │    │  │   │  │78│  │4│
  # │                 │                 │  │         │─▶│        │─▶│       │─▶│      │─▶│     │─▶│    │─▶│   │─▶│9 │─▶│5│
  # │ ────────────────┼───────────────▶ │  │         │  │        │  │       │  │      │  │     │  │    │  │   │  │  │  │6│
  # │ +100            │ 0          -100 │  │         │  │        │  │       │  │      │  │     │  │    │  │   │  │  │  │7│
  # │                 │                 │  │         │  │        │  │       │  │      │  │     │  │    │  │   │  │  │  │8│
  # │                 ▼ -100            │  │         │  │        │  │       │  │      │  │     │  │    │  │   │  │  │  │9│
  # └───────────────────────────────────┘  └─────────┘  └────────┘  └───────┘  └──────┘  └─────┘  └────┘  └───┘  └──┘  └─┘

  static function array_sort_text(&$array, $order = 'd', $translated = true) {
    uasort($array, function ($a, $b) use ($order, $translated) {
      if ($order === 'a' && $translated === false) return                    $b  <=>                    $a;
      if ($order === 'd' && $translated === false) return                    $a  <=>                    $b;
      if ($order === 'a' && $translated)           return translation::apply($b) <=> translation::apply($a);
      if ($order === 'd' && $translated)           return translation::apply($a) <=> translation::apply($b);
    });
    return $array;
  }

  static function array_sort_by_text_property(&$array, $property = 'title', $order = 'd', $translated = true) {
    uasort($array, function ($a, $b) use ($property, $order, $translated) {
      if ($order === 'a' && $translated === false) return                    $b->{$property}  <=>                    $a->{$property};
      if ($order === 'd' && $translated === false) return                    $a->{$property}  <=>                    $b->{$property};
      if ($order === 'a' && $translated)           return translation::apply($b->{$property}) <=> translation::apply($a->{$property});
      if ($order === 'd' && $translated)           return translation::apply($a->{$property}) <=> translation::apply($b->{$property});
    });
    return $array;
  }

  static function array_sort_by_property(&$array, $property, $order = 'a') {
    uasort($array, function ($a, $b) use ($property, $order) {
      if ($order === 'a') return $b->{$property} <=> $a->{$property};
      if ($order === 'd') return $a->{$property} <=> $b->{$property};
    });
    return $array;
  }

  static function array_sort_by_weight(&$array, $corrector = .001) {
    $c_weight = 0;                # if $array[n].weight === 0 && $array[n+1].weight === 0, the relative
    foreach ($array as $c_item)   # order of these items in the sorted array will be undefined.
      if ($c_item->weight === 0)  # we should preprocess items with weight = 0 before sorting
          $c_item->weight = $c_weight -= $corrector;
    return static::array_sort_by_property($array, 'weight', 'a');
  }

  static function array_kmap($array) {
    return array_combine($array, $array);
  }

  static function array_values_select_recursive(&$array, $all = false, $dpath = '') {
    $result = [];
    foreach ($array as $c_key => &$c_value) {
      $c_dpath = $dpath ? $dpath.'/'.$c_key : $c_key;
      if (is_array($c_value)                 ) $result += static::array_values_select_recursive($c_value, $all, $c_dpath);
      if (is_array($c_value) == false || $all) $result[$c_dpath] =                             &$c_value;
    }
    return $result;
  }

  static function in_array_string($value, $array) {
    foreach ($array as $c_value) {
      if ((string)$value === (string)$c_value) {
        return true;
      }
    }
  }

  static function in_array_strpos($value, $array) {
    $result = [];
    foreach ($array as $c_key => $c_value) {
      if (strpos($value, (string)$c_value) === 0) {
        $result[$c_key] = $c_value;
      }
    }
    return $result;
  }

  static function array_key_first($array) { # alternative for built-in 'array_key_first' in PHP v.7.3+
    $keys = array_keys($array);
    return count($keys) ?
           reset($keys) : null;
  }

  static function array_key_last($array) { # alternative for built-in 'array_key_last' in PHP v.7.3+
    $keys = array_keys($array);
    return count($keys) ?
             end($keys) : null;
  }

  #############################################
  ### functionality for mix of array|object ###
  #############################################

  static function &arrobj_select_value(&$data, $name) {
    if (is_array ($data)) return $data  [$name];
    if (is_object($data)) return $data->{$name};
  }

  static function arrobj_insert_value(&$data, $name, $value) {
    if (is_array ($data)) $data  [$name] = $value;
    if (is_object($data)) $data->{$name} = $value;
  }

  static function arrobj_delete_child(&$data, $name) {
    if (is_array ($data)) unset($data  [$name]);
    if (is_object($data)) unset($data->{$name});
  }

  static function arrobj_select_values_recursive(&$data, $all = false, $dpath = '') {
    $result = [];
    foreach ($data as $c_key => &$c_value) {
      $c_dpath = $dpath ? $dpath.'/'.$c_key : $c_key;
      if ((is_array($c_value) || is_object($c_value))                 ) $result += static::arrobj_select_values_recursive($c_value, $all, $c_dpath);
      if ((is_array($c_value) || is_object($c_value)) == false || $all) $result[$c_dpath] =                              &$c_value;
    }
    return $result;
  }

  #################################################################
  ### functionality for dpath (data path) and npath (node path) ###
  #################################################################

  static function dpath_get_pointers(&$data, $dpath, $is_unique_keys = false) {
    $result = [];
    $c_pointer = $data;
    foreach (explode('/', $dpath) as $c_part) {
      $c_pointer = &static::arrobj_select_value($c_pointer, $c_part);
      if ($is_unique_keys) $result[       ] = &$c_pointer;
      else                 $result[$c_part] = &$c_pointer;
    }
    return $result;
  }

  static function npath_get_pointers(&$node, $npath, $is_unique_keys = false) {
    $result = [];
    $c_pointer = $node;
    foreach (explode('/', $npath) as $c_part) {
      $c_pointer = &$c_pointer->children[$c_part];
      if ($is_unique_keys) $result[       ] = &$c_pointer;
      else                 $result[$c_part] = &$c_pointer;
    }
    return $result;
  }

  static function path_get_depth($path) {
    return count_chars($path, 1)[ord('/')] ?? 0;
  }

  ###################################
  ### functionality for date|time ###
  ###################################

  # examples of using:
  # ┌───────────────────────────────────────────────────────┬─────────────┬─────────────────────┐
  # │ +14:00 — Pacific/Kiritimati                           │ to format   │ result              │
  # ╞═══════════════════════════════════════════════════════╪═════════════╪═════════════════════╡
  # │           locale::format_date ('2030-02-01')          │ d.m.Y       │ 01.02.2030          │
  # │           locale::format_time ('01:02:03')            │ H:i:s       │ 15:02:03            │
  # │       locale::format_datetime ('2030-02-01 01:02:03') │ d.m.Y H:i:s │ 01.02.2030 15:02:03 │
  # │       locale::format_timestmp (0)                     │ d.m.Y H:i:s │ 01.01.1970 14:00:00 │
  # ├───────────────────────────────────────────────────────┼─────────────┼─────────────────────┤
  # │       locale::date_utc_to_loc ('2030-02-01')          │ Y-m-d       │ 2030-02-01          │
  # │       locale::time_utc_to_loc ('01:02:03')            │ H:i:s       │ 15:02:03            │
  # │   locale::datetime_utc_to_loc ('2030-02-01 01:02:03') │ Y-m-d H:i:s │ 2030-02-01 15:02:03 │
  # ├───────────────────────────────────────────────────────┼─────────────┼─────────────────────┤
  # │       locale::date_loc_to_utc ('2030-02-01')          │ Y-m-d       │ 2030-02-01          │
  # │       locale::time_loc_to_utc ('15:02:03')            │ H:i:s       │ 01:02:03            │
  # │   locale::datetime_loc_to_utc ('2030-02-01 15:02:03') │ Y-m-d H:i:s │ 2030-02-01 01:02:03 │
  # └───────────────────────────────────────────────────────┴─────────────┴─────────────────────┘
  #
  # ┌───────────────────────────────────────────────────────┬─────────────┬─────────────────────┐
  # │ -11:00 — Pacific/Pago_Pago                            │ to format   │ result              │
  # ╞═══════════════════════════════════════════════════════╪═════════════╪═════════════════════╡
  # │           locale::format_date ('2030-02-01')          │ d.m.Y       │ 01.02.2030          │
  # │           locale::format_time ('01:02:03')            │ H:i:s       │ 14:02:03            │
  # │       locale::format_datetime ('2030-02-01 01:02:03') │ d.m.Y H:i:s │ 31.01.2030 14:02:03 │
  # │       locale::format_timestmp (0)                     │ d.m.Y H:i:s │ 31.12.1969 13:00:00 │
  # ├───────────────────────────────────────────────────────┼─────────────┼─────────────────────┤
  # │       locale::date_utc_to_loc ('2030-02-01')          │ Y-m-d       │ 2030-02-01          │
  # │       locale::time_utc_to_loc ('01:02:03')            │ H:i:s       │ 14:02:03            │
  # │   locale::datetime_utc_to_loc ('2030-02-01 01:02:03') │ Y-m-d H:i:s │ 2030-01-31 14:02:03 │
  # ├───────────────────────────────────────────────────────┼─────────────┼─────────────────────┤
  # │       locale::date_loc_to_utc ('2030-02-01')          │ Y-m-d       │ 2030-02-01          │
  # │       locale::time_loc_to_utc ('14:02:03')            │ H:i:s       │ 01:02:03            │
  # │   locale::datetime_loc_to_utc ('2030-01-31 14:02:03') │ Y-m-d H:i:s │ 2030-02-01 01:02:03 │
  # └───────────────────────────────────────────────────────┴─────────────┴─────────────────────┘
  #
  # ┌───────────────────────────────────────────────────────┬─────────────┬─────────────────────┐
  # │                                                       │ to format   │ result              │
  # ╞═══════════════════════════════════════════════════════╪═════════════╪═════════════════════╡
  # │   core::T_datetime_to_datetime('2030-02-01T01:02:03') │ Y-m-d H:i:s │ 2030-02-01 01:02:03 │
  # │   core::datetime_to_T_datetime('2030-02-01 01:02:03') │ Y-m-dTH:i:s │ 2030-02-01T01:02:03 │
  # └───────────────────────────────────────────────────────┴─────────────┴─────────────────────┘
  #
  # note: each function 'locale::*_format' uses local date/time format settings
  # that have been set on the page '/manage/locale'

  static function timezone_get_client() {return user::get_current()->timezone ?? 'UTC';}
  static function timezone_get_offset_sec($name = 'UTC') {return (new \DateTimeZone($name))->getOffset(new \DateTime);}
  static function timezone_get_offset_tme($name = 'UTC') {return (new \DateTime('now', new \DateTimeZone($name)))->format('P');}

  static function T_datetime_to_datetime($datetime) {$date = \DateTime::createFromFormat('Y-m-d\\TH:i:s', $datetime, new \DateTimeZone('UTC') ); if ($date) return $date->format('Y-m-d H:i:s'  );}
  static function datetime_to_T_datetime($datetime) {$date = \DateTime::createFromFormat('Y-m-d H:i:s',   $datetime, new \DateTimeZone('UTC') ); if ($date) return $date->format('Y-m-d\\TH:i:s');}

  static function date_get           ($offset = '', $format = 'Y-m-d'        ) {return (new \DateTime('now', new \DateTimeZone('UTC')))->modify( $offset ?: '+0' )->format( $format );}
  static function time_get           ($offset = '', $format =       'H:i:s'  ) {return (new \DateTime('now', new \DateTimeZone('UTC')))->modify( $offset ?: '+0' )->format( $format );}
  static function datetime_get       ($offset = '', $format = 'Y-m-d H:i:s'  ) {return (new \DateTime('now', new \DateTimeZone('UTC')))->modify( $offset ?: '+0' )->format( $format );}
  static function T_datetime_get     ($offset = '', $format = 'Y-m-d\\TH:i:s') {return (new \DateTime('now', new \DateTimeZone('UTC')))->modify( $offset ?: '+0' )->format( $format );}

  static function validate_date      ($value) {$result = \DateTime::createFromFormat('Y-m-d',         $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime && strlen($result->format('Y-m-d'        )) === strlen(field_date    ::input_max_date    );}
  static function validate_time      ($value) {$result = \DateTime::createFromFormat(      'H:i:s',   $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime && strlen($result->format(      'H:i:s'  )) === strlen(field_time    ::input_max_time    );}
  static function validate_datetime  ($value) {$result = \DateTime::createFromFormat('Y-m-d H:i:s',   $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime && strlen($result->format('Y-m-d H:i:s'  )) === strlen(field_datetime::input_max_datetime);}
  static function validate_T_datetime($value) {$result = \DateTime::createFromFormat('Y-m-d\\TH:i:s', $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime && strlen($result->format('Y-m-d\\TH:i:s')) === strlen(field_datetime::input_max_datetime);}

  static function sanitize_date      ($value) {$result = \DateTime::createFromFormat('Y-m-d',         $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime ? $result->format('Y-m-d'        ) : null;}
  static function sanitize_time      ($value) {$result = \DateTime::createFromFormat(      'H:i:s',   $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime ? $result->format(      'H:i:s'  ) : null;}
  static function sanitize_datetime  ($value) {$result = \DateTime::createFromFormat('Y-m-d H:i:s',   $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime ? $result->format('Y-m-d H:i:s'  ) : null;}
  static function sanitize_T_datetime($value) {$result = \DateTime::createFromFormat('Y-m-d\\TH:i:s', $value, new \DateTimeZone('UTC')); return $result instanceof \DateTime ? $result->format('Y-m-d\\TH:i:s') : null;}

  ##############
  ### format ###
  ##############

  static function format_number($number, $precision = 0, $dec_point = '.', $thousands = '', $no_zeros = true) {
    $precision = $precision ? $precision + 5 : 0; # disable the rounding effect
    $result = $precision ? substr(
      number_format($number, $precision, $dec_point, $thousands), 0, -5) :
      number_format($number, $precision, $dec_point, $thousands);
    if ($no_zeros && strpos($result, $dec_point) !== false) {
      $result = rtrim($result, '0');
      $result = rtrim($result, $dec_point);
    }
    return $result;
  }

  ###############
  ### filters ###
  ###############

  # number validation matrix: number(n) → is_valid(0|1|2)
  # ┌───────────╥──────────┬───────────┬───────────┬────────────┬───────────┬────────────┬────────────┬─────────────┬────────────┬─────────────┐
  # │           ║          ┊ with '-'  │           ┊ with '-'   │           ┊ with '-'   │            ┊ with '-'    │            ┊ with '-'    │
  # ╞═══════════╬══════════┊═══════════╪═══════════┊════════════╪═══════════┊════════════╪════════════┊═════════════╪════════════┊═════════════╡
  # │           ║ ''   → 0 ┊ '-'   → 0 │ '0'   → 1 ┊ '-0'   → 0 │ '1'   → 1 ┊ '-1'   → 1 │ '01'   → 0 ┊ '-01'   → 0 │ '10'   → 1 ┊ '-10'   → 1 │
  # │ with '.'  ║ '.'  → 0 ┊ '-.'  → 0 │ '0.'  → 0 ┊ '-0.'  → 0 │ '1.'  → 0 ┊ '-1.'  → 0 │ '01.'  → 0 ┊ '-01.'  → 0 │ '10.'  → 0 ┊ '-10.'  → 0 │
  # │ with '.0' ║ '.0' → 0 ┊ '-.0' → 0 │ '0.0' → 1 ┊ '-0.0' → 2 │ '1.0' → 1 ┊ '-1.0' → 1 │ '01.0' → 0 ┊ '-01.0' → 0 │ '10.0' → 1 ┊ '-10.0' → 1 │
  # └───────────╨──────────┴───────────┴───────────┴────────────┴───────────┴────────────┴────────────┴─────────────┴────────────┴─────────────┘

  static function validate_number($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' =>
      '%^(?<integer>[-]{0,1}[1-9][0-9]*|0)$|'.
       '^(?<float_s>[-]{0,1}[0-9]'.   '[.][0-9]{1,})$|'.
       '^(?<float_l>[-]{0,1}[1-9][0-9]+[.][0-9]{1,})$%'
    ]]);
  }

  static function validate_hex_color($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' =>
      '%^#(?<R>[a-f0-9]{2})'.
         '(?<G>[a-f0-9]{2})'.
         '(?<B>[a-f0-9]{2})$%'
    ]]);
  }

  static function validate_email($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  static function validate_hash($value, $length = 32) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '%^[a-f0-9]{'.$length.'}$%']]); # 32 - md5 | 40 - sha1 | …
  }

  static function validate_id($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '%^['.field_id_text::characters_allowed.']+$%']]);
  }

  static function validate_ip_v4($value) {
    return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
  }

  static function validate_ip_v6($value) {
    return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
  }

  static function validate_mime_type($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '%^[a-z]{1,20}/[a-zA-Z0-9\\+\\-\\.]{1,100}$%']]);
  }

  static function validate_nickname($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '%^['.field_nickname::characters_allowed.']{4,32}$%']]);
  }

  static function validate_tel($value) {
    return filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '%^[+][0-9]{1,14}$%']]);
  }

  static function validate_realpath($value) {
    $value = realpath($value);
    if ($value !== false && static::server_os_is_windows())
        $value = str_replace('\\', '/', $value);
    return $value;
  }

  static function validate_url($value, $flags = null) {
    return filter_var($value, FILTER_VALIDATE_URL, $flags);
  }

  static function sanitize_id($value, $corrector = '-') {
    return preg_replace('%[^a-z0-9_\\-]%S', $corrector, strtolower($value));
  }

  static function sanitize_url($value) {
  # remove all characters except: ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_,;:.!?+-*/='"`^~(){}[]<>|\$#@%&
    return filter_var($value, FILTER_SANITIZE_URL);
  }

  static function sanitize_file_part($value, $characters_allowed, $max_length) {
    $value = trim($value, '.');
    $value = preg_replace_callback('%(?<char>[^'.$characters_allowed.'])%uS', function ($c_match) {
      if ($c_match['char'] === ' ') return '-';
      if (strlen($c_match['char']) === 1) return dechex(ord($c_match['char'][0]));
      if (strlen($c_match['char']) === 2) return dechex(ord($c_match['char'][0])).dechex(ord($c_match['char'][1]));
      if (strlen($c_match['char']) === 3) return dechex(ord($c_match['char'][0])).dechex(ord($c_match['char'][1])).dechex(ord($c_match['char'][2]));
      if (strlen($c_match['char']) === 4) return dechex(ord($c_match['char'][0])).dechex(ord($c_match['char'][1])).dechex(ord($c_match['char'][2])).dechex(ord($c_match['char'][3]));
    }, $value);
    $value = substr($value, 0, $max_length);
    return $value;
  }

  ##############################################
  ### functionality for signatures|keys|hash ###
  ##############################################

  # hash performance (1 millon iterations):
  # ┌───────────────────╥─────────────┬────────┬─────────────────────────┐
  # │ function          ║ time (sec.) │ is hex │ has 32-bit sign problem │
  # ╞═══════════════════╬═════════════╪════════╪═════════════════════════╡
  # │ crc32(…)          ║ 2.461183    │ no     │ yes                     │
  # │ hash('crc32b', …) ║ 2.632847    │ yes    │ no                      │
  # │ md5(…)            ║ 2.682224    │ yes    │ no                      │
  # │ sha1(…)           ║ 2.704381    │ yes    │ no                      │
  # └───────────────────╨─────────────┴────────┴─────────────────────────┘

  static function random_part_get() {
    $hex_time = str_pad(dechex(time()),                    8, '0', STR_PAD_LEFT);
    $hex_rand = str_pad(dechex(random_int(0, 0x7fffffff)), 8, '0', STR_PAD_LEFT);
    return $hex_time.$hex_rand;
  }

  static function signature_get($string, $key_name, $length = 40) {
    $key = static::key_get($key_name);
    if ($key) return substr(sha1($string.$key), 0, $length);
    else message::insert(new text('Key "%%_key" does not exist!', ['key' => $key_name]), 'error');
  }

  static function key_get($name) {
    return storage::get('files')->select('settings/core/keys/'.$name);
  }

  static function key_generate($is_hash_compatible = false, $length = 40) {
    $characters = $is_hash_compatible ?
      ['a', 'b', 'c', 'd', 'e', 'f', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'] :
      ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
       'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
       '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '$', '%', '&', '_', '*', '-', '+', '=', ':', ';', '!', '?', '~', '^'];
    shuffle($characters);
    $result = '';
    for ($i = 0; $i < $length; $i++) {
      $result.= $characters[
        random_int(0, count($characters) - 1)
      ];
    }
    return $result;
  }

  static function password_generate($length = 8) {
  # exclude to avoid misunderstanding: '0', 'O', 'o', 'L', 'l', 'I', 'i'
  # exclude to avoid emailing problem: '$', '&', '~', '^'
    $characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                   'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                   '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '%', '_', '*', '-', '+', '=', ':', ';', '!', '?'];
    shuffle($characters);
    $result = '';
    for ($i = 0; $i < $length; $i++) {
      $result.= $characters[
        random_int(0, count($characters) - 1)
      ];
    }
    return $result;
  }

  static function password_get_hash($data) {
    return sha1(sha1($data).static::key_get('salt'));
  }

  static function password_verify($password, $hash) {
    return hash_equals($hash, static::password_get_hash($password));
  }

  static function hash_get($data) {
    if (gettype($data) === 'string')
         return md5($data);
    else return md5(serialize($data));
  }

  static function hash_get_mini($data, $length = 8) {
    return substr(static::hash_get($data), 0, $length);
  }

  ########################
  ### bytes conversion ###
  ########################

  static function is_abbreviated_bytes($number) {
    $character = substr($number, -1);
    return in_array($character, ['B', 'K', 'M', 'G', 'T']);
  }

  static function abbreviated_to_bytes($abbreviated) {
    $powers = array_flip(['B', 'K', 'M', 'G', 'T']);
    $character = strtoupper(substr($abbreviated, -1));
    $value = (int)substr($abbreviated, 0, -1);
    return $value * 1024 ** $powers[$character];
  }

  static function bytes_to_abbreviated($bytes, $is_iec = false) {
    if ($bytes && fmod($bytes, 1024 ** 4) === .0) return ($bytes / 1024 ** 4).($is_iec ? 'TiB' : 'T');
    if ($bytes && fmod($bytes, 1024 ** 3) === .0) return ($bytes / 1024 ** 3).($is_iec ? 'GiB' : 'G');
    if ($bytes && fmod($bytes, 1024 ** 2) === .0) return ($bytes / 1024 ** 2).($is_iec ? 'MiB' : 'M');
    if ($bytes && fmod($bytes, 1024 ** 1) === .0) return ($bytes / 1024 ** 1).($is_iec ? 'KiB' : 'K');
    else return $bytes.'B';
  }

  ###############
  ### ini_get ###
  ###############

  static function memory_limit_bytes_get() {
    $value = ini_get('memory_limit');
    if (static::is_abbreviated_bytes($value))
         return static::abbreviated_to_bytes($value);
    else return (int)$value;
  }

  static function upload_max_filesize_bytes_get() {
    $value = ini_get('upload_max_filesize');
    if (static::is_abbreviated_bytes($value))
         return static::abbreviated_to_bytes($value);
    else return (int)$value;
  }

  static function post_max_size_bytes_get() {
    $value = ini_get('post_max_size');
    if (static::is_abbreviated_bytes($value))
         return static::abbreviated_to_bytes($value);
    else return (int)$value;
  }

  static function max_file_uploads_get() {
    return ini_get('max_file_uploads');
  }

  static function max_input_time_get() {
    return ini_get('max_input_time');
  }

  static function max_execution_time_get() {
    return ini_get('max_execution_time');
  }

  ############################
  ### functionality for ip ###
  ############################

  static function ip_to_hex($ip, $is_v6 = true, $is_reversed = true) {
    $ip_hex = '';
    $inaddr = inet_pton($ip);
    foreach (str_split($inaddr, 1) as $c_char) {
      $ip_hex.= str_pad(dechex(ord($c_char)), 2, '0', STR_PAD_LEFT);
    }
    if ($is_v6)       $ip_hex = str_pad($ip_hex, 32, '0', STR_PAD_LEFT);
    if ($is_reversed) $ip_hex = strrev ($ip_hex);
    return $ip_hex;
  }

  static function hex_to_ip($ip_hex) {
    $inaddr = '';
    foreach (str_split($ip_hex, 2) as $c_part) {
      $inaddr.= chr(hexdec($c_part));
    }
    return inet_ntop($inaddr);
  }

  #####################################
  ### functionality for binary data ###
  #####################################

  static function binstr_to_hexstr($binstr) {
    $hexstr = '';
    foreach (str_split($binstr, 8) as $c_chunk) {
      $hexstr.= str_pad(base_convert(str_pad($c_chunk, 8, '0'), 2, 16), 2, '0', STR_PAD_LEFT);
    }
    return $hexstr;
  }

  static function hexstr_to_binstr($hexstr) {
    $binstr = '';
    foreach (str_split($hexstr, 2) as $c_chunk) {
      $binstr.= str_pad(base_convert($c_chunk, 16, 2), 8, '0', STR_PAD_LEFT);
    }
    return $binstr;
  }

  ##########################
  ### server information ###
  ##########################

  # ┌─────────────────╥───────┬────────────────╥────────┐
  # │        ╲  modes ║       │                ║        │
  # │ server  ╲       ║ HTTPS │ REQUEST_SCHEME ║ result │
  # ╞═════════════════╬═══════╪════════════════╬════════╡
  # │ Apache v2.4     ║ -     │ http           ║ http   │
  # │ Apache v2.4 SSL ║ on    │ https          ║ https  │
  # │ NGINX  v1.1     ║ -     │ http           ║ http   │
  # │ NGINX  v1.1 SSL ║ on    │ https          ║ https  │
  # │ IIS    v7.5     ║ off   │ -              ║ http   │
  # │ IIS    v7.5 SSL ║ on    │ -              ║ https  │
  # └─────────────────╨───────┴────────────────╨────────┘

  static function server_get_request_scheme() {
    if (isset($_SERVER['REQUEST_SCHEME'])                     ) return $_SERVER['REQUEST_SCHEME'];
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') return 'https';
    return 'http';
  }

  static function server_get_host($decode = false) {
    if ($decode && function_exists('idn_to_utf8') && idn_to_utf8($_SERVER['HTTP_HOST']))
         return idn_to_utf8($_SERVER['HTTP_HOST']);
    else return             $_SERVER['HTTP_HOST'];
  }

  static function server_get_request_uri() {
    if (!empty($_SERVER['IIS_WasUrlRewritten'])) return $_SERVER['UNENCODED_URL'];
    else                                         return $_SERVER[ 'REQUEST_URI' ];
  }

  static function server_get_addr() {
    return $_SERVER['SERVER_ADDR'];
  }

  static function server_get_addr_remote() {
    return $_SERVER['REMOTE_ADDR'];
  }

  static function server_get_user_agent($max_length = 240) {
    return isset($_SERVER['HTTP_USER_AGENT']) ?
          substr($_SERVER['HTTP_USER_AGENT'], 0, $max_length) : '';
  }

  static function server_get_http_range() {
    $result = new \stdClass;
    $result->has_range = false;
    $result->min = null;
    $result->max = null;
    if (isset($_SERVER['HTTP_RANGE'])) {
      $result->has_range = true;
      $matches = [];
      preg_match('%^bytes=(?<min>[0-9]+)-'.
                         '(?<max>[0-9]*)$%', $_SERVER['HTTP_RANGE'], $matches);
      if (array_key_exists('min', $matches) && strlen($matches['min'])) $result->min = (int)$matches['min'];
      if (array_key_exists('max', $matches) && strlen($matches['max'])) $result->max = (int)$matches['max'];
    }
    return $result;
  }

  static function server_get_user_agent_info() {
    $result = new \stdCLass;
    $matches = [];
  # detect Internet Explorer v.6-v.11
  # note: non-existent version like '12' will be identified as '1'
    $ie_core_to_name = ['8' => '11', '7' => '11', '6' => '10', '5' => '9', '4' => '8', '3' => '7', '2' => '6', '1' => '5'];
    $ie_name_to_core = array_flip($ie_core_to_name);
    preg_match('%^(?:.+?(?<name>MSIE) '.'(?<name_v>11|10|9|8|7|6|5|4|3|2|1)|)'.
                 '(?:.+?(?<core>Trident)/(?<core_v>8|7|6|5|4|3|2|1)|)%', static::server_get_user_agent(), $matches);
    $result->name = isset($matches['name']) ? strtolower($matches['name']) : '';
    $result->core = isset($matches['core']) ? strtolower($matches['core']) : '';
    $result->core_version = $matches['core_v'] ?? '';
    $result->name_version = $matches['name_v'] ?? '';
    if ($result->name === '' && $result->core && isset($ie_core_to_name[$matches['core_v']])) {$result->name = 'msie';    $result->name_version = $ie_core_to_name[$matches['core_v']];}
    if ($result->core === '' && $result->name && isset($ie_name_to_core[$matches['name_v']])) {$result->core = 'trident'; $result->core_version = $ie_name_to_core[$matches['name_v']];}
    return $result;
  }

  static function server_get_software() {
    $matches = [];
    preg_match('%^(?<full_name>(?<name>[a-zA-Z0-9\\-]+)/(?<version>[a-zA-Z0-9\\.]+))|'.
                 '(?<full_name_unknown>.*)%', $_SERVER['SERVER_SOFTWARE'], $matches);
    return !empty($matches['full_name']) ? $matches['name'].' '.$matches['version'] :
                  $matches['full_name_unknown'];
  }

  static function server_os_is_windows() {
    return DIRECTORY_SEPARATOR === '\\';
  }

  ########################
  ### shared functions ###
  ########################

  static function strtolower_en($value) {
    return preg_replace_callback('%(?<char>[A-Z])%S', function ($c_match) {
      return strtolower($c_match['char']);
    }, $value);
  }

  static function return_rendered($value) {
    return is_object($value) &&
       method_exists($value, 'render') ?
                     $value-> render() :
                     $value;
  }

  static function return_null_if_empty($value) {
    return $value ?: null;
  }

  static function return_htmlspecialchars_encoded($value) {
    return htmlspecialchars($value, ENT_COMPAT|ENT_HTML5, 'UTF-8');
  }

  static function deep_clone($data, $class_remaping = []) {
    $string = serialize($data);
    foreach ($class_remaping as $c_old_name => $c_new_name) {
      $c_old_name = 'O:'.strlen($c_old_name).':"'.$c_old_name.'"';
      $c_new_name = 'O:'.strlen($c_new_name).':"'.$c_new_name.'"';
      $string = str_replace($c_old_name, $c_new_name, $string);
    }
    return unserialize($string);
  }

  static function send_header_and_exit($type, $title = null, $message = null, $p = '') {
    timer::tap('total');
    if (module::is_enabled('test')) {
      header('X-PHP-Memory-usage: '.memory_get_usage(true));
      header('X-Time-total: '.timer::period_get('total', 0, 1));
    }
    switch ($type) {
      case 'redirect'              : header('Location: '.$p                      );                                                                                      break;
      case 'page_refresh'          : header('Refresh: ' .$p                      );                                                                                      break;
      case 'moved_permanently'     : header('HTTP/1.1 301 Moved Permanently'     ); if (!$title) $title = 'Moved Permanently';                                           break;
      case 'bad_request'           : header('HTTP/1.1 400 Bad Request'           ); if (!$title) $title = 'Bad Request';                                                 break;
      case 'access_forbidden'      : header('HTTP/1.1 403 Forbidden'             ); if (!$title) $title = 'Access forbidden';       $template = 'page_access_forbidden'; break;
      case 'page_not_found'        : header('HTTP/1.0 404 Not Found'             ); if (!$title) $title = 'Page not found';         $template = 'page_not_found';        break;
      case 'file_not_found'        : header('HTTP/1.0 404 Not Found'             ); if (!$title) $title = 'File not found';         $template = 'page_not_found';        break;
      case 'unsupported_media_type': header('HTTP/1.1 415 Unsupported Media Type'); if (!$title) $title = 'Unsupported Media Type';                                      break;
    }
    if (isset($template) && template::get($template)) {
      if (!$message && core::server_get_request_uri() !== '/')
           $message = 'go to <a href="/">front page</a>';
      $settings = module::settings_get('page');
      $colors   = color::get_all();
      $content  = (template::make_new($template, ['attributes' => static::data_to_attr([
        'lang'              => language::code_get_current()]),
        'message'           => is_object($message) && method_exists($message, 'render') ? $message->render() : (new text($message))->render(),
        'title'             => is_object($title  ) && method_exists($title,   'render') ? $title  ->render() : (new text($title  ))->render(),
        'color_page'        => isset($colors[$settings->color__page_id       ]) ? $colors[$settings->color__page_id       ]->value_hex : '',
        'color_text'        => isset($colors[$settings->color__text_id       ]) ? $colors[$settings->color__text_id       ]->value_hex : '',
        'color_link'        => isset($colors[$settings->color__link_id       ]) ? $colors[$settings->color__link_id       ]->value_hex : '',
        'color_link_active' => isset($colors[$settings->color__link_active_id]) ? $colors[$settings->color__link_active_id]->value_hex : '',
        'console'           => console::visible_mode_get() === console::is_visible_for_everyone ? (new markup('pre', [], console::text_get()))->render() : ''
      ]))->render();
      header('Content-Length: '.strlen($content));
      print $content;
      exit();
    } else {
      header('Content-Length: 0');
      exit();
    }
  }

}}