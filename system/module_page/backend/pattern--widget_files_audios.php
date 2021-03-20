<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class widget_files_audios extends widget_files {

  use widget_files_audios__shared;

  public $title = 'Audios';
  public $item_title = 'Audio';
  public $attributes = ['data-type' => 'items-files-audios'];
  public $name_complex = 'widget_files_audios';
# ─────────────────────────────────────────────────────────────────────
  public $upload_dir = 'audios/';
  public $fixed_name = 'audio-multiple-%%_item_id_context';
# ─────────────────────────────────────────────────────────────────────
  public $max_file_size = '10M';
  public $types_allowed = [
    'mp3' => 'mp3'];
# ─────────────────────────────────────────────────────────────────────
  public $cover_is_allowed = true;
  public $cover_thumbnails = [
    'small'  => 'small',
    'middle' => 'middle'];
  public $cover_max_file_size = '1M';
  public $cover_types_allowed = [
    'png'  => 'png',
    'gif'  => 'gif',
    'jpg'  => 'jpg',
    'jpeg' => 'jpeg'];
# ─────────────────────────────────────────────────────────────────────
  public $audio_player_on_manage_is_visible = true;
  public $audio_player_on_manage_settings = [
    'autoplay'                        => false,
    'controls'                        => true,
    'crossorigin'                     => null,
    'loop'                            => false,
    'muted'                           => false,
    'preload'                         => 'metadata',
    'data-player-name'                => 'default',
    'data-player-timeline-is-visible' => 'false'];
  public $audio_player_default_settings = [
    'autoplay'                        => false,
    'controls'                        => true,
    'crossorigin'                     => null,
    'loop'                            => false,
    'muted'                           => false,
    'preload'                         => 'metadata',
    'data-player-name'                => 'default',
    'data-player-timeline-is-visible' => 'true'
  ];

  function widget_manage_get($item, $c_row_id) {
    $widget = parent::widget_manage_get($item, $c_row_id);
    $widget->attribute_insert('data-is-new', $item->object->get_current_state() === 'pre' ? 'true' : 'false');
    if (media::media_class_get($item->object->type) === 'audio') {
      if ($this->audio_player_on_manage_is_visible) {
        $player_markup = new markup('audio', ['src' => '/'.$item->object->get_current_path(true)] + $this->audio_player_on_manage_settings, [], +500);
        $widget->child_insert($player_markup, 'player');
      }
      if ($item->settings['data-cover-is-embedded']) {
        $cover_thumbnail_markup = new markup_simple('img', ['src' => '/'.$item->object->get_current_path(true).'?cover=small', 'alt' => new text('thumbnail'), 'width' => '44', 'height' => '44', 'data-type' => 'thumbnail'], +450);
        $widget->child_insert($cover_thumbnail_markup, 'thumbnail');
      }
    }
    return $widget;
  }

  function widget_insert_get() {
    $widget = new markup('x-widget', [
      'data-type' => 'insert']);
  # control for upload new audio
    $field_file_audio = new field_file_audio;
    $field_file_audio->title            = 'Audio';
    $field_file_audio->max_file_size    = $this->max_file_size;
    $field_file_audio->types_allowed    = $this->types_allowed;
    $field_file_audio->cform            = $this->cform;
    $field_file_audio->min_files_number = null;
    $field_file_audio->max_files_number = null;
    $field_file_audio->has_on_validate  = false;
    $field_file_audio->build();
    $field_file_audio->name_set($this->name_get_complex().'__file');
  # control for upload new audio cover
    $field_file_cover = new field_file_picture;
    $field_file_cover->title            = 'Cover';
    $field_file_cover->max_file_size    = $this->cover_max_file_size;
    $field_file_cover->types_allowed    = $this->cover_types_allowed;
    $field_file_cover->cform            = $this->cform;
    $field_file_cover->min_files_number = null;
    $field_file_cover->max_files_number = null;
    $field_file_cover->has_on_validate  = false;
    $field_file_cover->build();
    $field_file_cover->name_set($this->name_get_complex().'__cover');
  # button for insertion of the new item
    $button = new button(null, ['data-style' => 'narrow-insert', 'title' => new text('insert')]);
    $button->break_on_validate = true;
    $button->build();
    $button->value_set($this->name_get_complex().'__insert');
    $button->_type = 'insert';
  # relate new controls with the widget
    if (true                   ) $this->controls['#file'  ] = $field_file_audio;
    if ($this->cover_is_allowed) $this->controls['#cover' ] = $field_file_cover;
    if (true                   ) $this->controls['~insert'] = $button;
    if (true                   ) $widget->child_insert($field_file_audio, 'file');
    if ($this->cover_is_allowed) $widget->child_insert($field_file_cover, 'cover');
    if (true                   ) $widget->child_insert($button, 'button');
    return $widget;
  }

  # ─────────────────────────────────────────────────────────────────────

  function on_file_prepare($form, $npath, $button, &$items, &$new_item) {
    return $this->on_file_prepare_audio($form, $npath, $button, $items, $new_item);
  }

  function on_button_click_insert($form, $npath, $button) {
    return $this->on_button_click_insert_audio($form, $npath, $button);
  }

  ###########################
  ### static declarations ###
  ###########################

  static function complex_value_to_markup($complex) {
    $decorator = new decorator;
    $decorator->id = 'widget_files-audios-items';
    $decorator->view_type = 'template';
    $decorator->template = 'content';
    $decorator->template_row = 'gallery_row';
    $decorator->template_row_mapping = core::array_kmap(['num', 'type', 'children']);
    if ($complex) {
      core::array_sort_by_weight($complex);
      foreach ($complex as $c_row_id => $c_item) {
        if (media::media_class_get($c_item->object->type) === 'audio') {
          $decorator->data[$c_row_id] = [
            'type'     => ['value' => 'audio'  ],
            'num'      => ['value' => $c_row_id],
            'children' => ['value' => static::item_markup_get($c_item, $c_row_id)]
          ];
        }
      }
    }
    return $decorator;
  }

  static function item_markup_get($item, $row_id) {
    return new markup('audio', ['src' => '/'.$item->object->get_current_path(true)] + $item->settings);
  }

}}