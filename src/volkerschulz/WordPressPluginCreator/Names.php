<?php

namespace volkerschulz\WordPressPluginCreator;

class Names {

    const DEFAULT_NAME = 'WordPress Test Plugin';

    protected static Array $name_collection = [
        'display_name'      => self::DEFAULT_NAME,
        'lc_dash'           => '',
        'lc_underscore'     => '',
        'pc_underscore'     => '',
        'uc_underscore'     => '',
        'pc_plain'          => ''
    ];

    public static function createFromDisplayName(String $display_name) : bool|Array {
        self::$name_collection['display_name'] = $display_name;

        self::$name_collection['lc_dash'] = 
            strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $display_name));

        self::$name_collection['lc_underscore'] = 
            strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $display_name));

        self::$name_collection['pc_underscore'] = 
            implode('_', array_map(function($value) {
                return ucfirst(($value));
            }, explode('_', self::$name_collection['lc_underscore'])));

        self::$name_collection['uc_underscore'] = 
            strtoupper(self::$name_collection['pc_underscore']);

        self::$name_collection['pc_plain'] = 
            str_replace('_', '', self::$name_collection['pc_underscore']);

        if(!self::isComplete())
            return false;

        return self::getAll();
    }

    public static function getAll() : bool|Array {
        if(!self::isComplete())
            return self::createFromDisplayName(self::DEFAULT_NAME);
        return self::$name_collection;
    }

    private static function isComplete() : bool {
        foreach(self::$name_collection as $key=>$value) {
            if(empty($value))
                return false;
        }
        return true;
    }

}