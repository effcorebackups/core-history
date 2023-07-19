<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

#[\AllowDynamicProperties]

class Micro_tabs extends Node {

    public $element_attributes = ['role' => 'micro_tabs-item'];
    public $items   = [];
    public $checked = [];

    function __construct($items = null, $checked = null) {
        if ($items  ) $this->items    = $items;
        if ($checked) $this->checked  = $checked;
        parent::__construct();
    }

    function build() {
        if (!$this->is_builded) {
            foreach ($this->items as $c_value => $c_info) {
                if (!$this->child_select($c_value)) {
                    if (is_string($c_info)) $c_info = (object)['title' => $c_info];
                    if (!isset($c_info->title                      )) $c_info->title  = $c_value;
                    if (!isset($c_info->weight                     )) $c_info->weight = 0;
                    if (!isset($c_info->element_attributes         )) $c_info->element_attributes = [];
                    if (!isset($c_info->element_attributes['value'])) $c_info->element_attributes['value'] = $c_value;
                    $c_field                     = new Field_Radiobutton;
                    $c_field->tag_name           = null;
                    $c_field->template           = 'container_content';
                    $c_field->title              = $c_info->title;
                    $c_field->weight             = $c_info->weight;
                    $c_field->element_attributes = $c_info->element_attributes + $this->attributes_select('element_attributes') + $c_field->attributes_select('element_attributes');
                    $c_field->build();
                                  $this->child_insert($c_field, $c_value);
                } else $c_field = $this->child_select($c_value);
                $c_field->checked_set(isset($this->checked[$c_value])); }
            $this->is_builded = true;
        }
    }

    function items_set($items = [], $ws_rebuild = true) {
        $this->items = $items;
        if ($ws_rebuild) {
            $this->is_builded = false;
            $this->build();
        }
    }

    function items_get() {
        return $this->items;
    }

}
