<?php

namespace volkerschulz\WordPressPluginCreator;

class Files {

    protected static String $template_folder;
    protected static Array $copy_tasks;

    public static function copyFromTemplate(String $template_folder) : bool {
        $template_folder = rtrim($template_folder, "/\\");
        if(!file_exists($template_folder) || !is_dir($template_folder)) 
            return false;

        self::$template_folder = $template_folder;

        $names = Names::getAll();
        if(!$names)
            return false;

        self::createCopyTasks($template_folder);
        
        if(self::createCopies() === false)
            return false;

        return true;
    }

    private static function createCopyTasks(String $folder) : void {
        $files = glob($folder . '/*');
        foreach($files as $file) {
            if(is_dir($file)) {
                self::createCopyTasks($file);
            }
            elseif(is_file($file)) {
                $source_rel = self::pathRelativeToBase($file, self::$template_folder);
                self::$copy_tasks[] = [
                    'source' => $source_rel,
                    'source_base'  => self::$template_folder,
                    'target' => self::renameFilesAndFolders($source_rel),
                    'target_base'  => Folders::getAll()['plugin_root']
                ];
            }
        }
        return;
    }

    private static function renameFilesAndFolders(String $path) {
        $names = Names::getAll();
        if($names===false)
            return $path;

        $renamed = str_replace('plugin-name', $names['lc_dash'], $path);
        $renamed = str_replace('plugin_name', $names['lc_underscore'], $renamed);
        $renamed = str_replace('Plugin_Name', $names['pc_underscore'], $renamed);
        $renamed = str_replace('PLUGIN_NAME', $names['uc_underscore'], $renamed);
        return $renamed;
    } 

    private static function pathRelativeToBase(String $path, String $base) : String {
        $path = realpath($path);
        $base = realpath($base);
        if(empty($base))
            return $path;
        $pos = strpos($path, $base);
        if($pos === 0) {
            return substr($path, strlen($base));
        }
        return $path;
    }

    private static function createCopies() : bool {
        foreach(self::$copy_tasks as $task) {
            if(!copy($task['source_base'] . $task['source'], $task['target_base'] . $task['target'])) 
                return false;

            Replace::allInFile($task['target_base'] . $task['target']);
        }
        return true;
    }

}