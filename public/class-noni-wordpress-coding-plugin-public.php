<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/public
 * @author     Nonibrands <dev@nonibrands.com>
 */
class Noni_Wordpress_Coding_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'noni-wordpress-form', [ $this, 'noni_wordpress_form_shortcode' ] );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Noni_Wordpress_Coding_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Noni_Wordpress_Coding_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/noni-wordpress-coding-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Noni_Wordpress_Coding_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Noni_Wordpress_Coding_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/noni-wordpress-coding-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

	public function noni_wordpress_form_shortcode( $atts ) {
		$message = "";		
		if( isset( $_POST[ 'noni-wordpress-save-info' ] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'save_info' ) ) {
			global $wpdb;
			$table_name = $wpdb->prefix . NONI_TABLE_NAME;

			$user_id = sanitize_text_field( $_POST[ 'user_id' ] );
			$address = sanitize_text_field( $_POST[ 'address' ] );
			$address2 = sanitize_text_field( $_POST[ 'address2' ] );
			$city = sanitize_text_field( $_POST[ 'city' ] );
			$province = sanitize_text_field( $_POST[ 'province' ] );
			$postal_code = sanitize_text_field( $_POST[ 'postal_code' ] );
			$country = sanitize_text_field( $_POST[ 'contry' ] );

			if( $wpdb->insert( 
				$table_name, 
				array( 
					'user_id' => $user_id, 
					'address' => $address, 
					'address2' => $address2, 
					'city' => $city, 
					'province' => $province, 
					'postal_code' => $postal_code, 
					'country' => $country, 					
				) 
			) ) {
				$message = "<h2 style='color: green;'>Address successfully updated!</h2>";
			}	else {
				$message = "<h2 style='color: red;'>Something went wrong, please try again.</h2>";			
			}
		} 
		ob_start();		
		echo $message;
		include dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'noni-wordpress-coding-plugin-public-display.php';
		return ob_get_clean();
	}	

}

