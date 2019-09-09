<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/includes
 * @author     Nonibrands <dev@nonibrands.com>
 */
class Noni_Wordpress_Coding_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'noni-wordpress-coding-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
