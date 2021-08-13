<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/**
 * OG_Tags_Front
 * Class responsible to create the HTML Tags
 *
 * @package           OG_Tags_Front
 * @since             2.0.0
 *
 */

if ( ! class_exists( 'OG_Tags_Front' ) ) {

	class OG_Tags_Front {

		/**
		 * The Core object
		 *
		 * @since    2.0.0
		 * @access   public
		 * @var      OG_Tags    $core	The core class
		 */
		private $core;

		/**
		 * Options
		 *
		 * @since    2.0.0
		 * @access   public
		 * @var      array    $options	The options
		 */
		private $options = array();

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
			
			$this->add_action( 'wp_head', array( $this, 'insert_tags' ) );

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
					trigger_error( __( 'Core was not passed in "OG_Tags_Front".' ), E_USER_WARNING );
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
					trigger_error( __( 'Core was not passed in "OG_Tags_Front".' ), E_USER_WARNING );
				}
			}

		}

		/**
		 * Just insert tags on head
		 *
		 * @since    2.0.0
		 */
		public function insert_tags() {

			// Tags comuns
			$this->insert_commons_tags();

			if ( is_single() ) {
				$this->insert_post_tags();				
			} else {
				$this->insert_site_tags();
			}

		}

		/**
		 * Tags for all pages
		 *
		 * @since    2.0.0
		 */
		private function insert_commons_tags() {

			$options = $this->get_options();

            echo '<!-- OG TAGS -->' . "\n";
			echo '<meta property="og:site_name" content="' . $options['ogtags_nomedoblog'] . '">' . "\n";

			$fbadmins = explode( " ", $options['ogtags_fbadmins'] );
			foreach ( $fbadmins as $admin ) {
				echo '<meta property="fb:admins" content="' . $admin . '">' . "\n";	
			}

		}

		/**
		 * Tags for posts
		 *
		 * @since    2.0.0
		 */
		private function insert_post_tags() {

			$options = $this->get_options();

			// Título
			if ( $options['ogtags_debug_filter'] ) {
				$ogtitle = wp_title( '', false );
			} else {
				$ogtitle = wp_title( '|', false, 'right' ) . " " . $options['ogtags_nomedoblog'];
			}

			// Descrioção e URL
			$ogdescription = get_the_excerpt(); 
			$ogurl = get_permalink();

			// Imagem
			if ( has_post_thumbnail() ) { 

				$ogimage = get_post_thumbnail_id();
				$ogimage = wp_get_attachment_image_src( $ogimage,'full', true );
				$ogimage = $ogimage[0];

			} else {

				$ogimage = $options['ogtags_image_default']; 

			}
			
			// Autor e Seção
			$articleauthor = get_the_author();
			$articlesection = get_the_category(); 
			$articlesection = $articlesection[0]->cat_name;

			// Tags
			$tags = wp_get_post_tags( get_the_ID() );
			
			foreach ( $tags as $tag ) {
				$articletag = $tag->name;
				echo '<meta property="article:tag" content="' . $articletag . '">' . "\n"; 
			}

			echo '<meta property="og:title" content="' . esc_attr( $ogtitle ) . '">' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $ogdescription ) . '">' . "\n";
			echo '<meta property="og:url" content="' . esc_attr( $ogurl ) . '">' . "\n";
			echo '<meta property="og:type" content="article">' . "\n";
			echo '<meta property="og:image" content="' . esc_attr( $ogimage ) . '">' . "\n";
			echo '<meta property="article:section" content="' . esc_attr( $articlesection ) . '">' . "\n";
			echo '<meta property="article:publisher" content="' . esc_attr( $options['ogtags_publisher'] ) . '">' . "\n";

		}

		/**
		 * Tags for rest site
		 *
		 * @since    2.0.0
		 */
		private function insert_site_tags() {

			$options = $this->get_options();

			// Título
			if ( $options['ogtags_debug_filter'] ) {
				$ogtitle = wp_title( '', false );
			} else {
				$ogtitle = wp_title( '|', false, 'right' ) . " " . $options['ogtags_nomedoblog'];
			}

			$ogurl = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			echo '<meta property="og:title" content="' . esc_attr( $ogtitle ) . '">' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $options['ogtags_descricaodoblog'] ) . '">' . "\n";
			echo '<meta property="og:url" content="' . esc_attr( $ogurl ) . '">' . "\n";
			echo '<meta property="og:type" content="website"> ' . "\n";
			echo '<meta property="og:image" content="' . esc_attr( $options['ogtags_image_default'] ) . '">' . "\n";

		}

		/**
		 * Get options
		 *
		 * @since    2.0.0
		 * @param 	 bool 	Retrieve from database
		 */
		private function get_options( $force = false ) {

			if ( $force || empty( $this->options ) ) {
				$this->options = get_option( 'ogtags_options' );
			}

			return $this->options;

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
