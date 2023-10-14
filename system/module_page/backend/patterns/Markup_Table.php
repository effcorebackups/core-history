<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

#[\AllowDynamicProperties]

class Markup_Table extends Markup {

    public $tag_name = 'table';

    function __construct($attributes = [], $tbody = [], $thead = [], $weight = 0) {
        parent::__construct(null, $attributes, [], $weight);
        if (is_object($thead) === true && $thead instanceof Markup_Table_head) $this->child_insert(                          $thead,  'head');
        if (is_object($thead) !== true                                       ) $this->child_insert(new Markup_Table_head([], $thead), 'head');
        if (is_object($thead) === true && $tbody instanceof Markup_Table_body) $this->child_insert(                          $tbody,  'body');
        if (is_object($thead) !== true                                       ) $this->child_insert(new Markup_Table_body([], $tbody), 'body');
    }

}
