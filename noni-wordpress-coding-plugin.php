<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              noni
 * @since             1.0.0
 * @package           Noni_Wordpress_Coding_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Noni-Wordpress-Coding-Challenge - Loreto Gabawa Jr.
 * Plugin URI:        noni
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area. Added api connection, shortcodes, admin menu page, admin option page, forms and validation. Tested under Twenty Nineteen theme.
 * Version:           1.0.1
 * Author:            Nonibrands
 * Author URI:        noni
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       noni-wordpress-coding-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NONI_WORDPRESS_CODING_PLUGIN_VERSION', '1.0.0' );

define( 'NONI_TABLE_NAME', 'noni_user_address' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-noni-wordpress-coding-plugin-activator.php
 */
function activate_noni_wordpress_coding_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-noni-wordpress-coding-plugin-activator.php';
	Noni_Wordpress_Coding_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-noni-wordpress-coding-plugin-deactivator.php
 */
function deactivate_noni_wordpress_coding_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-noni-wordpress-coding-plugin-deactivator.php';
	Noni_Wordpress_Coding_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_noni_wordpress_coding_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_noni_wordpress_coding_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-noni-wordpress-coding-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_noni_wordpress_coding_plugin() {

	$plugin = new Noni_Wordpress_Coding_Plugin();
	$plugin->run();

}
run_noni_wordpress_coding_plugin();
