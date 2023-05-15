<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

class Event implements Should_clear_cache_after_on_install {

    public $for;
    public $handler;
    public $skip_console_log = false;
    public $weight = 0;

    ###########################
    ### static declarations ###
    ###########################

    protected static $cache;

    static function cache_cleaning() {
        static::$cache = null;
    }

    static function init() {
        if (static::$cache === null) {
            Console::log_insert('event', 'init.', 'event system was initialized');
            foreach (Storage::get('data')->select_array('events') as $c_module_id => $c_type_group) {
                foreach ($c_type_group as $c_type => $c_events) {
                    foreach ($c_events as $c_row_id => $c_event) {
                        $c_event->module_id = $c_module_id;
                        static::$cache[$c_type][] = $c_event;
                    }
                }
            }
            foreach (static::$cache as $c_type => $c_group) {
                if (count($c_group) > 1) {
                    Core::array_sort_by_number(static::$cache[$c_type]);
                }
            }
        }
    }

    static function get_all() {
        static::init();
        return static::$cache;
    }

    #                                                    ╔════════════════════════════════════════════╗
    #                                                    ║ - module_1_id_x|Event                      ║
    #                                                 ┌─▶║     for: idX                               ║
    #                                                 │  ║     handler: \…\module_1\Events_A::on_name ║
    #                                                 │  ╠────────────────────────────────────────────╣
    # ╔═══════════════════════════════════════════╗   │  ║ - module_2_id_y|Event                      ║
    # ║ Event::start('on_name', null, [&$param1]) ║───┼─▶║     for: idY                               ║
    # ╚═══════════════════════════════════════════╝   │  ║     handler: \…\module_2\Events_B::on_name ║
    #                                                 │  ╠────────────────────────────────────────────╣
    #                                                 │  ║ - module_3_all|Event                       ║
    #                                                 └─▶║     for: null                              ║
    #                                                    ║     handler: \…\module_3\Events_C::on_name ║
    #                                                    ╚════════════════════════════════════════════╝
    #
    #                                                    ╔════════════════════════════════════════════╗
    #                                                    ║ - module_1_id_x|Event                      ║
    #                                                 ┌─▶║     for: idX                               ║
    #                                                 │  ║     handler: \…\module_1\Events_A::on_name ║
    #                                                 │  ╠────────────────────────────────────────────╣
    # ╔═══════════════════════════════════════════╗   │  ║ - module_2_id_y|Event                      ║
    # ║ Event::start('on_name', 'idX' [&$param1]) ║───┤  ║     for: idY                               ║
    # ╚═══════════════════════════════════════════╝   │  ║     handler: \…\module_2\Events_B::on_name ║
    #                                                 │  ╠────────────────────────────────────────────╣
    #                                                 │  ║ - module_3_all|Event                       ║
    #                                                 └─▶║     for: null                              ║
    #                                                    ║     handler: \…\module_3\Events_C::on_name ║
    #                                                    ╚════════════════════════════════════════════╝

    static function start($type, $for = null, $args = [], $on_before_step = null, $on_after_step = null) {
        $result = [];
        if (!empty(static::get_all()[$type])) {
            foreach (static::get_all()[$type] as $c_event) {
                if ($for === null          ||
                    $for === $c_event->for ||
                             $c_event->for === null) {
                    if ($c_event->skip_console_log === false) Console::log_insert('event', 'beginning', ltrim($c_event->handler, '\\'), null, 0);
                    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦
                    Timer::tap('event call: '.$type);
                    if ($on_before_step)                       call_user_func_array($on_before_step,   ['event' => $c_event] + $args);
                    $result[$c_event->handler][] = $c_return = call_user_func_array($c_event->handler, ['event' => $c_event] + $args);
                    if ($on_after_step)                        call_user_func_array($on_after_step,    ['event' => $c_event] + $args);
                    Timer::tap('event call: '.$type);
                    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦
                    if ($c_event->skip_console_log === false) Console::log_insert('event', 'ending', ltrim($c_event->handler, '\\'), $c_return ? 'ok' : null, Timer::period_get('event call: '.$type, -1, -2));
                    if (!empty($c_event->is_last)) {
                        break;
                    }
                }
            }
        }
        return $result;
    }

    static function start_local($method, &$object, $args = []) {
        static::start('on_event_start_local_before', null, ['method' => $method, 'object' => &$object, 'args' => $args]);
        $result = call_user_func_array(get_class($object).'::'.$method, [&$object] + $args);
        static::start('on_event_start_local_after',  null, ['method' => $method, 'object' => &$object, 'args' => $args]);
        return $result;
    }

}
