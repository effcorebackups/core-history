<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\page {
          use \effcore\color;
          use \effcore\module;
          use \effcore\page;
          use \effcore\url;
          abstract class events_token {

  static function on_replace($name, $args = []) {
    $settings = module::settings_get('page');
    switch ($name) {
      case     'page_min_width': return $settings->page_min_width;
      case     'page_max_width': return $settings->page_max_width;
      case 'css_page_min_width_context':
      case 'css_page_max_width_context':
        $id_page = url::get_current()->query_arg_select('id_page');
        $page = page::get($id_page);
        if ($name == 'css_page_min_width_context' && !empty($page->data['width_min'])) return 'min-width: '.$page->data['width_min'].'px';
        if ($name == 'css_page_max_width_context' && !empty($page->data['width_max'])) return 'max-width: '.$page->data['width_max'].'px';
        break;
    }
  # colors
    $colors = color::get_all();
    $color_result = null;
    switch ($name) {
      case 'color_page'                  : $color_result = $colors[$settings->color_page_id                  ] ?? null; break;
      case 'color_text'                  : $color_result = $colors[$settings->color_text_id                  ] ?? null; break;
      case 'color_main'                  : $color_result = $colors[$settings->color_main_id                  ] ?? null; break;
      case 'color_link'                  : $color_result = $colors[$settings->color_link_id                  ] ?? null; break;
      case 'color_link_active'           : $color_result = $colors[$settings->color_link_active_id           ] ?? null; break;
      case 'color_table_row_odd'         : $color_result = $colors[$settings->color_table_row_odd_id         ] ?? null; break;
      case 'color_table_row_even'        : $color_result = $colors[$settings->color_table_row_even_id        ] ?? null; break;
      case 'color_relation'              : $color_result = $colors[$settings->color_relation_id              ] ?? null; break;
      case 'color_menu'                  : $color_result = $colors[$settings->color_menu_id                  ] ?? null; break;
      case 'color_menu_active'           : $color_result = $colors[$settings->color_menu_active_id           ] ?? null; break;
      case 'color_menu_text'             : $color_result = $colors[$settings->color_menu_text_id             ] ?? null; break;
      case 'color_menu_link'             : $color_result = $colors[$settings->color_menu_link_id             ] ?? null; break;
      case 'color_menu_link_active'      : $color_result = $colors[$settings->color_menu_link_active_id      ] ?? null; break;
      case 'color_tabs'                  : $color_result = $colors[$settings->color_tabs_id                  ] ?? null; break;
      case 'color_tabs_link'             : $color_result = $colors[$settings->color_tabs_link_id             ] ?? null; break;
      case 'color_tabs_link_active'      : $color_result = $colors[$settings->color_tabs_link_active_id      ] ?? null; break;
      case 'color_tabs_link_active_no_bg': $color_result = $colors[$settings->color_tabs_link_active_no_bg_id] ?? null; break;
      case 'color_ok'                    : $color_result = $colors[$settings->color_ok_id                    ] ?? null; break;
      case 'color_warning'               : $color_result = $colors[$settings->color_warning_id               ] ?? null; break;
      case 'color_error'                 : $color_result = $colors[$settings->color_error_id                 ] ?? null; break;
      case 'color_fieldset'              : $color_result = $colors[$settings->color_fieldset_id              ] ?? null; break;
      case 'color_fieldset_nested'       : $color_result = $colors[$settings->color_fieldset_nested_id       ] ?? null; break;
      case 'color_field'                 : $color_result = $colors[$settings->color_field_id                 ] ?? null; break;
      case 'color_field_text'            : $color_result = $colors[$settings->color_field_text_id            ] ?? null; break;
      case 'color_button'                : $color_result = $colors[$settings->color_button_id                ] ?? null; break;
      case 'color_button_active'         : $color_result = $colors[$settings->color_button_active_id         ] ?? null; break;
      case 'color_button_text'           : $color_result = $colors[$settings->color_button_text_id           ] ?? null; break;}
    if ($color_result) {
      if (!empty($color_result->value) && count($args) == 0) return $color_result->value;
      if (!empty($color_result->value) && count($args) == 3) {
        $rgb = $color_result->rgb_get();
        if ($rgb) {
          $new_r = max(min($rgb['r'] + (int)$args[0], 255), 0);
          $new_g = max(min($rgb['g'] + (int)$args[1], 255), 0);
          $new_b = max(min($rgb['b'] + (int)$args[2], 255), 0);
          return '#'.str_pad(dechex($new_r), 2, '0', STR_PAD_LEFT).
                     str_pad(dechex($new_g), 2, '0', STR_PAD_LEFT).
                     str_pad(dechex($new_b), 2, '0', STR_PAD_LEFT);
        }
      }
    }
  }

}}