<?php

namespace volkerschulz\WordPressPluginCreator;

class Folders {

    protected static Array $directories = [];
    protected static String $plugin_root;
    protected static String $template_root;

    public static function createFromTemplate(String $template_directory, String $output_directory) : bool {
        $output_directory = rtrim($output_directory, "/\\");
        $template_directory = rtrim($template_directory, "/\\");
        if(!file_exists($output_directory) || !is_dir($output_directory)) 
            return false;

        if(!file_exists($template_directory) || !is_dir($template_directory))
            return false;

        $names = Names::getAll();
        if(!$names)
            return false;

        self::$template_root = $template_directory;

        $plugin_root = $output_directory . '/' . $names['lc_dash'];
        if(!mkdir($plugin_root))
            return false;

        self::$plugin_root = $plugin_root;

        self::getStructureFromDirectory($template_directory);

        return self::createDirectories(self::$directories);
    }

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

        self::$plugin_root = $plugin_root;

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

    public static function getAll() : bool|Array {
        return array_merge(['plugin_root' => self::$plugin_root], self::$directories);
    }

    private static function getStructureFromDirectory(String $directory, bool $recursive_call=false) : Void {
        $files = glob($directory . '/*');
        $base_replace = '/'.preg_quote(realpath(self::$template_root), '/').'/';
        foreach($files as $file) {
            if(is_dir($file)) {
                self::$directories[] = self::$plugin_root . self::renameFilesAndFolders(preg_replace($base_replace, '', $file, 1));
                self::getStructureFromDirectory($file, true);
            }
        }
        if(!$recursive_call) {
            // TBD: Sort
            usort(self::$directories, function($a, $b) { 
                return strlen($a)-strlen($b);
            });
        }
    }

    private static function renameFilesAndFolders(String $path) : String {
        $names = Names::getAll();
        if($names===false)
            return $path;

        $renamed = str_replace('plugin-name', $names['lc_dash'], $path);
        $renamed = str_replace('plugin_name', $names['lc_underscore'], $renamed);
        $renamed = str_replace('Plugin_Name', $names['pc_underscore'], $renamed);
        $renamed = str_replace('PLUGIN_NAME', $names['uc_underscore'], $renamed);
        $renamed = str_replace('PluginName', $names['pc_plain'], $renamed);
        return $renamed;
    } 

    private static function createDirectories(Array $directories) : bool {
        foreach($directories as $key=>$value) {
            if(!mkdir($value))
                return false;
        }
        return true;
    }

}