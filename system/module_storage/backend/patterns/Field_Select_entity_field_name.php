<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

use stdClass;

#[\AllowDynamicProperties]

class Field_Select_entity_field_name extends Field_Select {

    public $title = 'Field name';
    public $title__not_selected = '- select -';
    public $attributes = ['data-type' => 'entity_field_name'];
    public $element_attributes = [
        'name'     => 'entity_field_name',
        'required' => true
    ];

    function build() {
        if (!$this->is_builded) {
            parent::build();
            $items = [];
            $entities = Entity::get_all();
            Core::array_sort_by_string($entities);
            foreach ($entities as $c_entity) {
                if (!empty($c_entity->managing_is_enabled)) {
                    foreach ($c_entity->fields as $c_name => $c_field) {
                        if (!empty($c_field->managing->control->class)) {
                            if (!isset($items[$c_entity->name])) {
                                       $items[$c_entity->name] = new stdClass;
                                       $items[$c_entity->name]->title = $c_entity->title; }
                            $c_text_object = new Text_multiline(['title' => $c_field->title, 'id' => '(~'.$c_entity->name.'.'.$c_name.')'], [], ' ');
                            $c_text_object->_text_translated = $c_text_object->render();
                            $items[$c_entity->name]->items[$c_entity->name.'.'.$c_name] = $c_text_object;
                        }
                    }
                    Core::array_sort_by_string(
                        $items[$c_entity->name]->items, '_text_translated', Core::SORT_DSC, false
                    );
                }
            }
            $this->items = ['not_selected' => $this->title__not_selected] + $items;
            $this->is_builded = false;
            parent::build();
        }
    }

    function value_get_parsed() {
        return static::parse_value($this->value_get());
    }

    ###########################
    ### static declarations ###
    ###########################

    static function parse_value($value) {
        $parsed = is_string($value) && strlen($value) && strpos($value, '.') !== false ? explode('.', $value) : null;
        if (is_array($parsed) && count($parsed) === 2)
            return ['entity_name' => $parsed[0],
              'entity_field_name' => $parsed[1]];
        else return null;
    }

    static function generate_disabled_items($filter) {
        $result = [];
        $entities = Entity::get_all();
        foreach ($entities as $c_entity)
            if (!empty($c_entity->managing_is_enabled))
                foreach ($c_entity->fields as $c_name => $c_field)
                    if (!empty($c_field->managing->control->class))
                        if (!Core::in_array($c_entity->name, $filter))
                            $result[$c_entity->name.'.'.$c_name] =
                                    $c_entity->name.'.'.$c_name;
        return $result;
    }

}
