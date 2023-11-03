<?php

namespace PluginName;

class Config {

    public const PLUGIN_SLUG = 'plugin-name';

    protected static Array $values = [];

    public static function set( String $key, String $value ) : Void {
        self::$values[$key] = $value;
    }

    public static function get( String $key ) : mixed {
        return isset(self::$values[$key]) ? self::$values[$key] : null;
    }

}
