<?php
/*
Plugin Name: OG Tags
Plugin URI: https://github.com/mariovalney/og-tags
Description: Um plugin para otimização das Open Graph Tags em sites Wordpress.
Version: 1.0
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

// INSTALL
register_activation_hook( __FILE__, 'ogtags_install' );

function ogtags_install() {
	// DEFAULT OPTIONS
	$ogtags_install_fbdmins = '';
	$ogtags_install_publisher = 'https://www.facebook.com/facebook';
	$ogtags_install_image_default = plugins_url( 'facebook.jpg', __FILE__ );
	$ognomedoblog = get_bloginfo('name');
	$ogdescricaodoblog = get_bloginfo('description');
	
	// ADD TO WP_OPTIONS
	add_option( 'ogtags_fbadmins', $ogtags_install_fbdmins );
	add_option( 'ogtags_publisher', $ogtags_install_publisher );
	add_option( 'ogtags_image_default', $ogtags_install_image_default );
	add_option( 'ogtags_nomedoblog', $ognomedoblog );
	add_option( 'ogtags_descricaodoblog', $ogdescricaodoblog );
}

// UNINSTALL
register_deactivation_hook( __FILE__, 'ogtags_uninstall' );

function ogtags_uninstall() {
	// EXCLUDE FROM WP_OPTIONS
	delete_option( 'ogtags_fbadmins' );
	delete_option( 'ogtags_publisher' );
	delete_option( 'ogtags_image_default' );
	delete_option( 'ogtags_nomedoblog' );
	delete_option( 'ogtags_descricaodoblog' );
}

// ADMINISTRATION
add_action( 'admin_menu', 'ogtags_administration' );
add_action( 'admin_head', 'ogtags_administration_style');
 
function ogtags_administration() {
	add_options_page( 'OG Tags', 'OG Tags', 'manage_options', 'og-tags-options', 'ogtags_administration_content' );
}

function ogtags_administration_style() {
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'og-tags.css', __FILE__ ).'" />';
}
function ogtags_administration_content() {
	include 'og-admin.php';
?>
<div class="wrap ogtags">
  <h2>OG TAG - Área de Administração</h2>
  <br>
  <form action="" method="post">
  	<h3> Dados do Site </h3>
    <label>Nome do site: </label><input type="text" class="nome" name="ogtags_ognomedoblog" value="<?php echo get_option( 'ogtags_nomedoblog' ); ?>"/><br>
	<label>Descrição do site: </label><input type="text" class="descricao" name="ogtags_ogdescricaodoblog" value="<?php echo get_option( 'ogtags_descricaodoblog' ); ?>"/><br>
    <br>
    <h3> Imagem Padrão </h3>
    <label>URL da imagem <br> (deve ter pelo menos 200x200): </label><input class="imagem" type="text" name="ogtags_update_image_default" value="<?php echo get_option( 'ogtags_image_default' ); ?>"/>
    <br>
    <h3> Dados dos Autores </h3>
    <label>Link da Página no Facebook: </label><input class="pagina" type="text" name="ogtags_update_publisher" value="<?php echo get_option( 'ogtags_publisher' ); ?>"/><br>
    <label>ID dos Administradores (separados com um espaço): </label><input class="admins" type="text" name="ogtags_update_fbdmins" value="<?php echo get_option( 'ogtags_fbadmins' ); ?>"/> <br><br>
  	<INPUT type="hidden" name="ogtags_form" value="yes">
  	<input id="send" class="button button-primary" type="submit" value="Salvar Alterações">
  </form>
</div>
<?php
}

// ADDING ACTION IN HOOK
add_action( 'wp_head', 'ogtags_insert_tags' );

// INSERT OG TAGS ON HEAD - FAZENDO A MÁGICA ACONTECER
function ogtags_insert_tags() {

	// RECEBENDO O VALOR DAS OPÇÕES
	$ognomedoblog = get_option( 'ogtags_nomedoblog' );
	$ogdescricaodoblog = get_option( 'ogtags_descricaodoblog' );
	$ogimagedefault = get_option( 'ogtags_image_default' );
	$fbadmins = get_option( 'ogtags_fbadmins' );
	$articlepublisher = get_option( 'ogtags_publisher' );
	// DEMAIS VARIÁVEIS
	$ogurldoblog = get_bloginfo('url');

	// TAGS FOR ENTIRE SITE
	echo '<meta property="og:site_name"   content="'.$ognomedoblog.'" />';

	$fbadmins = explode(" ",$fbadmins);
	foreach ($fbadmins as $adminId) {
		echo '<meta property="fb:admins"   content="'.$adminId.'" />';	
	}

	// TAG FOR HOME
	if (is_home()) {
		echo '<meta property="og:title"  content="'.$ognomedoblog.'" />';
		echo '<meta property="og:description"  content="'.$ogdescricaodoblog.'" /> ';
		echo '<meta property="og:url"    content="'.$ogurldoblog.'" />';
		echo '<meta property="og:type"   content="website" /> ';
		echo '<meta property="og:image"  content="'.$ogimagedefault.'" />';
	}

	if (is_single()) {
		$ogtitle = wp_title('|',false,'right').get_bloginfo('name');
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
	}
}

?>