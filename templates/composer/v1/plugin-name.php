<?php
/**
 * Plugin Name:       %%DISPLAY_NAME%%
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           %%VERSION%%
 * Author:            %%AUTHOR_NAME%%
 * Author URI:        %%AUTHOR_WEBSITE%%
 * License:           %%LICENSE_NAME%%
 * License URI:       %%LICENSE_URI%%
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

use PluginName\Config;
use PluginName\Activator;
use PluginName\Deactivator;
use PluginName\Loader;

require_once( 'vendor/autoload.php' );


/**
 * PLUGIN CONFIG
 */
Config::set( 'plugin_dir_url', plugin_dir_url( __FILE__ ) );
Config::set( 'plugin_dir_path', plugin_dir_path( __FILE__ ) );
Config::parseHeader( realpath( __FILE__ ) );


/**
 * PLUGIN ACTIVATION
 */
register_activation_hook( __FILE__, function() {
	Activator::run();
} );


/**
 * PLUGIN DEACTIVATION
 */
register_deactivation_hook( __FILE__, function() {
	Deactivator::run();
} );


/**
 * PLUGIN LOADER
 */
Loader::run();
