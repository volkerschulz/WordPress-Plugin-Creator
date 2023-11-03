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

require_once ( 'vendor/autoload.php' );

