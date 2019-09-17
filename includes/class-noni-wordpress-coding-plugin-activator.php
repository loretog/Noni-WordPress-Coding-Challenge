<?php

/**
 * Fired during plugin activation
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/includes
 * @author     Nonibrands <dev@nonibrands.com>
 */
class Noni_Wordpress_Coding_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

   	$table_name = $wpdb->prefix . NONI_TABLE_NAME; 
   	$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
		  id int NOT NULL AUTO_INCREMENT,
		  user_id int NOT NULL,
		  address varchar(100),
		  address2 varchar(100),
		  city varchar(100),
		  province varchar(100),
		  postal_code varchar(15),
		  country varchar(20),		  
		  PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}
