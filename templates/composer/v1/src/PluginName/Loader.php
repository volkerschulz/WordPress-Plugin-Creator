<?php

namespace PluginName;

use PluginName\Config;
use PluginName\Plugin;

class Loader {

    public static function run() : bool {

        /**
         * Enqueue admin scripts and styles
         */
        add_action( 'admin_enqueue_scripts', function() {
            wp_enqueue_style( Config::PLUGIN_SLUG . '-common', Config::get( 'plugin_dir_url' ) . 'css/common.css', [], Config::get( 'version' ), 'all' );
            wp_enqueue_script( Config::PLUGIN_SLUG . '-common', Config::get( 'plugin_dir_url' ) . 'js/common.js', [ 'jquery' ], Config::get( 'version' ), [ 'in_footer' => false ] );
            wp_enqueue_style( Config::PLUGIN_SLUG . '-admin', Config::get( 'plugin_dir_url' ) . 'css/admin.css', [ Config::PLUGIN_SLUG . '-common' ], Config::get( 'version' ), 'all' );
            wp_enqueue_script( Config::PLUGIN_SLUG . '-admin', Config::get( 'plugin_dir_url' ) . 'js/admin.js', [ 'jquery', Config::PLUGIN_SLUG . '-common' ], Config::get( 'version' ), [ 'in_footer' => false ] );
        } );
        

         /**
         * Enqueue public scripts and styles
         */
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_style( Config::PLUGIN_SLUG . '-common', Config::get( 'plugin_dir_url' ) . 'css/common.css', [], Config::get( 'version' ), 'all' );
            wp_enqueue_script( Config::PLUGIN_SLUG . '-common', Config::get( 'plugin_dir_url' ) . 'js/common.js', [ 'jquery' ], Config::get( 'version' ), [ 'in_footer' => false ] );
            wp_enqueue_style( Config::PLUGIN_SLUG . '-public', Config::get( 'plugin_dir_url' ) . 'css/public.css', [ Config::PLUGIN_SLUG . '-common' ], Config::get( 'version' ), 'all' );
            wp_enqueue_script( Config::PLUGIN_SLUG . '-public', Config::get( 'plugin_dir_url' ) . 'js/public.js', [ 'jquery', Config::PLUGIN_SLUG . '-common' ], Config::get( 'version' ), [ 'in_footer' => false ] );
        } );

        
        /**
         * Load i18n
         */
        add_action( 'plugins_loaded', function() {
            load_plugin_textdomain(
                'plugin-name',
                false,
                Config::get( 'plugin_dir_path' ) . 'languages/'
            );
        } );

        $plugin = New Plugin;
        return $plugin->run();
    }

}
