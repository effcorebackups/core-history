<?php

namespace effectivecore {
          abstract class events_form extends events {

  static function on_init($page_args, $form_args, $post_args) {}
  static function on_submit($page_args, $form_args, $post_args) {}

  static function on_validate($form, $elements) {
    foreach ($elements as $c_id => $c_element) {
      $c_name = isset($c_element->attributes->name) ? $c_element->attributes->name : '';
      $c_type = isset($c_element->attributes->type) ? $c_element->attributes->type : '';
      $c_post = isset($_POST[$c_name]) ? $_POST[$c_name] : ''; # @todo: may be add a filter
      if ($c_name &&
          $c_type &&
          $c_type != 'hidden' &&
          $c_type != 'submit') {

      # set post value to element
        $c_element->attributes->value = $c_post;

      # check required fields
        if ($c_post == '' && isset($c_element->attributes->required)) {
          $form->add_error($c_id,
            $c_element->title.' field can not be blank!'
          );
        }

      # check min length
        if ($c_post != '' && isset($c_element->attributes->minlength) &&
                 strlen($c_post) < $c_element->attributes->minlength) {
          $form->add_error($c_id,
            $c_element->title.' field contain too few symbols! Minimum '.$c_element->attributes->minlength.' symbols.'
          );
        }

      # check max length
        if ($c_post != '' && isset($c_element->attributes->maxlength) &&
                 strlen($c_post) > $c_element->attributes->maxlength) {
          $form->add_error($c_id,
            $c_element->title.' field contain too much symbols! Maximum '.$c_element->attributes->maxlength.' symbols.'
          );
        }

      # check email field
        if ($c_type == 'email' &&
            $c_post && !filter_var($c_post, FILTER_VALIDATE_EMAIL)) {
          $form->add_error($c_id,
            $c_element->title.' field contains an invalid email address!'
          );
        }
      }
    }
  }

  static function on_submit_admin_decoration($form, $elements) {

  }

}}