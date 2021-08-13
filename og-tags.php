<?php

/**
 *
 * @package           OG_Tags
 * @since             2.0.0
 *
 * Plugin Name:       OG Tags
 * Plugin URI:        http://projetos.mariovalney.com/og-tags
 * Description:       A plugin for optimization of Open Graph Tags for WordPress sites.
 * Version:           2.0.2
 * Author:            Mário Valney
 * Author URI:        http://mariovalney.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       og-tags
 * Domain Path:       /languages
 *
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'OG_Tags' ) ) {

	class OG_Tags {

		/**
		 * The unique internal identifier of this plugin to avoid overwritten class. 
		 * Discussed with @gugaalves and @leobaiano in WordCamp Fortaleza 2016...
		 *
		 * @since    2.0.0
		 * @access   public
		 * @var      string    $class_tag	The string used to uniquely identify this class.
		 */
		public $class_tag;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    2.0.0
		 * @access   protected
		 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
		 */
		protected $plugin_name;

		/**
		 * The current version of the plugin.
		 *
		 * @since    2.0.0
		 * @access   protected
		 * @var      string    $version    The current version of the plugin.
		 */
		protected $version;

		/**
		 * The array of actions registered with WordPress.
		 *
		 * @since    2.0.0
		 * @access   protected
		 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
		 */
		protected $actions;

		/**
		 * The array of filters registered with WordPress.
		 *
		 * @since    2.0.0
		 * @access   protected
		 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
		 */
		protected $filters;

		/**
		 * The array of modules of plugin.
		 *
		 * @since    2.0.0
		 * @access   protected
		 * @var      array    $modules    The modules to be used in this plugin.
		 */
		protected $modules;

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since    2.0.0
		 */
		public function __construct() {

			$this->plugin_name = OG_TAGS_TEXTDOMAIN;
			$this->version = OG_TAGS_VERSION;
			$this->class_tag = OG_TAGS_TAG;

			$this->actions = $this->filters = $this->modules = array();

			$this->define_hooks();
			$this->add_modules();

		}

		/**
		 * The name of the plugin.
		 *
		 * @since     2.0.0
		 * @return    string    The name of the plugin.
		 */
		public function get_plugin_name() {

			return $this->plugin_name;

		}

		/**
		 * The version number of the plugin.
		 *
		 * @since     2.0.0
		 * @return    string    The version number of the plugin.
		 */
		public function get_version() {

			return $this->version;

		}

		/**
		 * Register the hooks for Core
		 *
		 * @since    2.0.0
		 * @access   private
		 */
		private function define_hooks() {

			// Activation
			register_activation_hook( __FILE__, array( $this, 'plugin_install' ) );

			//Deactivation
			register_deactivation_hook( __FILE__, array( $this, 'plugin_uninstall' ) );

			// Internationalization
			$this->add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			// Plugins Action Link
			$this->add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'add_action_links' ) );

		}

		/**
		 * Load all the plugins modules.
		 *
		 * @since    2.0.0
		 * @access   private
		 */
		private function add_modules() {

			require_once plugin_dir_path( __FILE__ ) . 'modules/front/class-og-tags-front.php';
			require_once plugin_dir_path( __FILE__ ) . 'modules/dashboard/class-og-tags-dashboard.php';

			$this->modules['front'] = new OG_Tags_Front( $this, OG_TAGS_TAG );
			$this->modules['dashboard'] = new OG_Tags_Dashboard( $this, OG_TAGS_TAG );

		}

		/**
		 * A utility function that is used to register the actions and hooks into a single
		 * collection.
		 *
		 * @since    2.0.0
		 * @access   private
		 * @param    array		$hooks				The collection of hooks that is being registered (that is, actions or filters).
		 * @param    string 	$hook 				The name of the WordPress filter that is being registered.
		 * @param    string 	$callback 			The callback function or a array( $obj, 'method' ) to public method of a class.
		 * @param    int		$priority 			The priority at which the function should be fired.
		 * @param    int		$accepted_args 		The number of arguments that should be passed to the $callback.
		 * @return   array 							The collection of actions and filters registered with WordPress.
		 */
		private function add_hook( $hooks, $hook, $callback, $priority, $accepted_args ) {

			$hooks[] = array(
				'hook'          => $hook,
				'callback'      => $callback,
				'priority'      => $priority,
				'accepted_args' => $accepted_args
			);

			return $hooks;

		}

		/**
		 * Add a new action to the collection to be registered with WordPress.
		 *
		 * @since    2.0.0
		 * @param    string		$hook             The name of the WordPress action that is being registered.
		 * @param    string		$callback         The callback function or a array( $obj, 'method' ) to public method of a class.
		 * @param    int		$priority         Optional. he priority at which the function should be fired. Default is 10.
		 * @param    int		$accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
		 */
		public function add_action( $hook, $callback, $priority = 10, $accepted_args = 1 ) {

			$this->actions = $this->add_hook( $this->actions, $hook, $callback, $priority, $accepted_args );

		}

		/**
		 * Add a new filter to the collection to be registered with WordPress.
		 *
		 * @since    2.0.0
		 * @param    string		$hook             The name of the WordPress filter that is being registered.
		 * @param    string		$callback         The callback function or a array( $obj, 'method' ) to public method of a class.
		 * @param    int		$priority         Optional. he priority at which the function should be fired. Default is 10.
		 * @param    int		$accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
		 */
		public function add_filter( $hook, $callback, $priority = 10, $accepted_args = 1 ) {

			$this->filters = $this->add_hook( $this->filters, $hook, $callback, $priority, $accepted_args );

		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 *
		 * @since    2.0.0
		 * @access   public
		 */
		public function load_plugin_textdomain() {

			load_plugin_textdomain( OG_TAGS_TEXTDOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages/' );

		}

		/**
		 * Add "Settings" link in Plugins dashboard
		 *
		 *
		 * @since    2.0.0
		 * @access   public
		 * @param    array		$links     Links (HTML)
		 */
		public function add_action_links( $links ) {

			$ogtags_links = array(
				'<a href="' . admin_url( 'options-general.php?page=og-tags-options' ) . '">' . __( "Settings" ) . '</a>',
			);
			return array_merge( $ogtags_links, $links );

		}

		/**
		 * Run tasks on Install
		 *
		 *
		 * @since    2.0.0
		 * @access   private
		 */
		public function plugin_install() {

			$locale = get_locale();

			if ( file_exists( plugin_dir_path( __FILE__ ) . 'images/facebook-' . $locale . '.jpg' ) ) {
				$default_image = plugins_url( 'images/facebook-' . $locale . '.jpg', __FILE__ );
			} else if ( file_exists( plugin_dir_path( __FILE__ ) . 'images/facebook-' . substr( $locale, 0, 2 ) . '.jpg' ) ) {
				$default_image = plugins_url( 'images/facebook-' . substr( $locale, 0, 2 ) . '.jpg', __FILE__ );
			} else {
				$default_image = plugins_url( 'images/facebook.jpg', __FILE__ );
			}

			// Adding Options
			$ogtags_options = array(
				'ogtags_fbadmins'			=> '',
				'ogtags_publisher'			=> 'https://www.facebook.com/facebook',
				'ogtags_image_default'		=> $default_image,
				'ogtags_nomedoblog' 		=> get_bloginfo( 'name' ),
				'ogtags_descricaodoblog'	=> get_bloginfo( 'description' ),
				'ogtags_debug_filter' 		=> '0',
			);

			add_option( 'ogtags_options', $ogtags_options );

		}

		/**
		 * Run tasks on Uninstall
		 *
		 *
		 * @since    2.0.0
		 * @access   private
		 */
		public function plugin_uninstall() {

			delete_option( 'ogtags_options' );

		}

		/**
		 * Run the plugin.
		 *
		 * @since    2.0.0
		 */
		public function run() {

			define( 'OG_TAGS_LOADED', '1' );

			// Running Modules (first of all)
			foreach ( $this->modules as $module ) {
				$module->run();
			}

			// Running Filters
			foreach ( $this->filters as $hook ) {
				add_filter( $hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args'] );
			}

			// Running Actions
			foreach ( $this->actions as $hook ) {
				add_action( $hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args'] );
			}

		}

	}
}

/**
 * Making things happening
 *
 * @since    2.0.0
 */
function og_tags_start() {

	define( 'OG_TAGS_VERSION', '2.0.2' );
	define( 'OG_TAGS_TEXTDOMAIN', 'og-tags' );
	define( 'OG_TAGS_TAG', 'og_tags_core' );

	$plugin = new OG_Tags();

	if ( OG_TAGS_TAG == $plugin->class_tag ) {
		$plugin->run();
	} else {
		trigger_error( __( 'The OG_Tags was overwritten...' ), E_USER_WARNING );
	}

}

og_tags_start();
