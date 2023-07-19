<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

#[\AllowDynamicProperties]

class Form_plugin {

    public $name;
    public $args = [];
    public $properties = [];
    public $weight = 0;

    function __construct($name = null, $args = [], $properties = [], $weight = 0) {
        if ($name      ) $this->name       = $name;
        if ($args      ) $this->args       = $args;
        if ($properties) $this->properties = $properties;
        if ($weight    ) $this->weight     = $weight;
    }

    function name_get() {
        return $this->name[0] === '\\' ?
               $this->name : '\\effcore\\'.$this->name;
    }

    function is_available() {
        return Core::structure_is_exists($this->name_get());
    }

    function object_get() {
        $object = Core::class_get_new_instance($this->name_get(), $this->args, true);
        if ($this->weight) $object->weight = $this->weight;
        foreach ($this->properties as $c_key => $c_value)
               $object->{$c_key} = $c_value;
        return $object;
    }

    function render() {
        return '';
    }

}
