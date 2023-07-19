<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

#[\AllowDynamicProperties]

class Field_Checkbox extends Field_Radiobutton {

    public $title;
    public $title_position = 'bottom';
    public $attributes = ['data-type' => 'checkbox'];
    public $element_attributes = [
        'type'  => 'checkbox',
        'name'  => 'checkbox',
        'value' => 'on'
    ];

    function build() {
        parent::build();
        $element = $this->child_select('element');
        $element->attribute_insert('data-state-default', $this->checked_get() ? 'checked' : 'not_checked');
    }

    function render() {
        $this->build();
        return parent::render();
    }

}
