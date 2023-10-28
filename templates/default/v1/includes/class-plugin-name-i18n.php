<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       %%DOC_LINK%%
 * @since      %%VERSION%%
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      %%VERSION%%
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */
class Plugin_Name_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    %%VERSION%%
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}