<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

use DateTime;
use DateTimeZone;

abstract class Locale {

    static function         date_utc_to_loc($date)     {$date = DateTime::createFromFormat('Y-m-d',         $date,     new DateTimeZone('UTC') ); if ($date) return $date->setTime    (0, 0)                                           ->format('Y-m-d'        );}
    static function         time_utc_to_loc($time)     {$date = DateTime::createFromFormat(      'H:i:s',   $time,     new DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new DateTimeZone(Core::timezone_get_client()) )->format(      'H:i:s'  );}
    static function     datetime_utc_to_loc($datetime) {$date = DateTime::createFromFormat('Y-m-d H:i:s',   $datetime, new DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new DateTimeZone(Core::timezone_get_client()) )->format('Y-m-d H:i:s'  );}
    static function datetime_T_utc_to_T_loc($datetime) {$date = DateTime::createFromFormat('Y-m-d\\TH:i:s', $datetime, new DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new DateTimeZone(Core::timezone_get_client()) )->format('Y-m-d\\TH:i:s');}

    static function         date_loc_to_utc($date)     {$date = DateTime::createFromFormat('Y-m-d',         $date,     new DateTimeZone('UTC')                       ); if ($date) return $date->setTime    (0, 0)                     ->format('Y-m-d'        );}
    static function         time_loc_to_utc($time)     {$date = DateTime::createFromFormat(      'H:i:s',   $time,     new DateTimeZone(Core::timezone_get_client()) ); if ($date) return $date->setTimezone( new DateTimeZone('UTC') )->format(      'H:i:s'  );}
    static function     datetime_loc_to_utc($datetime) {$date = DateTime::createFromFormat('Y-m-d H:i:s',   $datetime, new DateTimeZone(Core::timezone_get_client()) ); if ($date) return $date->setTimezone( new DateTimeZone('UTC') )->format('Y-m-d H:i:s'  );}
    static function datetime_T_loc_to_T_utc($datetime) {$date = DateTime::createFromFormat('Y-m-d\\TH:i:s', $datetime, new DateTimeZone(Core::timezone_get_client()) ); if ($date) return $date->setTimezone( new DateTimeZone('UTC') )->format('Y-m-d\\TH:i:s');}

    static function         format_date    ($date)     {$date = DateTime::createFromFormat('Y-m-d',       $date,     new DateTimeZone('UTC') ); if ($date) return $date->setTime    (0, 0)                                           ->format( Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['date'    ] : Language::get('en')->formats_get()['date'    ] );}
    static function         format_time    ($time)     {$date = DateTime::createFromFormat(      'H:i:s', $time,     new DateTimeZone('UTC') ); if ($date) return $date                                                              ->format( Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['time'    ] : Language::get('en')->formats_get()['time'    ] );}
    static function         format_datetime($datetime) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $datetime, new DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new DateTimeZone(Core::timezone_get_client()) )->format( Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['datetime'] : Language::get('en')->formats_get()['datetime'] );}
    static function         format_timestmp($timestmp) {$date = DateTime::createFromFormat('U',           $timestmp, new DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new DateTimeZone(Core::timezone_get_client()) )->format( Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['datetime'] : Language::get('en')->formats_get()['datetime'] );}

    static function format_number($number, $precision = 0, $dec_point = null, $thousands = null, $no_zeros = true) {
        $dec_point = $dec_point === null ? (Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['decimal_point'      ] : Language::get('en')->formats_get()['decimal_point'      ]) : $dec_point;
        $thousands = $thousands === null ? (Language::get(Language::code_get_current()) ? Language::get(Language::code_get_current())->formats_get()['thousands_separator'] : Language::get('en')->formats_get()['thousands_separator']) : $thousands;
        return Core::format_number($number, $precision, $dec_point, $thousands, $no_zeros);
    }

    static function format_bytes($bytes, $is_IEC = true) {
        if ($bytes && fmod($bytes, 1024 ** 4) === .0) return static::format_number($bytes / 1024 ** 4).' '.($is_IEC ? Translation::apply('TiB') : Translation::apply('T'));
        if ($bytes && fmod($bytes, 1024 ** 3) === .0) return static::format_number($bytes / 1024 ** 3).' '.($is_IEC ? Translation::apply('GiB') : Translation::apply('G'));
        if ($bytes && fmod($bytes, 1024 ** 2) === .0) return static::format_number($bytes / 1024 ** 2).' '.($is_IEC ? Translation::apply('MiB') : Translation::apply('M'));
        if ($bytes && fmod($bytes, 1024 ** 1) === .0) return static::format_number($bytes / 1024 ** 1).' '.($is_IEC ? Translation::apply('KiB') : Translation::apply('K'));
        else                                          return static::format_number($bytes            ).' '.(                                      Translation::apply('B'));
    }

    static function format_persent($number, $precision = 2) {return static::format_number(floatval($number), $precision).'%';}
    static function format_msecond($number, $precision = 6) {return static::format_number(floatval($number), $precision, null, null, false);}
    static function format_version($number)                 {return static::format_number(floatval($number), 3, null, null, false);}

    static function format_seconds($seconds) {
        return Translation::apply('%%_number second%%_plural(number|s)', ['number' => $seconds]);
    }

    static function format_pieces($number) {
        return static::format_number($number).' '.Translation::apply('pcs.');
    }

}
