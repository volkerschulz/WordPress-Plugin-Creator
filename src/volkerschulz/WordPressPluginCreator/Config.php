<?php

namespace volkerschulz\WordPressPluginCreator;

class Config {

    protected static bool $bootstrapped = false;
    protected static Array $options = [];

    public static function load(String $path) : bool {
        $path = realpath($path);
        if(file_exists($path) && is_dir($path))
            $path .= '/config.ini';

        if(file_exists($path) && is_file($path)) 
            $values = parse_ini_file($path);

        if(!empty($values) && is_array($values)) {
            self::$options = $values;
            return true;
        }
        return false;
    }

    public static function get(String $key) : String | null {
        if(empty(self::$options[$key]))
            return null;
        
        return (string)self::$options[$key];
    }

}