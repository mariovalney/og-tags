<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/**
 * OG_Tags_Dashboard
 * Class responsible to create dashboard page
 *
 * @package           OG_Tags_Dashboard
 * @since             2.0.0
 *
 */

if ( ! class_exists( 'OG_Tags_Dashboard' ) ) {

	class OG_Tags_Dashboard {

		/**
		 * The Core object
		 *
		 * @since    2.0.0
		 * @access   public
		 * @var      OG_Tags    $core	The core class
		 */
		private $core;

		/**
		 * The Module Indentify
		 *
		 * @since    2.0.0
		 * @access   public
		 * @var      OG_Tags    $core	The core class
		 */
		const MODULE_SLUG = "front";

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since    2.0.0
		 * @param    array		$core	The Core object
		 * @param    array		$tag	The Core Tag
		 */
		public function __construct( OG_Tags $core ) {

			$this->core = $core;

		}

		/**
		 * Register all the hooks for this module
		 *
		 * @since    2.0.0
		 * @access   private
		 */
		private function define_hooks() {

			$this->add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			$this->add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		}

		/**
		 * Add a new action to the collection to be registered with WordPress.
		 *
		 * @since    2.0.0
		 * @see    OG_Tags->add_action
		 */
		private function add_action( $hook, $callback, $priority = 10, $accepted_args = 1 ) {

			if ( $this->core != null ) {
				$this->core->add_action( $hook, $callback, $priority, $accepted_args );
			} else {
				if ( WP_DEBUG ) {
					trigger_error( __( 'Core was not passed in "OG_Tags_Dashboard".' ), E_USER_WARNING );
				}
			}

		}

		/**
		 * Add a new filter to the collection to be registered with WordPress.
		 *
		 * @since    2.0.0
		 * @see    OG_Tags->add_filter
		 */
		private function add_filter( $hook, $callback, $priority = 10, $accepted_args = 1 ) {

			if ( $this->core != null ) {
				$this->core->add_filter( $hook, $callback, $priority, $accepted_args );
			} else {
				if ( WP_DEBUG ) {
					trigger_error( __( 'Core was not passed in "OG_Tags_Dashboard".' ), E_USER_WARNING );
				}
			}

		}

		/**
		 * The Action "admin_menu"
		 *
		 * @since    2.0.0
		 */
		public function admin_menu() {

			add_options_page( __( 'OG Tags', OG_TAGS_TEXTDOMAIN ), __( 'OG Tags', OG_TAGS_TEXTDOMAIN ), 'manage_options', 'og-tags-options', array( $this, 'render_dashboard' ) );

		}

		/**
		 * The Action "admin_enqueue_scripts"
		 *
		 * @since    2.0.0
		 * @param    string		$string 	Text to be processed
		 */
		public function admin_enqueue_scripts( $hook ) {

		    if ( $hook == 'settings_page_og-tags-options' ) {
		    	wp_enqueue_media();
		    	wp_enqueue_style( 'og-tags-style', plugin_dir_url( __FILE__ ) . 'admin/css/og-tags.css' );
		        wp_enqueue_script( 'og-tags-script', plugin_dir_url( __FILE__ ) . 'admin/js/og-tags.js', array( 'jquery' ), OG_TAGS_VERSION );
				
				// Localize the script with new data
				$strings_script = array(
					'choose_image' => __( 'Escolha a Imagem', OG_TAGS_TEXTDOMAIN ),
				);
				wp_localize_script( 'og-tags-script', 'OGTAGS', $strings_script );
		    }

		}

		/**
		 * The Action "render_dashboard"
		 *
		 * @since    2.0.0
		 * @param    string		$string 	Text to be processed
		 */
		public function render_dashboard( $text ) {

			require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard.php';

		}

		/**
		 * Run the plugin.
		 *
		 * @since    2.0.0
		 */
		public function run() {

			$this->define_hooks();

		}

	}
}