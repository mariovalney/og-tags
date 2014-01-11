<?php
/*
Plugin Name: OG Tags
Plugin URI: http://projetos.jangal.com.br/ogtags/
Description: Um plugin para otimização das Open Graph Tags em sites Wordpress.
Version: 1.1.4
Author: Mário Valney
Author URI: http://mariovalney.jangal.com.br

 *      Copyright 2013 Mário Valney <mariovalney@gmail.com>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

// EVITAR ACESSO DIRETO
	if ( ! defined( 'WPINC' ) ) {
		echo '<h1>You Shall Not Pass!</h1>';
		die;
	}

// INSTALL
	register_activation_hook( __FILE__, 'ogtags_install' );

	function ogtags_install() {
		require_once ('og-tags-install.php');
	}

// UNINSTALL
	register_deactivation_hook( __FILE__, 'ogtags_uninstall' );

	function ogtags_uninstall() {
		require_once ('og-tags-uninstall.php');
	}

// ADMINISTRATION
	add_action( 'admin_menu', 'ogtags_administration' );
	add_action( 'admin_head', 'ogtags_administration_style');
	add_action(	'admin_enqueue_scripts', 'ogtags_administration_scripts');
 
	function ogtags_administration() {
		add_options_page( 'OG Tags', 'OG Tags', 'manage_options', 'og-tags-options', 'ogtags_administration_content' );
	}

	function ogtags_administration_style() {
		echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'og-tags.css', __FILE__ ).'" />';
	}

	function ogtags_administration_scripts() {
	    if (isset($_GET['page']) && $_GET['page'] == 'og-tags-options') {
	        wp_enqueue_media();
	        wp_register_script('og-tags-js', WP_PLUGIN_URL.'/og-tags/og-tags.js', array('jquery'));
	        wp_enqueue_script('og-tags-js');
	    }
	}

	function ogtags_administration_content() {
		require_once ('og-tags-options.php');
	}

// ADDING ACTION IN HOOK
	add_action( 'wp_head', 'ogtags_insert_tags' );

// INSERT OG TAGS ON HEAD - FAZENDO A MÁGICA ACONTECER
function ogtags_insert_tags() {

	// RECEBENDO O VALOR DAS OPÇÕES
	$ogtags_options = get_option( 'ogtags_options' );
	
	$ognomedoblog = $ogtags_options['ogtags_nomedoblog'];
	$ogdescricaodoblog = $ogtags_options['ogtags_descricaodoblog'];
	$ogimagedefault = $ogtags_options['ogtags_image_default'];
	$fbadmins = $ogtags_options['ogtags_fbadmins'];
	$articlepublisher = $ogtags_options['ogtags_publisher'];
	$ogdebugfilter = $ogtags_options['ogtags_debug_filter'];

	// DEMAIS VARIÁVEIS DEFAULT
	$ogurldoblog = get_bloginfo('url');

	// TAGS FOR ENTIRE SITE
	echo '<meta property="og:site_name"   content="'.$ognomedoblog.'" />';

	$fbadmins = explode(" ",$fbadmins);
	foreach ($fbadmins as $adminId) {
		echo '<meta property="fb:admins"   content="'.$adminId.'" />';	
	}

	// TAG FOR HOME
	if (is_single()) {
		if ($ogdebugfilter) {
			$ogtitle = wp_title('',false);
		} else {
			$ogtitle = wp_title('|',false,'right')." ".$ognomedoblog;
		}
		$ogdescription = get_the_excerpt(); 
		$ogurl = get_permalink(); 
		if (has_post_thumbnail()) { 
			$ogimage = get_post_thumbnail_id();
			$ogimage = wp_get_attachment_image_src($ogimage,'full',true);
			$ogimage = $ogimage[0];
		} else {
			$ogimage = $ogimagedefault; 
		}
		$articleauthor = get_the_author();
		$articlesection = get_the_category(); 
		$articlesection = $articlesection[0]->cat_name;
		$tags = wp_get_post_tags(get_the_ID());
		foreach ( $tags as $tag ) {
			$articletag = $tag->name;
			echo '<meta property="article:tag" content="'.$articletag.'" />'; 
		}
		
		echo '<meta property="og:title" content="'.$ogtitle.'" />';
		echo '<meta property="og:description" content="'.$ogdescription.'" />';
		echo '<meta property="og:url" content="'.$ogurl.'" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:image" content="'.$ogimage.'" />';
		echo '<meta property="article:section" content="'.$articlesection.'" />';
		echo '<meta property="article:publisher" content="'.$articlepublisher.'" />';
	} else {

		if ($ogdebugfilter) {
			$ogtitle = wp_title('',false);
		} else {
			$ogtitle = wp_title('|',false,'right')." ".$ognomedoblog;
		}
		
		$ogurl = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		echo '<meta property="og:title"  content="'.$ogtitle.'" />';
		echo '<meta property="og:description"  content="'.$ogdescricaodoblog.'" /> ';
		echo '<meta property="og:url"    content="'.$ogurl.'" />';
		echo '<meta property="og:type"   content="website" /> ';
		echo '<meta property="og:image"  content="'.$ogimagedefault.'" />';
	}
}

?>