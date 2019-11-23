<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class field_date extends field_text {

  use field_validate_min_max;

  const input_min_date = '0000-01-01';
  const input_max_date = '9999-12-31';

  public $title = 'Date';
  public $attributes = ['data-type' => 'date'];
  public $element_attributes = [
    'type'     => 'date',
    'name'     => 'date',
    'required' => true,
    'min'      => self::input_min_date,
    'max'      => self::input_max_date
  ];

  function build() {
    if (!$this->is_builded) {
      parent::build();
      $value = parent::value_get();
      if ($value != null) {$this->value_set(     $value     ); $this->is_builded = true; return;}
      if ($value == null) {$this->value_set(core::date_get()); $this->is_builded = true; return;}
    }
  }

  function value_get() {
    $value = parent::value_get();
    if (core::validate_date($value))
         return core::sanitize_date($value);
    else return $value;
  }

  function value_set($value) {
    $this->value_set_initial($value);
    if (core::validate_date($value))
         parent::value_set(core::sanitize_date($value));
    else parent::value_set(                    $value );
  }

  ###########################
  ### static declarations ###
  ###########################

  static function validate($field, $form, $npath) {
    $element = $field->child_select('element');
    $name = $field->name_get();
    $type = $field->type_get();
    if ($name && $type) {
      if ($field->disabled_get()) return true;
      if ($field->readonly_get()) return true;
      $new_value = static::request_value_get($name, static::current_number_get($name), $form->source_get());
      $old_value = $field->value_get_initial();
      $result = static::validate_required  ($field, $form, $element, $new_value) &&
                static::validate_minlength ($field, $form, $element, $new_value) &&
                static::validate_maxlength ($field, $form, $element, $new_value) &&
                static::validate_value     ($field, $form, $element, $new_value) &&
                static::validate_min       ($field, $form, $element, $new_value) &&
                static::validate_max       ($field, $form, $element, $new_value) &&
                static::validate_pattern   ($field, $form, $element, $new_value) && (!empty($field->is_validate_uniqueness) ?
                static::validate_uniqueness($field, $new_value,      $old_value) : true);
      $field->value_set($new_value);
      return $result;
    }
  }

  static function validate_value($field, $form, $element, &$new_value) {
    if (strlen($new_value) && !core::validate_date($new_value)) {
      $field->error_set(
        'Field "%%_title" contains an incorrect date!', ['title' => translation::get($field->title)]
      );
    } else {
      $new_value = core::sanitize_date($new_value);
      return true;
    }
  }

}}