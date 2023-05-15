<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

class Url {

    # valid urls:
    # ┌────────────────────────────────────────────────────────────╥──────────┬────────────────────────────┬────────────────────┬─────────────┬──────────┬────────────────────────────────────────────────────────────────────┬─────────────────────────────────────┐
    # │ url                                                        ║ protocol │ domain                     │ path               │ query       │ anchor   │ full_get                                                           │ tiny_get                            │
    # ╞════════════════════════════════════════════════════════════╬══════════╪════════════════════════════╪════════════════════╪═════════════╪══════════╪════════════════════════════════════════════════════════════════════╪═════════════════════════════════════╡
    # │                        '/'                                 ║ 'http'   │ 'current.subdomain.domain' │ '/'                │ ''          │ ''       │ 'http://current.subdomain.domain'                                  │ '/'                                 │
    # │                        '/?key=value'                       ║ 'http'   │ 'current.subdomain.domain' │ '/'                │ 'key=value' │ ''       │ 'http://current.subdomain.domain/?key=value'                       │ '/?key=value'                       │
    # │                        '/#anchor'                          ║ 'http'   │ 'current.subdomain.domain' │ '/'                │ ''          │ 'anchor' │ 'http://current.subdomain.domain/#anchor'                          │ '/#anchor'                          │
    # │                        '/?key=value#anchor'                ║ 'http'   │ 'current.subdomain.domain' │ '/'                │ 'key=value' │ 'anchor' │ 'http://current.subdomain.domain/?key=value#anchor'                │ '/?key=value#anchor'                │
    # │                        '/dir/subdir/page'                  ║ 'http'   │ 'current.subdomain.domain' │ '/dir/subdir/page' │ ''          │ ''       │ 'http://current.subdomain.domain/dir/subdir/page'                  │ '/dir/subdir/page'                  │
    # │                        '/dir/subdir/page?key=value'        ║ 'http'   │ 'current.subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ ''       │ 'http://current.subdomain.domain/dir/subdir/page?key=value'        │ '/dir/subdir/page?key=value'        │
    # │                        '/dir/subdir/page#anchor'           ║ 'http'   │ 'current.subdomain.domain' │ '/dir/subdir/page' │ ''          │ 'anchor' │ 'http://current.subdomain.domain/dir/subdir/page#anchor'           │ '/dir/subdir/page#anchor'           │
    # │                        '/dir/subdir/page?key=value#anchor' ║ 'http'   │ 'current.subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ 'anchor' │ 'http://current.subdomain.domain/dir/subdir/page?key=value#anchor' │ '/dir/subdir/page?key=value#anchor' │
    # │        'subdomain.domain'                                  ║ 'http'   │         'subdomain.domain' │ '/'                │ ''          │ ''       │         'http://subdomain.domain'                                  │ '/'                                 │
    # │        'subdomain.domain/?key=value'                       ║ 'http'   │         'subdomain.domain' │ '/'                │ 'key=value' │ ''       │         'http://subdomain.domain/?key=value'                       │ '/?key=value'                       │
    # │        'subdomain.domain/#anchor'                          ║ 'http'   │         'subdomain.domain' │ '/'                │ ''          │ 'anchor' │         'http://subdomain.domain/#anchor'                          │ '/#anchor'                          │
    # │        'subdomain.domain/?key=value#anchor'                ║ 'http'   │         'subdomain.domain' │ '/'                │ 'key=value' │ 'anchor' │         'http://subdomain.domain/?key=value#anchor'                │ '/?key=value#anchor'                │
    # │        'subdomain.domain/dir/subdir/page'                  ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ ''          │ ''       │         'http://subdomain.domain/dir/subdir/page'                  │ '/dir/subdir/page'                  │
    # │        'subdomain.domain/dir/subdir/page?key=value'        ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ ''       │         'http://subdomain.domain/dir/subdir/page?key=value'        │ '/dir/subdir/page?key=value'        │
    # │        'subdomain.domain/dir/subdir/page#anchor'           ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ ''          │ 'anchor' │         'http://subdomain.domain/dir/subdir/page#anchor'           │ '/dir/subdir/page#anchor'           │
    # │        'subdomain.domain/dir/subdir/page?key=value#anchor' ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ 'anchor' │         'http://subdomain.domain/dir/subdir/page?key=value#anchor' │ '/dir/subdir/page?key=value#anchor' │
    # │ 'http://subdomain.domain'                                  ║ 'http'   │         'subdomain.domain' │ '/'                │ ''          │ ''       │         'http://subdomain.domain'                                  │ '/'                                 │
    # │ 'http://subdomain.domain/?key=value'                       ║ 'http'   │         'subdomain.domain' │ '/'                │ 'key=value' │ ''       │         'http://subdomain.domain/?key=value'                       │ '/?key=value'                       │
    # │ 'http://subdomain.domain/#anchor'                          ║ 'http'   │         'subdomain.domain' │ '/'                │ ''          │ 'anchor' │         'http://subdomain.domain/#anchor'                          │ '/#anchor'                          │
    # │ 'http://subdomain.domain/?key=value#anchor'                ║ 'http'   │         'subdomain.domain' │ '/'                │ 'key=value' │ 'anchor' │         'http://subdomain.domain/?key=value#anchor'                │ '/?key=value#anchor'                │
    # │ 'http://subdomain.domain/dir/subdir/page'                  ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ ''          │ ''       │         'http://subdomain.domain/dir/subdir/page'                  │ '/dir/subdir/page'                  │
    # │ 'http://subdomain.domain/dir/subdir/page?key=value'        ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ ''       │         'http://subdomain.domain/dir/subdir/page?key=value'        │ '/dir/subdir/page?key=value'        │
    # │ 'http://subdomain.domain/dir/subdir/page#anchor'           ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ ''          │ 'anchor' │         'http://subdomain.domain/dir/subdir/page#anchor'           │ '/dir/subdir/page#anchor'           │
    # │ 'http://subdomain.domain/dir/subdir/page?key=value#anchor' ║ 'http'   │         'subdomain.domain' │ '/dir/subdir/page' │ 'key=value' │ 'anchor' │         'http://subdomain.domain/dir/subdir/page?key=value#anchor' │ '/dir/subdir/page?key=value#anchor' │
    # └────────────────────────────────────────────────────────────╨──────────┴────────────────────────────┴────────────────────┴─────────────┴──────────┴────────────────────────────────────────────────────────────────────┴─────────────────────────────────────┘

    # wrong urls:
    # ┌──────────────────────────╥──────────────────────────────────────────────────────────────────────┐
    # │ url                      ║ behavior                                                             │
    # ╞══════════════════════════╬══════════════════════════════════════════════════════════════════════╡
    # │ http://subdomain.domain/ ║ should be redirected to 'http://subdomain.domain'                    │
    # │ subdomain.domain/        ║ should be redirected to 'http://subdomain.domain'                    │
    # │ /subdomain.domain        ║ this domain described like a path (first character is the slash)     │
    # │ dir/subdir/page          ║ this path described like a domain (first character is not the slash) │
    # └──────────────────────────╨──────────────────────────────────────────────────────────────────────┘

    # ────────────────────────────────────────────────────────────────────────────────────────────────
    # note:
    # ════════════════════════════════════════════════════════════════════════════════════════════════
    # 1. in the next url 'http://name:password@subdomain.domain:port/dir/subdir/page?key=value#anchor'
    #    the name, password and port values after parsing will be in the $domain property.
    #    in any case, the use of credentials in this form is deprecated.
    #    for more details see RFC 3986 clause 3.2.1 (user information) and 7.5 (sensitive information)
    # 2. anchor is not sent through the browser
    # ────────────────────────────────────────────────────────────────────────────────────────────────

    # ────────────────────────────────────────────────────────────────────────────────────────────────
    # PCRE note:
    # ═══╦════════════════════════════════════════════════════════════════════════════════════════════
    # L  ║ Letter (Includes the following properties: Ll, Lm, Lo, Lt and Lu.)
    # Ll ║ Lower case letter
    # Lm ║ Modifier letter
    # Lo ║ Other letter
    # Lt ║ Title case letter
    # Lu ║ Upper case letter
    # ───╨────────────────────────────────────────────────────────────────────────────────────────────
    # utf8 letters: '[[:alpha:]]' === '[\\p{L}]' === '[\\p{Ll}\\p{Lm}\\p{Lo}\\p{Lt}\\p{Lu}]'
    # officially allowed characters: ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_,;:.!?+-*/='"`^~(){}[]<>|\$#@%&
    # officially allowed characters ACSII range: '[\\x21-\\x7e]'
    # ────────────────────────────────────────────────────────────────────────────────────────────────

    const IS_DECODE_NOTHING   = 0b00;
    const IS_DECODE_DOMAIN    = 0b01;
    const IS_DECODE_PATH      = 0b10;
    const VALID_UNICODE_RANGE = '\\p{Ll}\\p{Lo}\\p{Lt}\\p{Lu}';

    public $raw;
    public $protocol;
    public $domain;
    public $port;
    public $path;
    public $query;
    public $anchor;
    public $has_error;

    function __construct($url, $options = []) {
        $options += ['completion' => true, 'decode' => static::IS_DECODE_PATH, 'extra' => static::VALID_UNICODE_RANGE];
        $this->raw = (string)$url;
        $matches = [];
        preg_match('%^(?:(?<protocol>[a-zA-Z]+)://|)'.
                        '(?<domain>['.$options['extra'].'a-zA-Z0-9\\-\\.]{2,200}(?:\\:(?<port>[0-9]{1,5})|)|)'.
                         '(?<path>/['.$options['extra'].'\\x21-\\x22\\x24-\\x3e\\x40-\\x7e]*|)'. # \\x21-\\x7e + [^?#] === \\x21-\\x22 + \\x24-\\x3e + \\x40-\\x7e
                   '(?:\\?(?<query>['.$options['extra'].'\\x21-\\x22\\x24-\\x7e]*)|)'.           # \\x21-\\x7e +  [^#] === \\x21-\\x22 + \\x24-\\x7e
                  '(?:\\#(?<anchor>['.$options['extra'].'\\x21-\\x7e]*)|)$%uS', $this->raw, $matches);
        $protocol = array_key_exists('protocol', $matches) ? $matches['protocol'] : '';
        $domain   = array_key_exists('domain',   $matches) ? $matches['domain'  ] : '';
        $port     = array_key_exists('port',     $matches) ? $matches['port'    ] : '';
        $path     = array_key_exists('path',     $matches) ? $matches['path'    ] : '';
        $query    = array_key_exists('query',    $matches) ? $matches['query'   ] : '';
        $anchor   = array_key_exists('anchor',   $matches) ? $matches['anchor'  ] : '';
        # matrix check
        if ( (!strlen($protocol) && !strlen($domain) &&  strlen($path) && !strlen($query) && !strlen($anchor)) ||  #                  /path
             (!strlen($protocol) && !strlen($domain) &&  strlen($path) &&  strlen($query) && !strlen($anchor)) ||  #                  /path?query
             (!strlen($protocol) && !strlen($domain) &&  strlen($path) && !strlen($query) &&  strlen($anchor)) ||  #                  /path#anchor
             (!strlen($protocol) && !strlen($domain) &&  strlen($path) &&  strlen($query) &&  strlen($anchor)) ||  #                  /path?query#anchor
             (!strlen($protocol) &&  strlen($domain) && !strlen($path) && !strlen($query) && !strlen($anchor)) ||  #            domain
             (!strlen($protocol) &&  strlen($domain) &&  strlen($path) && !strlen($query) && !strlen($anchor)) ||  #            domain/path
             (!strlen($protocol) &&  strlen($domain) &&  strlen($path) &&  strlen($query) && !strlen($anchor)) ||  #            domain/path?query
             (!strlen($protocol) &&  strlen($domain) &&  strlen($path) && !strlen($query) &&  strlen($anchor)) ||  #            domain/path?#anchor
             (!strlen($protocol) &&  strlen($domain) &&  strlen($path) &&  strlen($query) &&  strlen($anchor)) ||  #            domain/path?query#anchor
             ( strlen($protocol) &&  strlen($domain) && !strlen($path) && !strlen($query) && !strlen($anchor)) ||  # protocol://domain
             ( strlen($protocol) &&  strlen($domain) &&  strlen($path) && !strlen($query) && !strlen($anchor)) ||  # protocol://domain/path
             ( strlen($protocol) &&  strlen($domain) &&  strlen($path) &&  strlen($query) && !strlen($anchor)) ||  # protocol://domain/path?query
             ( strlen($protocol) &&  strlen($domain) &&  strlen($path) && !strlen($query) &&  strlen($anchor)) ||  # protocol://domain/path?#anchor
             ( strlen($protocol) &&  strlen($domain) &&  strlen($path) &&  strlen($query) &&  strlen($anchor)) ) { # protocol://domain/path?query#anchor
            $this->protocol  = $protocol;
            $this->domain    = $domain;
            $this->port      = $port;
            $this->path      = $path;
            $this->query     = $query;
            $this->anchor    = $anchor;
            $this->has_error = false;
            if ($options['completion'] && $this->protocol === '') $this->protocol = $this->domain === Request::host_get(false) ? Request::scheme_get() : 'http';
            if ($options['completion'] && $this->domain   === '') $this->domain   =                   Request::host_get(false);
            if ($options['completion'] && $this->path     === '') $this->path     = '/';
            if ($options['decode'] & static::IS_DECODE_DOMAIN && function_exists('idn_to_utf8') && idn_to_utf8($this->domain)) $this->domain = idn_to_utf8($this->domain);
            if ($options['decode'] & static::IS_DECODE_PATH) $this->path = rawurldecode($this->path);
        } else $this->has_error = true;
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    function tiny_get() {
        if (!$this->has_error) {
            $result = $this->path;
            if ($this->query ) $result.= '?'.$this->query;
            if ($this->anchor) $result.= '#'.$this->anchor;
            return $result;
        }
    }

    function full_get() {
        if (!$this->has_error) {
            $result = $this->path;
            if ($this->domain  ) $result =     $this->domain.$result;
            if ($this->protocol) $result =     $this->protocol.'://'.$result;
            if ($this->query   ) $result.= '?'.$this->query;
            if ($this->anchor  ) $result.= '#'.$this->anchor;
            return rtrim($result, '/');
        }
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    function query_arg_select($name        ) {if ($this->has_error) return; $args = []; parse_str($this->query, $args); return $args[$name] ?? null;                                                                     }
    function query_arg_insert($name, $value) {if ($this->has_error) return; $args = []; parse_str($this->query, $args);        $args[$name] = $value; $this->query = http_build_query($args, '', '&', PHP_QUERY_RFC3986);}
    function query_arg_delete($name        ) {if ($this->has_error) return; $args = []; parse_str($this->query, $args);  unset($args[$name]);         $this->query = http_build_query($args, '', '&', PHP_QUERY_RFC3986);}

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    function path_arg_select($name) {
        if (!$this->has_error) {
            $args = explode('/', $this->path);
            return $args[$name] ?? null;
        }
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    function file_info_get() {
        if (!$this->has_error) {
            return new File(rtrim(DIR_ROOT, '/').$this->path);
        }
    }

    function file_type_get() {
        if (!$this->has_error) {
            return ltrim(strtolower(strrchr($this->path, '.')), '.');
        }
    }

    ###########################
    ### static declarations ###
    ###########################

    protected static $cache;

    static function cache_cleaning() {
        static::$cache = null;
    }

    static function init() {
        if (static::$cache === null)
            static::$cache = new static(Request::uri_get());
    }

    static function get_current() {
        static::init();
        return static::$cache;
    }

    static function is_local($url, $decode = false) {
        if (strlen($url) === 0                   ) return true;
        if (strlen($url) !== 0 && $url[0] === '/') return true;
        if (strlen($url) !== 0 && (new static($url, ['decode' => $decode ? static::IS_DECODE_DOMAIN : static::IS_DECODE_NOTHING]))->domain === Request::host_get($decode)) return true;
        return false;
    }

    static function is_active($url, $compare_type = 'full') {
        $checked_url = new static($url);
        $current_url =     static::get_current();
        switch ($compare_type) {
            case 'full': return $checked_url->full_get() ===
                                $current_url->full_get();
            case 'path': return $checked_url->domain.$checked_url->path ===
                                $current_url->domain.$current_url->path;
        }
    }

    static function is_active_trail($url) {
        $checked_url = new static($url);
        $current_url =     static::get_current();
        return strpos($current_url->full_get().'/',
                      $checked_url->full_get().'/') === 0;
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function utf8_encode($value, $prefix = '', $range = self::VALID_UNICODE_RANGE) {
        return preg_replace_callback('%(?<char>['.$range.'])%uS', function ($c_match) use ($prefix) {
            if (strlen($c_match['char']) === 1) return                               $c_match['char'][0];
            if (strlen($c_match['char']) === 2) return $prefix.strtoupper(dechex(ord($c_match['char'][0]))).$prefix.strtoupper(dechex(ord($c_match['char'][1])));
            if (strlen($c_match['char']) === 3) return $prefix.strtoupper(dechex(ord($c_match['char'][0]))).$prefix.strtoupper(dechex(ord($c_match['char'][1]))).$prefix.strtoupper(dechex(ord($c_match['char'][2])));
            if (strlen($c_match['char']) === 4) return $prefix.strtoupper(dechex(ord($c_match['char'][0]))).$prefix.strtoupper(dechex(ord($c_match['char'][1]))).$prefix.strtoupper(dechex(ord($c_match['char'][2]))).$prefix.strtoupper(dechex(ord($c_match['char'][3])));
        }, $value);
    }

    static function url_to_markup($url) {
        $info = new static($url, ['completion' => false]);
        if (!$info->has_error) {
            return new Markup('x-url', [], [
                'protocol' => new Markup('x-protocol', [], new Text($info->protocol ? $info->protocol.'://' : '', [], false, false)),
                'domain'   => new Markup('x-domain',   [], new Text($info->domain, [], false, false)),
                'path'     => new Markup('x-path',     [], new Text(str_replace('/', (new Markup('x-slash', [], '/'))->render(), $info->path), [], false, false)),
                'query'    => new Markup('x-query',    [], new Text($info->query  ? '?'.$info->query  : '', [], false, false)),
                'anchor'   => new Markup('x-anchor',   [], new Text($info->anchor ? '#'.$info->anchor : '', [], false, false))
            ]);
        } else return new Text;
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function back_url_get($arg_name = 'back') {
        $query_arg = Request::value_get($arg_name, 0, '_GET');
        $url = new static(static::is_local($query_arg) ? $query_arg : null);
        return $url->has_error ? '' :
               $url->full_get();
    }

    static function back_url_set($arg_name = 'back', $url = '') {
        Request::values_set($arg_name, $url, '_GET');
    }

    static function back_part_make($arg_name = 'back', $url = null) {
        if ($url) return $arg_name.'='.urlencode($url);
        else      return $arg_name.'='.urlencode(static::get_current()->tiny_get());
    }

    static function go($url) {
        $messages = Message::select_all(false);
        foreach ($messages as $c_type => $c_messages)
            foreach ($c_messages as $c_message)
                Message::insert_to_storage($c_message, $c_type);
        Response::send_header_and_exit('redirect', null, null,
            (new static($url))->full_get()
        );
    }

}
