<?php

  ##################################################################
  ### Copyright © 2017—2019 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class tree extends node {

  public $id;
  public $title = '';
  public $template = 'tree';

  function __construct($title = '', $attributes = [], $children = [], $weight = 0) {
    if ($title) $this->title = $title;
    parent::__construct($attributes, $children, $weight);
  }

  ###########################
  ### static declarations ###
  ###########################

  static protected $cache_trees;
  static protected $cache_tree_items;

  static function init() {
    foreach (storage::get('files')->select('trees') as $c_module_id => $c_trees) {
      foreach ($c_trees as $c_row_id => $c_tree) {
        if (isset(static::$cache_trees[$c_tree->id])) console::log_about_duplicate_add('tree', $c_tree->id);
        static::$cache_trees[$c_tree->id] = $c_tree;
        static::$cache_trees[$c_tree->id]->module_id = $c_module_id;
      }
    }
    foreach (storage::get('files')->select('tree_items') as $c_module_id => $c_tree_items) {
      foreach ($c_tree_items as $c_row_id => $c_tree_item) {
        if (isset(static::$cache_tree_items[$c_tree_item->id])) console::log_about_duplicate_add('tree_item', $c_tree_item->id);
        static::$cache_tree_items[$c_tree_item->id] = $c_tree_item;
        static::$cache_tree_items[$c_tree_item->id]->module_id = $c_module_id;
      }
    }
  }

  static function get($id) {
    return static::$cache_trees[$id] ?? null;
  }

  static function all_get() {
    return static::$cache_trees;
  }

  static function item_select($id) {
    return static::$cache_tree_items[$id] ?? null;
  }

  static function items_select() {
    return static::$cache_tree_items;
  }

  static function build($items = null) {
    foreach ($items ?: static::items_select() as $c_item) {
      if ($c_item->id_parent) {
        $c_parent = $c_item->id_parent[0] == 'M' &&
                    $c_item->id_parent[1] == ':' ?
                    static::get (substr($c_item->id_parent, 2)) :
                    static::item_select($c_item->id_parent);
        $c_parent->child_insert($c_item, $c_item->id);
      }
    };
  }

}}