<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effectivecore {
          class form extends \effectivecore\markup {

  # elements support:
  # ─────────────────────────────────────────────────────────────────────
  # - textarea
  # - input[type=text]
  # - input[type=password]
  # - input[type=search]
  # - input[type=url]
  # - input[type=tel]
  # - input[type=email]
  # - select
  # - input[type=file]
  # - input[type=checkbox]
  # - input[type=radio]
  # - input[type=number]
  # - input[type=range]
  # - input[type=date]
  # - input[type=time]
  # - input[type=color]
  # - button[type=button]
  # - button[type=reset]
  # - button[type=submit]
  # - input[type=hidden]         : not processed
  # ─────────────────────────────────────────────────────────────────────

  # elements are not supported and not processed:
  # ─────────────────────────────────────────────────────────────────────
  # - input[type=button]         : use button[type=button] instead
  # - input[type=reset]          : use button[type=reset] instead
  # - input[type=submit]         : use button[type=submit] instead
  # - input[type=image]          : use imgage instead
  # - input[type=week]           : use week_macro instead
  # - input[type=month]          : use month_macro instead
  # - input[type=datetime]       : use date + time instead
  # - input[type=datetime-local] : use date + time instead
  # ─────────────────────────────────────────────────────────────────────

  # note:
  # ─────────────────────────────────────────────────────────────────────
  # 1. more info in \effectivecore\events_form
  # ─────────────────────────────────────────────────────────────────────

  public $tag_name = 'form';
  public $clicked_button = null;
  public $clicked_button_name = null;
  public $errors = [];

  function render() {
    $this->build();
    return parent::render();
  }

  function add_error($element_id = null, $message = null) {
    $this->errors[$element_id][] = $message;
  }

  function build() {
    $values = static::values_get() + static::files_get();
    $id = $this->attribute_select('id');
  # build all form elements
    $elements = $this->child_select_all();
    foreach ($elements as $c_element) {
      if (method_exists($c_element, 'build')) {
        $c_element->build();
      }
    }
  # renew elements list after build and get all fields
    $elements = $this->child_select_all();
    $fields   = $this->fields_get();
  # call init handlers
    event::start('on_form_init', $id, [$this, $fields]);
  # if current user click the button
    if (isset($values['form_id'][0]) &&
              $values['form_id'][0] === $id && isset($values['button'][0])) {
    # get more info about clicked button
      foreach ($elements as $c_element) {
        if ($c_element instanceof markup &&
            $c_element->tag_name == 'button' &&
            $c_element->attribute_select('type') == 'submit' &&
            $c_element->attribute_select('value') === $values['button'][0]) {
          $this->clicked_button      = $c_element;
          $this->clicked_button_name = $c_element->attribute_select('value');
          break;
        }
      }
    # call validate handlers
      if (empty($this->clicked_button->novalidate)) {
        event::start('on_form_validate', $id, [$this, $fields, &$values]);
      }
    # show errors and set error class
      foreach ($this->errors as $c_npath => $c_errors) {
        foreach ($c_errors as $c_error) {
          if ($c_npath) $elements[$c_npath]->attribute_insert('class', ['error' => 'error']);
          if ($c_error) message::insert($c_error, 'error');
        }
      }
    # call submit handler (if no errors)
      if (count($this->errors) == 0) {
        event::start('on_form_submit', $id, [$this, $fields, &$values]);
      }
    }

  # add form_id to the form markup
    $this->child_insert(new markup_simple('input', [
      'type'  => 'hidden',
      'name'  => 'validation_id',
      'value' => static::validation_id_get(),
      ]), 'hidden_validation_id');
    $this->child_insert(new markup_simple('input', [
      'type'  => 'hidden',
      'name'  => 'form_id',
      'value' => $id,
    ]), 'hidden_form_id');
  }

  ###############################
  ### validation_id functions ###
  ###############################

  static function validation_id_generate() {
    $hex_created = dechex(time());
    $hex_ip = factory::ip_to_hex($_SERVER['REMOTE_ADDR']);
    $hex_random = str_pad(dechex(rand(0, 0xffffffff)), 8, '0', STR_PAD_LEFT);
    return $hex_created. # strlen == 8
           $hex_ip.      # strlen == 8
           $hex_random;  # strlen == 8
  }

  static function validation_id_get() {
    if (static::validation_id_check(
          isset($_POST['validation_id']) ?
                $_POST['validation_id'] : '')) {
      return    $_POST['validation_id']; } else {
      return static::validation_id_generate();
    }
  }

  static function validation_id_check($value) {
    if (factory::filter_hash($value, 24)) {
      $created = hexdec(substr($value, 0, 8));
      $ip = factory::hex_to_ip(substr($value, 8, 8));
      $random = hexdec(substr($value, 16));
      if ($created < time()           &&
          $created > time() - 60 * 60 &&
          $ip === $_SERVER['REMOTE_ADDR']) {
        return true;
      }
    }
  }

  #######################################
  ### get fields, $_POST, $_FILES ... ###
  #######################################

  function fields_get() {
    $return = [];
    foreach ($this->child_select_all() as $c_npath => $c_child) {
      if ($c_child instanceof \effectivecore\form_container) {
        $return[$c_npath] = $c_child;
      }
    }
    return $return;
  }

  static function values_get() {
    $return = [];
    # conversion matrix (expected: string|array):
    # ─────────────────────────────────────────────────────────────────────
    # - $_POST[name] == ''                  -> return [0 => '']
    # - $_POST[name] == 'value'             -> return [0 => 'value']
    # ─────────────────────────────────────────────────────────────────────
    # - $_POST[name] == [0 => '']           -> return [0 => '']
    # - $_POST[name] == [0 => '', ...]      -> return [0 => '', ...]
    # - $_POST[name] == [0 => 'value']      -> return [0 => 'value']
    # - $_POST[name] == [0 => 'value', ...] -> return [0 => 'value', ...]
    # ─────────────────────────────────────────────────────────────────────
    foreach ($_POST as $c_field => $c_value) {
      $return[$c_field] = is_array($c_value) ?
                                   $c_value : [$c_value];
    }
    return $return;
  }

  static function files_get() {
    $return = [];
    # conversion matrix (expected: string|array):
    # ─────────────────────────────────────────────────────────────────────
    # - $_FILES[name] == '',                 -> ignored empty
    # - $_FILES[name] == 'value'             -> return [name => [0 => 'value']]
    # ─────────────────────────────────────────────────────────────────────
    # - $_FILES[name] == [0 => '']           -> ignored empty
    # - $_FILES[name] == [0 => '', ...]      -> ignored empty
    # - $_FILES[name] == [0 => 'value']      -> return [name => [0 => 'value']]
    # - $_FILES[name] == [0 => 'value', ...] -> return [name => [0 => 'value', ...]]
    # ─────────────────────────────────────────────────────────────────────
    foreach ($_FILES as $c_field => $c_info) {
      if (!is_array($c_info['name']))     $c_info['name']     = [$c_info['name']];
      if (!is_array($c_info['type']))     $c_info['type']     = [$c_info['type']];
      if (!is_array($c_info['size']))     $c_info['size']     = [$c_info['size']];
      if (!is_array($c_info['tmp_name'])) $c_info['tmp_name'] = [$c_info['tmp_name']];
      if (!is_array($c_info['error']))    $c_info['error']    = [$c_info['error']];
      foreach ($c_info as $c_prop => $c_values) {
        foreach ($c_values as $c_index => $c_value) {
          if ($c_info['error'][$c_index] !== UPLOAD_ERR_NO_FILE) {
            if (!isset($return[$c_field][$c_index]))
                       $return[$c_field][$c_index] = new \stdClass();
            $return[$c_field][$c_index]->{$c_prop} = $c_value;
          }
        }
      }
    }
    return $return;
  }

}}