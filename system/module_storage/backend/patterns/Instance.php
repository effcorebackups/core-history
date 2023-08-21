<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

use stdClass;

#[\AllowDynamicProperties]

class Instance implements cache_cleaning_after_install {

    public $entity_name;
    public $values;
    public $_id_fields_original;

    function __construct($entity_name = '', $values = []) {
        $this->entity_set_name($entity_name);
        $this->values_set($values);
    }

    function __isset($name) {return isset($this->values[$name]);}
    function __get  ($name) {return       $this->values[$name] ;}
    function __set  ($name, $value) {
        # note: SQLite in fields of type "real" can store numbers in exponential form (example: 1.23e-6)
        $this->values[$name] = Core::exponencial_string_normalize($value);
    }

    function values_set($values) {$this->values = $values;}
    function values_get($names = []) {
        if (count($names)) {
            return array_intersect_key($this->values, Core::array_keys_map($names));
        } else {
            return $this->values;
        }
    }

    function values_id_get() {
        return $this->entity_get()->id_from_values_get($this->values_get());
    }

    function entity_get() {return Entity::get($this->entity_name);}
    function entity_set_name($entity_name) {$this->entity_name = $entity_name;}

    function select() {
        Event::start('on_instance_select_before', $this->entity_name, ['instance' => &$this]);
        $result = $this->entity_get()->storage_get()->instance_select($this);
        Event::start('on_instance_select_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
        return $result;
    }

    function insert() {
        Event::start('on_instance_insert_before', $this->entity_name, ['instance' => &$this]);
        $field_created = $this->entity_get()->field_get('created');
        $field_updated = $this->entity_get()->field_get('updated');
        if ($field_created !== null && empty($field_created->managing_is_enabled_on_insert) && $field_created->type === 'datetime') $this->created = Core::datetime_get();
        if ($field_created !== null && empty($field_created->managing_is_enabled_on_insert) && $field_created->type === 'integer' ) $this->created = time();
        if ($field_updated !== null && empty($field_updated->managing_is_enabled_on_insert) && $field_updated->type === 'datetime') $this->updated = Core::datetime_get();
        if ($field_updated !== null && empty($field_updated->managing_is_enabled_on_insert) && $field_updated->type === 'integer' ) $this->updated = time();
        $result = $this->entity_get()->storage_get()->instance_insert($this);
        Event::start('on_instance_insert_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
        return $result;
    }

    function update() {
        Event::start('on_instance_update_before', $this->entity_name, ['instance' => &$this]);
        $field_updated = $this->entity_get()->field_get('updated');
        if ($field_updated !== null && empty($field_updated->managing_is_enabled_on_update) && $field_updated->type === 'datetime') $this->updated = Core::datetime_get();
        if ($field_updated !== null && empty($field_updated->managing_is_enabled_on_update) && $field_updated->type === 'integer' ) $this->updated = time();
        $result = $this->entity_get()->storage_get()->instance_update($this);
        Event::start('on_instance_update_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
        return $result;
    }

    function delete() {
        Event::start('on_instance_delete_before', $this->entity_name, ['instance' => &$this]);
        $result = $this->entity_get()->storage_get()->instance_delete($this);
        Event::start('on_instance_delete_after',  $this->entity_name, ['instance' => &$this, 'result' => $result]);
        return $result;
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    function make_url_for_select() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get());          }
    function make_url_for_update() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get()).'/update';}
    function make_url_for_delete() {return '/manage/data/'.$this->entity_get()->managing_group_id.'/'.$this->entity_get()->name.'/'.implode('+', $this->values_id_get()).'/delete';}

    ###########################
    ### static declarations ###
    ###########################

    protected static $cache;
    protected static $cache_orig;

    static function cache_cleaning() {
        static::$cache      = null;
        static::$cache_orig = null;
    }

    static function init() {
        if (static::$cache === null) {
            static::$cache_orig = Storage::get('data')->select_array('instances');
            foreach (static::$cache_orig as $c_module_id => $c_instances) {
                foreach ($c_instances as $c_row_id => $c_instance) {
                    if (isset(static::$cache[$c_row_id])) Console::report_about_duplicate('instances', $c_row_id, $c_module_id, static::$cache[$c_row_id]);
                              static::$cache[$c_row_id] = $c_instance;
                              static::$cache[$c_row_id]->module_id = $c_module_id;
                }
            }
        }
    }

    static function get($row_id) {
        static::init();
        return static::$cache[$row_id] ?? null;
    }

    static function get_all_by_module($name) {
        static::init();
        return static::$cache_orig[$name] ?? [];
    }

    static function selection_make($entity_name, $where = [], $settings = []) {
        $entity = Entity::get($entity_name);
        if ($entity) {
            $c_weight = 420;
            $selection = new Selection;
            $selection->id = $entity_name.'-'.Core::hash_get($where);
            $selection->main_entity_name = $entity_name;
            $selection->template = 'content';
            $selection->origin = 'dynamic';
            $selection->title = $entity->title;
            $selection->query_settings['where'] = $entity->storage_get()->prepare_attributes($where);
            foreach ($entity->fields as $c_name => $c_field) {
                $selection->fields['main'][$c_name] = new stdClass;
                $selection->fields['main'][$c_name]->title = $c_field->title ?? null;
                $selection->fields['main'][$c_name]->entity_field_name = $c_name;
                $selection->fields['main'][$c_name]->weight = ($c_weight = $c_weight - 20);
            }
            return $selection;
        } else {
            return new Markup('x-no-items', ['data-style' => 'table'], new Text_multiline(
                ['Entity "%%_name" is not available.', 'Selection ID = "%%_id".'], ['name' => $entity_name, 'id' => $entity_name.'-'.Core::hash_get($where)]
            ));
        }
    }

}
