<?php

namespace volkerschulz\WordPressPluginCreator;

class Replace {

    protected static bool $bootstrapped = false;
    protected static Array $replaces = [
        '%%DISPLAY_NAME%%'      => Names::DEFAULT_NAME,
        'plugin_name'           => 'plugin_name',
        'plugin-name'           => 'plugin-name',
        'Plugin_Name'           => 'Plugin_Name',
        'PLUGIN_NAME'           => 'PLUGIN_NAME',
        '%%CONTRIBUTOR_IDS%%'   => '(this should be a list of wordpress.org userids)',
        '%%DONATE_LINK%%'       => 'https://example.com/donate',
        '%%TAGS_LIST%%'         => 'firsttag, secondtag',
        '%%LICENSE_NAME%%'      => 'GPLv3 or later',
        '%%LICENSE_URI%%'       => 'https://www.gnu.org/licenses/gpl-3.0.html',
        '%%VERSION%%'           => '1.0.0',
        '%%AUTHOR_NAME%%'       => 'Your Name or Your Company',
        '%%AUTHOR_WEBSITE%%'    => 'https://example.com/',
        '%%DOC_LINK%%'          => 'https://example.com/',
    ];

    public static function getAll() : Array {
        self::bootstrap();
        return self::$replaces;
    }

    public static function allInFile(String $file) : bool {
        self::bootstrap();

        if(!file_exists($file))
            return false;

        $contents = file_get_contents($file);
        foreach(self::$replaces as $k=>$v) {
            $contents = str_replace($k, $v, $contents);
        }
        file_put_contents($file, $contents);
        return true;
    }

    private static function bootstrap() : void {
        if(self::$bootstrapped)
            return;

        self::loadNames();
        self::loadConfig();

        self::$bootstrapped = true;
    }

    private static function loadNames() : void {
        $names = Names::getAll();
        self::$replaces['%%DISPLAY_NAME%%'] = $names['display_name'];
        self::$replaces['plugin_name'] = $names['lc_underscore'];
        self::$replaces['plugin-name'] = $names['lc_dash'];
        self::$replaces['Plugin_Name'] = $names['pc_underscore'];
        self::$replaces['PLUGIN_NAME'] = $names['uc_underscore'];
        return;
    }

    private static function loadConfig() : void {
        if(!empty(Config::get('name')))
            self::$replaces['%%AUTHOR_NAME%%'] = Config::get('name');

        if(!empty(Config::get('website')))
            self::$replaces['%%AUTHOR_WEBSITE%%'] = Config::get('website');

        if(!empty(Config::get('initial_version')))
            self::$replaces['%%VERSION%%'] = Config::get('initial_version');

        if(!empty(Config::get('doc_link')))
            self::$replaces['%%DOC_LINK%%'] = Config::get('doc_link');

        return;
    }
}