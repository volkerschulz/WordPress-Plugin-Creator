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

    /**
     * Undocumented function
     * 
     * From https://github.com/tutv/wp-package-parser/tree/develop/src (MIT license)
     *
     * @param String $bootstrap_file
     * @return boolean
     */
    public static function parseHeader( String $bootstrap_file ) : bool {
        if(!file_exists($bootstrap_file))
            return false;

        $header_map = [
            'name'           => 'Plugin Name',
            'plugin_uri'     => 'Plugin URI',
            'version'        => 'Version',
            'description'    => 'Description',
            'author'         => 'Author',
            'author_profile' => 'Author URI',
            'text_domain'    => 'Text Domain',
            'domain_path'    => 'Domain Path',
            'network'        => 'Network'
        ];

        $file_contents = str_replace( "\r", "\n", file_get_contents($bootstrap_file) );

        foreach ( $header_map as $field => $pretty_name ) {
            $found = preg_match( '/^[ \t\/*#@]*' . preg_quote( $pretty_name, '/' ) . ':(.*)$/mi', $file_contents, $matches );
            if ( ( $found > 0 ) && ! empty( $matches[1] ) ) {
                $value = trim( preg_replace( "/\s*(?:\*\/|\?>).*/", '', $matches[1] ) );
                self::set( $field, $value );
            } else {
                self::set( $field, '' );
            }
        }

        return true;
    }

}
