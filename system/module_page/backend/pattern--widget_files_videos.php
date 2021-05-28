<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class widget_files_videos extends widget_files {

  use widget_files_videos__shared;

  public $title = 'Videos';
  public $item_title = 'Video';
  public $attributes = ['data-type' => 'items-files-videos'];
  public $name_complex = 'widget_files_videos';
# ─────────────────────────────────────────────────────────────────────
  public $upload_dir = 'videos/';
  public $fixed_name = 'video-multiple-%%_item_id_context';
# ─────────────────────────────────────────────────────────────────────
  public $max_file_size = '50M';
  public $types_allowed = [
    'mp4' => 'mp4'
  ];

  ###########################
  ### static declarations ###
  ###########################

  static function complex_value_to_markup($complex) {
    $decorator = new decorator;
    $decorator->id = 'widget_files-videos-items';
    $decorator->view_type = 'template';
    $decorator->template = 'content';
    $decorator->template_row = 'gallery_row';
    $decorator->template_row_mapping = core::array_kmap(['num', 'type', 'children']);
    if ($complex) {
      core::array_sort_by_weight($complex);
      foreach ($complex as $c_row_id => $c_item) {
        if (media::media_class_get($c_item->object->type) === 'video') {
          $decorator->data[$c_row_id] = [
            'type'     => ['value' => 'video'  ],
            'num'      => ['value' => $c_row_id],
            'children' => ['value' => static::item_markup_get($c_item, $c_row_id)]
          ];
        }
      }
    }
    return $decorator;
  }

  static function item_markup_get($item, $row_id) {
    if ($item->settings['data-poster-is-embedded'])
         return new markup('video', ['src' => '/'.$item->object->get_current_path(true), 'poster' => '/'.$item->object->get_current_path(true).'?poster=big'] + $item->settings);
    else return new markup('video', ['src' => '/'.$item->object->get_current_path(true)                                                                     ] + $item->settings);
  }

  # ─────────────────────────────────────────────────────────────────────

  static function widget_manage_get(&$widget, $item, $c_row_id) {
    $result = parent::widget_manage_get($widget, $item, $c_row_id);
    $result->attribute_insert('data-is-new', $item->object->get_current_state() === 'pre' ? 'true' : 'false');
    static::widget_manage_item_make($result, $item, $c_row_id, $widget);
    return $result;
  }

  static function widget_manage_item_make(&$widget, &$item, $c_row_id, &$root) {
    if (media::media_class_get($item->object->type) === 'video') {
      if (!empty($item->settings['data-poster-is-embedded'])) {
        $widget->child_insert(new markup_simple('img', ['src' => '/'.$item->object->get_current_path(true).'?poster=small', 'alt' => new text('thumbnail'), 'width' => '44', 'height' => '44', 'data-type' => 'thumbnail'], +450), 'thumbnail');
      }
    }
  }

  static function widget_insert_get(&$widget, $group = '') {
    $result = new markup('x-widget', ['data-type' => 'insert']);
  # control for upload new video
    $field_file_video = new field_file_video;
    $field_file_video->title            = 'Video';
    $field_file_video->max_file_size    = $widget->{($group ? $group.'_' : '').'max_file_size'};
    $field_file_video->types_allowed    = $widget->{($group ? $group.'_' : '').'types_allowed'};
    $field_file_video->cform            = $widget->cform;
    $field_file_video->min_files_number = null;
    $field_file_video->max_files_number = null;
    $field_file_video->has_on_validate  = false;
    $field_file_video->build();
    $field_file_video->name_set($widget->name_get_complex().'__file'.($group ? '_'.$group : ''));
  # control for upload new video poster
    $field_file_poster = new field_file_picture;
    $field_file_poster->title            = 'Poster';
    $field_file_poster->max_file_size    = $widget->poster_max_file_size;
    $field_file_poster->types_allowed    = $widget->poster_types_allowed;
    $field_file_poster->cform            = $widget->cform;
    $field_file_poster->min_files_number = null;
    $field_file_poster->max_files_number = null;
    $field_file_poster->has_on_validate  = false;
    $field_file_poster->build();
    $field_file_poster->name_set($widget->name_get_complex().'__poster');
  # button for insertion of the new item
    $button = new button(null, ['data-style' => 'narrow-insert', 'title' => new text('insert')]);
    $button->break_on_validate = true;
    $button->build();
    $button->value_set($widget->name_get_complex().'__insert'.($group ? '_'.$group : ''));
    $button->_type = 'insert';
    $button->_kind = 'video';
  # relate new controls with the widget
    if (true                      ) $widget->controls[  '#file'.($group ? '_'.$group : '')] = $field_file_video;
    if ($widget->poster_is_allowed) $widget->controls['#poster'                           ] = $field_file_poster;
    if (true                      ) $widget->controls['~insert'.($group ? '_'.$group : '')] = $button;
    if (true                      ) $result->child_insert($field_file_video, 'file');
    if ($widget->poster_is_allowed) $result->child_insert($field_file_poster, 'poster');
    if (true                      ) $result->child_insert($button, 'button');
    return $result;
  }

  # ─────────────────────────────────────────────────────────────────────

  static function on_file_prepare(&$widget, $form, $npath, $button, &$items, &$new_item) {
    $pre_path = temporary::directory.'validation/'.$form->validation_cache_date_get().'/'.$form->validation_id.'-'.$widget->name_get_complex().'-'.core::array_key_last($items).'.'.$new_item->object->type;
    if ($new_item->object->move_tmp_to_pre($pre_path)) {
      $new_item->settings = $widget->video_player_default_settings;
      $new_item->settings['data-poster-is-embedded'] = false;
      if ($widget->poster_is_allowed) {
        if (media::media_class_get($new_item->object->type) === 'video') {
          $values = event::start_local('on_values_validate', $widget, ['form' => $form, 'npath' => $npath, 'button' => $button, 'name' => '#poster']);
          $poster = reset($values);
          if ($poster instanceof file_history) {
            if (media::media_class_get($poster->type) === 'picture') {
              if (media::is_type_for_thumbnail($poster->type)) {
                if ($poster->move_tmp_to_pre($pre_path.'.'.$poster->type)) {
                  if ($new_item->object->container_video_make($widget->poster_thumbnails, $poster->get_current_path())) {
                    $new_item->settings['data-poster-is-embedded'] = true;
                    @unlink($pre_path.'.'.$poster->type);
                  }
                }
              }
            }
          }
        }
      }
      return true;
    }
  }

  static function on_button_click_insert(&$widget, $form, $npath, $button) {
    if ($widget->poster_is_allowed) {
      $values        = event::start_local('on_values_validate', $widget, ['form' => $form, 'npath' => $npath, 'button' => $button, 'name' => '#file'  ]);
      $values_poster = event::start_local('on_values_validate', $widget, ['form' => $form, 'npath' => $npath, 'button' => $button, 'name' => '#poster']);
      if (!$widget->controls['#file']->has_error() &&                                               count($values) === 0) {$widget->controls['#file']->error_set('Field "%%_title" cannot be blank!', ['title' => (new text($widget->controls['#file']->title))->render() ]); return;}
      if (!$widget->controls['#file']->has_error() && !$widget->controls['#poster']->has_error() && count($values) !== 0)
           return widget_files::on_button_click_insert($widget, $form, $npath, $button);
    } else return widget_files::on_button_click_insert($widget, $form, $npath, $button);
  }

}}