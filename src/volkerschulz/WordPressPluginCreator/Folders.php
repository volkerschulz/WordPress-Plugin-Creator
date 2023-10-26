<?php

namespace volkerschulz\WordPressPluginCreator;

class Folders {

    protected static $directories = [];

    public static function create(String $target_folder) : bool {
        $target_folder = rtrim($target_folder, "/\\");
        if(!file_exists($target_folder) || !is_dir($target_folder)) 
            return false;

        $names = Names::getAll();
        if(!$names)
            return false;

        $plugin_root = $target_folder . '/' . $names['lc_dash'];
        if(!mkdir($plugin_root))
            return false;

        // 1st level   
        self::$directories['admin'] = $plugin_root . '/admin';
        self::$directories['includes'] = $plugin_root . '/includes';
        self::$directories['languages'] = $plugin_root . '/languages';
        self::$directories['public'] = $plugin_root . '/public';

        // 2nd level
        self::$directories['admin_css'] = $plugin_root . '/admin/css';
        self::$directories['admin_js'] = $plugin_root . '/admin/js';
        self::$directories['admin_partials'] = $plugin_root . '/admin/partials';
        self::$directories['public_css'] = $plugin_root . '/public/css';
        self::$directories['public_js'] = $plugin_root . '/public/js';
        self::$directories['public_partials'] = $plugin_root . '/public/partials';


        return self::createDirectories(self::$directories);

    }

    private static function createDirectories(Array $directories) : bool {
        foreach($directories as $key=>$value) {
            if(!mkdir($value))
                return false;
        }
        return true;
    }

}