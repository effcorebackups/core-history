<?php

namespace effectivecore {
          use \effectivecore\markup;
          abstract class events_form extends events {

  static function on_init($page_args, $form_args, $post_args) {}
  static function on_submit($page_args, $form_args, $post_args) {}

  static function on_validate($form, $elements) {
    foreach ($elements as $c_id => $c_element) {
      if ($c_element instanceof form_field ||
          $c_element instanceof markup) {
        $c_name = isset($c_element->attributes->name) ? $c_element->attributes->name : '';
        $c_post = isset($_POST[$c_name])              ? $_POST[$c_name]              : ''; # @todo: may be add a filter
        if ($c_name) {
          switch ($c_element->tag_name) {

            case 'select':
            # ... @todo: make functionality
              break;

            case 'textarea':
            # set post value
              $content = $c_element->child_select('content');
              $content->text = $c_post;
            # ... @todo: make functionality
              break;

            case 'input':
              $c_type = isset($c_element->attributes->type) ?
                              $c_element->attributes->type : '';
            # file
              if ($c_type &&
                  $c_type == 'file') {
            # ... @todo: make functionality
              }

            # checkbox
              if ($c_type &&
                  $c_type == 'checkbox') {
            # ... @todo: make functionality
              }

            # radio
              if ($c_type &&
                  $c_type == 'radio') {
            # ... @todo: make functionality
              }

            # text|password|search|email|url|tel|number|range|date|time|color
              if ($c_type &&
                  $c_type != 'submit'   && # <input type="submit">
                  $c_type != 'reset'    && # <input type="reset">
                  $c_type != 'image'    && # <input type="image">
                  $c_type != 'button'   && # <input type="button">
                  $c_type != 'hidden'   && # <input type="hidden">
                  $c_type != 'file'     && # <input type="file">
                  $c_type != 'checkbox' && # <input type="checkbox">
                  $c_type != 'radio'       # <input type="radio">
              ) {

              # set post value
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
              break;
          }
        }
      }
    }
  }

}}