<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

                                                                            
  # html5 elements and attributes support:                                  
  # ┌──────────────────────╥───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┐
  # │      ╲     attribute ║ d │ r │ r │ m │ m │ m │ m │ s │ m │ c │ p │ v │
  # │       ╲              ║ i │ e │ e │ i │ a │ i │ a │ t │ u │ h │ a │ a │
  # │        ╲             ║ s │ a │ q │ n │ x │ n │ x │ e │ l │ e │ t │ l │
  # │         ╲            ║ a │ d │ u │ l │ l │   │   │ p │ t │ c │ t │ u │
  # │          ╲           ║ b │ o │ i │ e │ e │   │   │   │ i │ k │ e │ e │
  # │           ╲          ║ l │ n │ r │ n │ n │   │   │   │ p │ e │ r │   │
  # │            ╲         ║ e │ l │ e │ g │ g │   │   │   │ l │ d │ n │ [ │
  # │             ╲        ║ d │ y │ d │ t │ t │   │   │   │ e │   │   │ ] │
  # │ element      ╲       ║   │   │   │ h │ h │   │   │   │   │   │   │   │
  # ╞══════════════════════╬═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╡
  # │ input:text           ║ + │ + │ + │ x │ + │   │   │   │   │   │ + │ + │
  # │ input:color          ║ + │ x │ x │ x │ x │   │   │   │   │   │ x │ + │
  # │ input:email          ║ + │ + │ + │ x │ + │   │   │   │ + │   │ + │ + │
  # │ input:file           ║ + │   │   │   │   │   │   │   │ + │   │   │ + │
  # │ input:password       ║ + │ + │ + │ x │ + │   │   │   │   │   │ + │ + │
  # │ input:search         ║ + │ + │ + │ x │ + │   │   │   │   │   │ + │ + │
  # │ input:tel            ║ + │ + │ + │ x │ + │   │   │   │   │   │ + │ + │
  # │ input:url            ║ + │ + │ + │ x │ + │   │   │   │   │   │ + │ + │
  # │ input:time           ║ + │ + │ + │ x │ x │ + │ + │ - │   │   │ x │ + │
  # │ input:date           ║ + │ + │ + │ x │ x │ + │ + │ - │   │   │ x │ + │
  # │ input:datetime-local ║ + │ + │ + │ x │ x │ + │ + │ - │   │   │ x │ + │
  # │ input:number         ║ + │ + │ + │ x │ x │ + │ + │ + │   │   │ x │ + │
  # │ input:range          ║ + │ x │ x │ x │ x │ + │ + │ + │   │   │ x │ + │
  # │ textarea             ║ + │ + │ + │ x │ + │   │   │   │   │   │ x │ + │
  # │ select               ║ + │   │ + │   │   │   │   │   │ + │   │   │ + │
  # │ select:option        ║ + │   │   │   │   │   │   │   │   │   │   │   │
  # │ input:checkbox       ║ + │   │ + │   │   │   │   │   │   │ + │   │ + │
  # │ input:radio          ║ + │   │ + │   │   │   │   │   │   │ + │   │ + │
  # │ button:submit        ║ + │   │   │   │   │   │   │   │   │   │   │   │
  # └──────────────────────╨───┴───┴───┴───┴───┴───┴───┴───┴───┴───┴───┴───┘
  # note: x - is extended feature of the system
  # ┌──────────────────────╥────────────────────────────────────────────────┐
  # │ input:hidden         ║ protected from change the value from user side │
  # │ input:button         ║ not processed - use button:button instead      │
  # │ input:reset          ║ not processed - use button:reset instead       │
  # │ input:submit         ║ not processed - use button:submit instead      │
  # │ input:image          ║ not processed - use imgage instead             │
  # │ input:datetime       ║ not processed - use datetime-local instead     │
  # │ input:week           ║ not processed                                  │
  # │ input:month          ║ not processed                                  │
  # └──────────────────────╨────────────────────────────────────────────────┘

namespace effcore {
          class field extends container {

  public $tag_name = 'x-field';
  public $title_tag_name = 'label';
# ─────────────────────────────────────────────────────────────────────
  public $element_class = '\\effcore\\markup_simple';
  public $element_tag_name = 'input';
  public $element_attributes = [];
  public $description_state = 'closed'; # opened | closed[checked] | hidden
  public $set_auto_id = true;
  public $has_error = false;
  public $entity_name;
  public $entity_field_name;
  protected $initial_value;

  function __construct($title = null, $description = null, $attributes = [], $weight = 0) {
    parent::__construct(null, $title, $description, $attributes, [], $weight);
  }

  function build() {
    if (!$this->child_select('element')) {
      $element = new $this->element_class($this->element_tag_name);
      $this->child_insert($element, 'element');
      foreach ($this->attributes_select('element_attributes') as $c_key => $c_value) {
        if ($c_value === null) $element->attribute_delete($c_key);
        if ($c_value !== null) $element->attribute_insert($c_key, $c_value);
      }
    }
  }

  # ─────────────────────────────────────────────────────────────────────
  # element properties
  # ─────────────────────────────────────────────────────────────────────

  function auto_id_generate() {
    $name = $this->name_get();
    if ($name !== null) {
      static::$auto_ids[$name] = isset(static::$auto_ids[$name]) ? ++static::$auto_ids[$name] : 1;
      $suffix = static::$auto_ids[$name] == 1 ? '' :
            '-'.static::$auto_ids[$name];
      return 'auto_id-'.$name.$suffix;
    }
  }

  function auto_id_set() {
    $name = $this->name_get();
    if ($this->id_get() === null && $name !== null) {
      $this->id_set(
        $this->auto_id_generate()
      );
    }
  }

  function checked_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('checked') === true;
  }

  function checked_set($is_checked = true) {
    $element = $this->child_select('element');
    if ($is_checked) $element->attribute_insert('checked', true);
    else             $element->attribute_delete('checked');
  }

  function disabled_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('disabled') === true;
  }

  function disabled_set($is_disabled = true) {
    $element = $this->child_select('element');
    if ($is_disabled) $element->attribute_insert('disabled', true);
    else              $element->attribute_delete('disabled');
  }

  function id_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('id');
  }

  function id_set($id = null) {
    $element = $this->child_select('element');
    if ($id) $element->attribute_insert('id', $id);
    else     $element->attribute_delete('id');
  }

  function min_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('min');
  }

  function min_set($min = null) {
    $element = $this->child_select('element');
    if ($min) $element->attribute_insert('min', $min);
    else      $element->attribute_delete('min');
  }

  function max_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('max');
  }

  function max_set($max = null) {
    $element = $this->child_select('element');
    if ($max) $element->attribute_insert('max', $max);
    else      $element->attribute_delete('max');
  }

  function minlength_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('minlength');
  }

  function minlength_set($minlength = null) {
    $element = $this->child_select('element');
    if ($minlength) $element->attribute_insert('minlength', $minlength);
    else            $element->attribute_delete('minlength');
  }

  function maxlength_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('maxlength');
  }

  function maxlength_set($maxlength = null) {
    $element = $this->child_select('element');
    if ($maxlength) $element->attribute_insert('maxlength', $maxlength);
    else            $element->attribute_delete('maxlength');
  }

  function multiple_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('multiple') === true;
  }

  function multiple_set($is_multiple = true) {
    $element = $this->child_select('element');
    if ($is_multiple) $element->attribute_insert('multiple', true);
    else              $element->attribute_delete('multiple');
  }

  function name_get($trim = true) {
    $element = $this->child_select('element');
    return $trim ? rtrim($element->attribute_select('name'), '[]') :
                         $element->attribute_select('name');
  }

  function name_set($name) {
    $element = $this->child_select('element');
    $element->attribute_insert('name', $name);
  }

  function pattern_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('pattern');
  }

  function pattern_set($pattern = null) {
    $element = $this->child_select('element');
    if ($pattern) $element->attribute_insert('pattern', $pattern);
    else          $element->attribute_delete('pattern');
  }

  function readonly_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('readonly') === true;
  }

  function readonly_set($is_readonly = true) {
    $element = $this->child_select('element');
    if ($is_readonly) $element->attribute_insert('readonly', true);
    else              $element->attribute_delete('readonly');
  }

  function required_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('required') === true;
  }

  function required_set($is_required = true) {
    $element = $this->child_select('element');
    if ($is_required) $element->attribute_insert('required', true);
    else              $element->attribute_delete('required');
  }

  function step_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('step');
  }

  function step_set($step = null) {
    $element = $this->child_select('element');
    if ($step) $element->attribute_insert('step', $step);
    else       $element->attribute_delete('step');
  }

  function type_get($full = true) {
    $element = $this->child_select('element');
    switch ($element->tag_name) {
      case 'input'   : return 'input'.($full ? ':'.$element->attribute_select('type') : '');
      case 'textarea': return 'textarea';
      case 'select'  : return 'select';
    }
  }

  function value_get() {
    $element = $this->child_select('element');
    return $element->attribute_select('value');
  }

  function value_set($value) {
    $this->value_set_initial($value);
    $element = $this->child_select('element');
    return $element->attribute_insert('value', $value);
  }

  function value_is_unique_in_storage_sql($value) { # return: null | false | instance
    if ($this->entity_name &&
        $this->entity_field_name) {
      $result = entity::get($this->entity_name)->instances_select(['conditions' => [
        'field_!f' => $this->entity_field_name,
        'operator' => '=',
        'field_!v' => $value], 'limit' => 1]);
      return reset($result);
    }
  }

  function value_get_initial() {
    return $this->initial_value;
  }

  function value_set_initial($value, $reset = false) {
    if ($this->initial_value === null || $reset == true)
        $this->initial_value = $value;
  }

  # ─────────────────────────────────────────────────────────────────────
  # functionality for errors
  # ─────────────────────────────────────────────────────────────────────

  function error_set($message = null, $args = []) {
    if ($this->disabled_get() == false &&
        $this->readonly_get() == false) {
      $new_error = new \stdClass;
      $new_error->message = $message;
      $new_error->args    = $args;
      $new_error->pointer = &$this;
      form::$errors[] = $new_error;
      if (!$this->has_error) {
           $this->has_error = true;
        $element = $this->child_select('element');
        $element->attribute_insert('aria-invalid', 'true');
        if (++static::$error_tabindex == 1) {
          $element->attribute_insert('autofocus', true);
        }
      }
    }
  }

  function has_error() {
    return $this->has_error;
  }

  # ─────────────────────────────────────────────────────────────────────
  # functionality for render
  # ─────────────────────────────────────────────────────────────────────

  function render() {
    $element = $this->child_select('element');
    if ($this->set_auto_id) $this->auto_id_set();
    if ($this->id_get() && $this->render_description()) $element->attribute_insert('aria-describedby', 'description-'.$this->id_get());
    if ($element instanceof node_simple && $element->attribute_select('disabled')) $this->attribute_insert('aria-disabled', 'true');
    if ($element instanceof node_simple && $element->attribute_select('required')) $this->attribute_insert('aria-required', 'true');
    return parent::render();
  }

  function render_self() {
    $element = $this->child_select('element');
    if ($this->title) {
      return (new markup($this->title_tag_name, [
        'for'                => $this->id_get(),
        'data-mark-required' => $this->attribute_select('required') || ($element instanceof node_simple && $element->attribute_select('required')) ? 'true' : null], $this->title
      ))->render();
    }
  }

  function render_description() {
    $result = [];
    $element = $this->child_select('element');
    if ($element instanceof node_simple) {
      if ($element->attribute_select('pattern') !== null)                                                                                             $result[] = $this->render_description_pattern  ($element);
      if ($element->attribute_select('min')     !== null)                                                                                             $result[] = $this->render_description_min      ($element);
      if ($element->attribute_select('max')     !== null)                                                                                             $result[] = $this->render_description_max      ($element);
      if ($element->attribute_select('value')   !== null && $element->attribute_select('type') == 'range')                                            $result[] = $this->render_description_cur      ($element);
      if (is_numeric($element->attribute_select('minlength')) && $element->attribute_select('minlength') !== $element->attribute_select('maxlength')) $result[] = $this->render_description_minlength($element);
      if (is_numeric($element->attribute_select('maxlength')) && $element->attribute_select('minlength') !== $element->attribute_select('maxlength')) $result[] = $this->render_description_maxlength($element);
      if (is_numeric($element->attribute_select('minlength')) && $element->attribute_select('minlength') === $element->attribute_select('maxlength')) $result[] = $this->render_description_midlength($element);
    }
    if ($this->description) $result[] = new markup('p', [], $this->description);
    if (count($result)) {
      if ($this->description_state == 'hidden'                      ) return '';
      if ($this->description_state == 'opened' || $this->has_error()) return                        (new markup($this->description_tag_name, ['id' => $this->id_get() ? 'description-'.$this->id_get() : null], $result))->render();
      if ($this->description_state == 'closed'                      ) return $this->render_opener().(new markup($this->description_tag_name, ['id' => $this->id_get() ? 'description-'.$this->id_get() : null], $result))->render();
      return '';
    }
  }

  function render_opener() {
    return (new markup_simple('input', [
      'type' => 'checkbox',
      'role' => 'button',
      'data-opener-type' => 'description',
      'checked' => true,
      'title' => new text('press to show hidden description')
    ]))->render();
  }

  function render_description_pattern  ($element) {return new markup('p', ['data-id' => 'pattern'  ], new text('Field value should match the regular expression: %%_expression.', ['expression'    => $element->attribute_select('pattern')]));          }
  function render_description_min      ($element) {return new markup('p', ['data-id' => 'min'      ], new text('Minimum field value: %%_value.', ['value'                                          => $element->attribute_select('min')]));              }
  function render_description_max      ($element) {return new markup('p', ['data-id' => 'max'      ], new text('Maximum field value: %%_value.', ['value'                                          => $element->attribute_select('max')]));              }
  function render_description_cur      ($element) {return new markup('p', ['data-id' => 'cur'      ], new text('Current field value: %%_value.', ['value' => (new markup('x-value', [],               $element->attribute_select('value')))->render()]));}
  function render_description_minlength($element) {return new markup('p', ['data-id' => 'minlength'], new text('Field can contain a minimum of %%_number character%%_plural{number,s}.', ['number' => $element->attribute_select('minlength')]));        }
  function render_description_maxlength($element) {return new markup('p', ['data-id' => 'maxlength'], new text('Field can contain a maximum of %%_number character%%_plural{number,s}.', ['number' => $element->attribute_select('maxlength')]));        }
  function render_description_midlength($element) {return new markup('p', ['data-id' => 'midlength'], new text('Field can contain %%_number character%%_plural{number,s}.',              ['number' => $element->attribute_select('minlength')]));        }

  ###########################
  ### static declarations ###
  ###########################

  static protected $numbers = [];
  static protected $error_tabindex = 0;
  static protected $auto_ids = [];

  static function current_number_get($name) {
    return !isset(static::$numbers[$name]) ?
                 (static::$numbers[$name] = 0) :
                ++static::$numbers[$name];
  }

  static function on_validate        ($field, $form, $npath) {} /*
  static function on_validate_phase_2($field, $form, $npath) {}
  static function on_validate_phase_3($field, $form, $npath) {}
  static function on_submit          ($field, $form, $npath) {} */

  # ──────────────────────────────────────────────────────────────────────────────
  # functionality for $_POST and $_GET data
  # ──────────────────────────────────────────────────────────────────────────────

  static function request_values_reset() {
    $_POST    = [];
    $_GET     = [];
    $_REQUEST = [];
    $_FILES   = [];
  }

  # conversion matrix:
  # ┌──────────────────────────────────────────╥───────────────────────────────┐
  # │ input value (undefined | string | array) ║ result value                  │
  # ╞══════════════════════════════════════════╬═══════════════════════════════╡
  # │ source[field] == undefined               ║ return ''                     │
  # │ source[field] == ''                      ║ return ''                     │
  # │ source[field] == 'value'                 ║ return 'value'                │
  # ├──────────────────────────────────────────╫───────────────────────────────┤
  # │ source[field] == [0 => '']               ║ return ''                     │
  # │ source[field] == [0 => '', …]            ║ return ''                     │
  # │ source[field] == [0 => 'value']          ║ return 'value'                │
  # │ source[field] == [0 => 'value', …]       ║ return 'value'                │
  # └──────────────────────────────────────────╨───────────────────────────────┘

  static function request_value_get($name, $number = 0, $source = '_POST') {
    global ${$source};
    return !isset(${$source}[$name]) ? '' :
       (is_string(${$source}[$name]) ? ${$source}[$name] : 
        (is_array(${$source}[$name]) &&
            isset(${$source}[$name][$number]) ?
                  ${$source}[$name][$number] : ''));
  }

  # conversion matrix:
  # ┌──────────────────────────────────────────╥───────────────────────────────┐
  # │ input value (undefined | string | array) ║ result value                  │
  # ╞══════════════════════════════════════════╬═══════════════════════════════╡
  # │ source[field] == undefined               ║ return []                     │
  # │ source[field] == ''                      ║ return [0 => '']              │
  # │ source[field] == 'value'                 ║ return [0 => 'value']         │
  # ├──────────────────────────────────────────╫───────────────────────────────┤
  # │ source[field] == [0 => '']               ║ return [0 => '']              │
  # │ source[field] == [0 => '', …]            ║ return [0 => '', …]           │
  # │ source[field] == [0 => 'value']          ║ return [0 => 'value']         │
  # │ source[field] == [0 => 'value', …]       ║ return [0 => 'value', …]      │
  # └──────────────────────────────────────────╨───────────────────────────────┘

  static function request_values_get($name, $source = '_POST') {
    global ${$source};
    return !isset(${$source}[$name]) ? [] :
       (is_string(${$source}[$name]) ? [${$source}[$name]] :
        (is_array(${$source}[$name]) ?
                  ${$source}[$name] : []));
  }

  static function request_values_set($name, $values, $source = '_POST') {
    global ${$source};
    ${$source}[$name] = $values;
  }

  # conversion matrix:
  # ┌─────────────────────────────────────────────────────────╥───────────────────────────────────────────────────────────────────────┐
  # │ input value (undefined | array)                         ║ result value                                                          │
  # ╞═════════════════════════════════════════════════════════╬═══════════════════════════════════════════════════════════════════════╡
  # │ $_FILES[field] == undefined                             ║ return []                                                             │
  # │ $_FILES[field] == [error = 4]                           ║ return []                                                             │
  # │ $_FILES[field] == [name = 'file']                       ║ return [0 => (object)[name = 'file']]                                 │
  # │ $_FILES[field] == [name = [0 => 'file']]                ║ return [0 => (object)[name = 'file']]                                 │
  # │ $_FILES[field] == [name = [0 => 'file1', 1 => 'file2']] ║ return [0 => (object)[name = 'file1'], 1 => (object)[name = 'file2']] │
  # └─────────────────────────────────────────────────────────╨───────────────────────────────────────────────────────────────────────┘

  static function request_files_get($name) {
    $result = [];
    if (isset($_FILES[$name]['name'    ]) &&
        isset($_FILES[$name]['type'    ]) &&
        isset($_FILES[$name]['size'    ]) &&
        isset($_FILES[$name]['tmp_name']) &&
        isset($_FILES[$name]['error'   ])) {
      $info = $_FILES[$name];
      if (!is_array($info['name'    ])) $info['name'    ] = [$info['name'    ]];
      if (!is_array($info['type'    ])) $info['type'    ] = [$info['type'    ]];
      if (!is_array($info['size'    ])) $info['size'    ] = [$info['size'    ]];
      if (!is_array($info['tmp_name'])) $info['tmp_name'] = [$info['tmp_name']];
      if (!is_array($info['error'   ])) $info['error'   ] = [$info['error'   ]];
      foreach ($info as $c_prop => $c_values) {
        foreach ($c_values as $c_number => $c_value) {
          if ($info['error'][$c_number] !== UPLOAD_ERR_NO_FILE) {
            if (!isset($result[$c_number]))
                       $result[$c_number] = new \stdClass;
            switch ($c_prop) {
              case 'name':
                $c_file = new file($c_value);
                $result[$c_number]->{'name'} = $c_file->name_get();
                $result[$c_number]->{'type'} = $c_file->type_get();
                $result[$c_number]->{'file'} = $c_file->file_get();
                break;
              case 'type'    : $result[$c_number]->{'mime'}     = core::validate_mime_type($c_value) ? $c_value : ''; break;
              case 'tmp_name': $result[$c_number]->{'tmp_path'} = $c_value; break;
              default        : $result[$c_number]->{$c_prop}    = $c_value;
            }
          }
        }
      }
    }
    return $result;
  }

}}