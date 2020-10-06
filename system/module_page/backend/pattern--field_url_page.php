<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class field_url_page extends field_url {

  public $element_attributes = [
    'type'      => 'url',
    'name'      => 'url',
    'required'  => true,
    'minlength' => 1,
    'maxlength' => 255
  ];

  function render_description() {
    $this->description = [
      new text('Field value should be start with "%%_value".', ['value' => '/'       ]), br,
      new text('Field value cannot be start with "%%_value".', ['value' => '/manage/']), br,
      new text('Field value cannot be start with "%%_value".', ['value' => '/user/'  ])];
    return parent::render_description();
  }

  ###########################
  ### static declarations ###
  ###########################

  static function validate_value($field, $form, $element, &$new_value) {
    if ( (strlen($new_value) &&                    (new url(                 $new_value))->has_error === true) ||
         (strlen($new_value) && core::validate_url((new url(url::utf8_encode($new_value)))->full_get(), FILTER_FLAG_SCHEME_REQUIRED|FILTER_FLAG_HOST_REQUIRED|FILTER_FLAG_PATH_REQUIRED) === false) ||
         (strlen($new_value) && preg_match('%^/manage$|^/manage/.*$|^/user$|^/user/.*$|^[^/].*$%', $new_value)) ) {
      $field->error_set(
        'Field "%%_title" contains an incorrect URL!', ['title' => (new text($field->title))->render() ]
      );
    } else {
      return true;
    }
  }

}}