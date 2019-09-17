<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/admin
 * @author     Nonibrands <dev@nonibrands.com>
 */
class Noni_Wordpress_Coding_Plugin_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'noni-wordpress-api', [ $this, 'noni_wordpress_api_shortcode' ] );
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/noni-wordpress-coding-plugin-admin.css', array(), $this->version, 'all' );		

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/noni-wordpress-coding-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function add_admin_menu() {
		$page_title = 'Nonibrands';   
		$menu_title = 'Nonibrands Settings';   
		$capability = 'manage_options';   
		$menu_slug  = 'nonibrands-options-page';   
		$function   = 'admin_page';   
		$icon_url   = 'dashicons-media-code';   
		$position   = 4;    
		add_menu_page( $page_title, $menu_title, $capability, $menu_slug,[ $this, $function ], $icon_url, $position );
	}	

	public function admin_page() {		
		include dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'noni-wordpress-coding-plugin-admin-display.php';
	}

	private function get_articles() {
		$ch = curl_init('https://newsapi.org/v2/top-headlines?country=us&apiKey=' . get_option( 'nonibrands-api-key' ) );		
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if(curl_errno($ch) == 0 AND $http == 200) {
				// [articles][source][id], [articles][source][name]
				// [articles][author], [articles][title], [articles][description], [articles][url], [articles][urlToImage], [articles][publishedAt], [articles][content]
		    $decode = json_decode($data, true);		    
		    return $decode;
		}	else {
			return null;
		}
	}

	private function list_articles( $ids = [] ) {
		$articles = $this->get_articles();	
		$li = null;			
		if( $articles[ 'status' ] == "ok" ) {			
			foreach( $articles[ 'articles' ] as $article ) {
				$checked = "";
				if( isset( $ids ) && !empty( $ids ) ) {
					$checked = in_array( $article['source']['name'], $ids ) ? "checked" : "";
				}
				/*$li[] = "<input type='checkbox' name='article_id[]' $checked value='{$article['source']['name']}'> {$article['title']} by {$article['author']}";*/
				$li[] = "{$article['title']} by {$article['author']}";
			}
			return $li;
		} else {
			return null;
		}
	}

	public function noni_wordpress_api_shortcode( $atts ) {
		ob_start();		
		$articles = $this->get_articles();		
		echo "<h2>Articles</h2>";
		if( $articles[ 'status' ] == "ok" ) {
			echo "<input type='text' id='search_by_title' placeholder='Search by Title'>";
			echo "<ul class='noni-articles'>";
			foreach( $articles['articles'] as $article ) {			
				/*if( !in_array( $article['source']['name'], json_decode( get_option( 'nonibrands-selected-articles' ) ) ) ) {
					continue;
				}*/
				echo "<li><p><a class='noni-title' href='{$article['url']}'>{$article['title']}</a> by <em>{$article['author']}</em></p> <p>{$article['description']}</p></li>";
			}
			echo "</ul>";		
			?>
			<script type="text/javascript">
				jQuery("#search_by_title").keyup(function () {
				    var filter = jQuery(this).val();
				    jQuery(".noni-articles li").each(function () {
				        if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
				            jQuery(this).hide();
				        } else {
				            jQuery(this).show();
				        }
				    });
				});
			</script>
			<?php			
		} else {
			echo "<span style='color: red;'>Something is wrong, please check your API key.</span>";
		}
		return ob_get_clean();
	}	

}
