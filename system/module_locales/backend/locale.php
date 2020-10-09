<?php

  ##################################################################
  ### Copyright © 2017—2021 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          abstract class locale {

  static function         date_utc_to_loc($date)     {$date = \DateTime::createFromFormat('Y-m-d',         $date,     new \DateTimeZone('UTC') ); if ($date) return $date->setTime    (0, 0)                                            ->format('Y-m-d'        );}
  static function         time_utc_to_loc($time)     {$date = \DateTime::createFromFormat(      'H:i:s',   $time,     new \DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new \DateTimeZone(core::timezone_get_client()) )->format(      'H:i:s'  );}
  static function     datetime_utc_to_loc($datetime) {$date = \DateTime::createFromFormat('Y-m-d H:i:s',   $datetime, new \DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new \DateTimeZone(core::timezone_get_client()) )->format('Y-m-d H:i:s'  );}
  static function datetime_T_utc_to_T_loc($datetime) {$date = \DateTime::createFromFormat('Y-m-d\\TH:i:s', $datetime, new \DateTimeZone('UTC') ); if ($date) return $date->setTimezone( new \DateTimeZone(core::timezone_get_client()) )->format('Y-m-d\\TH:i:s');}

  static function         date_loc_to_utc($date)     {$date = \DateTime::createFromFormat('Y-m-d',         $date,     new \DateTimeZone('UTC')                       ); if ($date) return $date->setTime    (0, 0)                      ->format('Y-m-d'        );}
  static function         time_loc_to_utc($time)     {$date = \DateTime::createFromFormat(      'H:i:s',   $time,     new \DateTimeZone(core::timezone_get_client()) ); if ($date) return $date->setTimezone( new \DateTimeZone('UTC') )->format(      'H:i:s'  );}
  static function     datetime_loc_to_utc($datetime) {$date = \DateTime::createFromFormat('Y-m-d H:i:s',   $datetime, new \DateTimeZone(core::timezone_get_client()) ); if ($date) return $date->setTimezone( new \DateTimeZone('UTC') )->format('Y-m-d H:i:s'  );}
  static function datetime_T_loc_to_T_utc($datetime) {$date = \DateTime::createFromFormat('Y-m-d\\TH:i:s', $datetime, new \DateTimeZone(core::timezone_get_client()) ); if ($date) return $date->setTimezone( new \DateTimeZone('UTC') )->format('Y-m-d\\TH:i:s');}

  static function         format_date    ($date)     {$date = \DateTime::createFromFormat('Y-m-d',       $date,     new \DateTimeZone('UTC') );                                   if ($date) return $date->setTime    (0, 0)                                            ->format(module::settings_get('locales')->format_date    );}
  static function         format_time    ($time)     {$date = \DateTime::createFromFormat(      'H:i:s', $time,     new \DateTimeZone('UTC') );                                   if ($date) return $date->setTimezone( new \DateTimeZone(core::timezone_get_client()) )->format(module::settings_get('locales')->format_time    );}
  static function         format_datetime($datetime) {$date = \DateTime::createFromFormat('Y-m-d H:i:s', $datetime, new \DateTimeZone('UTC') );                                   if ($date) return $date->setTimezone( new \DateTimeZone(core::timezone_get_client()) )->format(module::settings_get('locales')->format_datetime);}
  static function         format_timestmp($timestmp) {$date = \DateTime::createFromFormat('U',           $timestmp + core::timezone_get_offset_sec(core::timezone_get_client())); if ($date) return $date                                                               ->format(module::settings_get('locales')->format_datetime);}

  static function format_number($number, $precision = 0, $dec_point = null, $thousands = null, $no_zeros = true) {
    $dec_point = $dec_point === null ? module::settings_get('locales')->decimal_point       : $dec_point;
    $thousands = $thousands === null ? module::settings_get('locales')->thousands_separator : $thousands;
    return core::format_number($number, $precision, $dec_point, $thousands, $no_zeros);
  }

  static function format_persent($number, $precision = 2) {return static::format_number(floatval($number), $precision).'%';}
  static function format_msecond($number, $precision = 6) {return static::format_number(floatval($number), $precision);}
  static function format_version($number)                 {return static::format_number(floatval($number), 3, null, null, false);}

  static function format_bytes($bytes) {
    $count = 0;
    $translation = core::bytes_to_abbreviated($bytes, true);
    if ($count === 0) $translation = str_replace('TiB', ' '.translation::apply('TiB'), $translation, $count);
    if ($count === 0) $translation = str_replace('GiB', ' '.translation::apply('GiB'), $translation, $count);
    if ($count === 0) $translation = str_replace('MiB', ' '.translation::apply('MiB'), $translation, $count);
    if ($count === 0) $translation = str_replace('KiB', ' '.translation::apply('KiB'), $translation, $count);
    if ($count === 0) $translation = str_replace('B',   ' '.translation::apply('B'  ), $translation);
    return $translation;
  }

  static function format_seconds($seconds) {
    return translation::apply('%%_number second%%_plural{number,s}', ['number' => $seconds]);
  }

  static function format_logic($value) {
    return $value ? 'yes' : 'no';
  }

}}