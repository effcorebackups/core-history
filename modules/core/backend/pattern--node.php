<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effectivecore {
          class node extends \effectivecore\node_simple {

  public $children = [];

  function __construct($attributes = [], $children = [], $weight = 0) {
    parent::__construct($attributes, $weight);
  # ─────────────────────────────────────────────────────────────────────
  # allowed  : null, '', '...', 0, '0', 0.1, [], [...], obj{}, obj{...}
  # disalowed: boolean - not used and not controlled anywere!!!
  # ─────────────────────────────────────────────────────────────────────
    if ($children !== null) {
      foreach (is_array($children) ? $children : [$children] as $id => $c_child) {
        $this->child_insert($c_child, $id);
      }
    }
  }

  ################
  ### children ###
  ################

  function child_select($id) {
    return isset($this->children[$id]) ?
                 $this->children[$id] : null;
  }

  function child_select_first() {
    return reset($this->children);
  }

  function child_select_last() {
    return end($this->children);
  }

  function child_select_all_recursive($children = null, $dpath = '') {
    $return = [];
    foreach ($children ?: $this->children as $c_id => $c_child) {
      $c_dpath = $dpath ? $dpath.'/'.$c_id : $c_id;
      $return[$c_dpath] = $c_child;
      if (!empty($c_child->children)) {
        $return += $this->child_select_all_recursive($c_child->children, $c_dpath);
      }
    }
    return $return;
  }

  function child_delete($id) {
    unset($this->children[$id]);
  }

  function child_change($id, $new_child) {
    $this->children[$id] = $new_child;
  }

  function child_insert($child, $new_id = null) {
    $id = ($new_id !== null ?
           $new_id : count($this->children));
    $this->children[$id] = $child;
    return $id;
  }

  function child_insert_after($child, $after_id, $new_id = null) {
    $id = ($new_id !== null ?
           $new_id : count($this->children));
    $children = [];
    foreach ($this->children as $c_id => $c_child) {
      $children[$c_id] = $c_child;
      if ($c_id === $after_id) {
        $children[$id] = $child;
      }
    }
    $this->children = $children;
    return $id;
  }

  ##############
  ### render ###
  ##############

  function render() {
    if ($this->template) {
      return (new template($this->template, [
        'attributes' => factory::data_to_attr($this->attribute_select()),
        'self'       => $this->render_self(),
        'children'   => $this->render_children($this->children)
      ]))->render();
    } else {
      return $this->render_self().
             $this->render_children($this->children);
    }
  }

  function render_children($children, $join = true) {
    $rendered = [];
    foreach (factory::array_sort_by_weight($children) as $c_child) {
      $rendered[] = $this->render_child($c_child);
    }
    return $join ? implode('', $rendered) :
                               $rendered;
  }

  function render_child($child) {
    return method_exists($child, 'render') ? $child->render() :
                                             $child;
  }

}}