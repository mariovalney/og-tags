<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$ogtags_options = get_option( 'ogtags_options' );

// Recebendo os dados após salvar
if ( isset( $_POST['ogtags_saving'] ) ) {
    check_admin_referer( 'og-tags-dashboard' );

	$ogtags_update_fbdmins 			= ( isset( $_POST['ogtags_update_fbdmins'] ) ) 			? $_POST['ogtags_update_fbdmins'] 			: $ogtags_options['ogtags_fbadmins'];
	$ogtags_update_publisher 		= ( isset( $_POST['ogtags_update_publisher'] ) ) 		? $_POST['ogtags_update_publisher'] 		: $ogtags_options['ogtags_publisher'];
	$ogtags_update_image_default	= ( isset( $_POST['ogtags_update_image_default'] ) ) 	? $_POST['ogtags_update_image_default'] 	: $ogtags_options['ogtags_image_default'];
	$ogtags_update_sitename 		= ( isset( $_POST['ogtags_update_sitename'] ) ) 		? $_POST['ogtags_update_sitename'] 			: $ogtags_options['ogtags_nomedoblog'];
	$ogtags_update_sitedescriotion	= ( isset( $_POST['ogtags_update_sitedescription'] ) ) 	? $_POST['ogtags_update_sitedescription'] 	: $ogtags_options['ogtags_descricaodoblog'];
	$ogtags_update_debugfilter 		= ( isset( $_POST['ogtags_update_debugfilter'] ) ) 		? $_POST['ogtags_update_debugfilter'] 		: '0';

	$ogtags_options = array(
		'ogtags_fbadmins' 			=> sanitize_text_field( $ogtags_update_fbdmins ),
		'ogtags_publisher' 			=> sanitize_text_field( $ogtags_update_publisher ),
		'ogtags_image_default' 		=> sanitize_text_field( $ogtags_update_image_default ),
		'ogtags_nomedoblog' 		=> sanitize_text_field( $ogtags_update_sitename ),
		'ogtags_descricaodoblog' 	=> sanitize_text_field( $ogtags_update_sitedescriotion ),
		'ogtags_debug_filter' 		=> sanitize_text_field( $ogtags_update_debugfilter ),
	);

	update_option( 'ogtags_options', $ogtags_options );
} ?>

<div class="wrap ogtags">
	<div class="row">
		<div class="ogtags-content">

			<h2>OG TAGS - <?php _e( 'Área de Administração', OG_TAGS_TEXTDOMAIN ) ?></h2>

			<form id="ogtagssettings" action="" method="POST">
                <?php wp_nonce_field( 'og-tags-dashboard' ); ?>
				<h3>
					<?php _e( 'Dados do Site', OG_TAGS_TEXTDOMAIN ) ?>
				</h3>
				<div class="row">
					<div class="input-row">
						<label>
							<?php _e( 'Nome do site:', OG_TAGS_TEXTDOMAIN ) ?>
						</label>
						<input required type="text" class="nome" name="ogtags_update_sitename" value="<?php echo $ogtags_options['ogtags_nomedoblog']; ?>" form="ogtagssettings">
					</div>
				
					<div class="input-row">
						<label>
							<?php _e( 'Descrição do site:', OG_TAGS_TEXTDOMAIN ) ?>
						</label>
						<input required type="text" class="descricao" name="ogtags_update_sitedescription" value="<?php echo $ogtags_options['ogtags_descricaodoblog']; ?>" form="ogtagssettings">
					</div>
				</div>

				<h3>
					<?php _e( 'Imagem Padrão', OG_TAGS_TEXTDOMAIN ) ?>
				</h3>
				<div class="row">
					<label><?php _e( 'URL da imagem', OG_TAGS_TEXTDOMAIN ) ?><br><?php _e( '(recomenda-se 1200 x 630)', OG_TAGS_TEXTDOMAIN ) ?>:</label>
					<input required id="upload_image_url" class="imagem" type="text" name="ogtags_update_image_default" value="<?php echo $ogtags_options['ogtags_image_default']; ?>" form="ogtagssettings">
					<input id="ogtags-upload-btn" class="button" type="button" value="<?php _e( 'Escolha a Imagem', OG_TAGS_TEXTDOMAIN ) ?>"  form="ogtagssettings">
				</div>

				<h3>
					<?php _e( 'Dados dos Autores', OG_TAGS_TEXTDOMAIN ) ?>
				</h3>
				<div class="row">
					<label><?php _e( 'Link da Página no Facebook', OG_TAGS_TEXTDOMAIN ) ?>: </label>
					<input class="pagina" type="text" name="ogtags_update_publisher" value="<?php echo $ogtags_options['ogtags_publisher']; ?>" form="ogtagssettings">
					<label><?php _e( 'ID dos Administradores', OG_TAGS_TEXTDOMAIN ) ?><br><?php _e( '(separados com um espaço)', OG_TAGS_TEXTDOMAIN ) ?>: </label>
					<input class="admins" type="text" name="ogtags_update_fbdmins" value="<?php echo $ogtags_options['ogtags_fbadmins']; ?>" form="ogtagssettings">
				</div>
				
				<h3><?php _e( 'Compatibilidade', OG_TAGS_TEXTDOMAIN ) ?></h3>
				<div class="row">
					<label><?php _e( 'Desativar título personalizado', OG_TAGS_TEXTDOMAIN ) ?>: </label>
					<input type="checkbox" name="ogtags_update_debugfilter" value="1" <?php checked( '1', $ogtags_options['ogtags_debug_filter'] ); ?> > <span class="ogtags-descricao"><?php _e( 'Padrão: desmarcado' ) ?>.</span>
				</div>
				
				<div class="row">
					<input id="ogtags_saving" class="button button-primary" name="ogtags_saving" type="submit" value="<?php _e( 'Salvar Alterações', OG_TAGS_TEXTDOMAIN ) ?>">
				</div>			
			</form>
		</div>
			
		<aside class="ogtags-sidebar">
			<div class="row">
				<h2><?php _e( 'Siga no Twitter!', OG_TAGS_TEXTDOMAIN ); ?></h2>
				<a href="https://twitter.com/mariovalney" class="twitter-follow-button" data-show-count="false" data-lang="pt" data-size="large">Siga no Twitter!</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
			<hr style="margin: 20px 0">
			<?php
				$cf7_slug = "contact-form-7/wp-contact-form-7.php";
				$chete_slug = "cf7-html-email-template-extension/cf7-html-email-template-extension.php";
                $cftz_slug = "cf7-to-zapier/cf7-to-zapier.php";

				if ( file_exists( WP_PLUGIN_DIR . "/" . $cf7_slug ) && is_plugin_active( $cf7_slug ) ) {
					echo "<h2>" . __( 'Usando o Contact Form 7?', OG_TAGS_TEXTDOMAIN ) . "</h2>";
					if ( ! file_exists( WP_PLUGIN_DIR . "/" . $chete_slug ) ) {
                        echo '<p>' . __( "Recomentamos instalar o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><a href="https://wordpress.org/plugins/cf7-html-email-template-extension/" target="_blank">CF7 - HTML Email Template Extension</a><br>' . __( "e deixar seus e-mails mais profissionais?", OG_TAGS_TEXTDOMAIN ) . '</p>';
                    } else if ( ! is_plugin_active( $chete_slug ) ) {
                        echo '<p>' . __( "O que acha de ativar o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><a href="' . admin_url( "plugins.php#the-list" ) . '" target="_blank">CF7 - HTML Email Template Extension</a><br>' . __( "e deixar seus e-mails mais profissionais?", OG_TAGS_TEXTDOMAIN ) . '</p>';
                    } else {
                        echo '<p>' . __( "Obrigado por usar também o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><strong>CF7 - HTML Email Template Extension</strong></p>';
                    }

                    echo '<hr style="margin: 20px 40%">';

                    if ( ! file_exists( WP_PLUGIN_DIR . "/" . $cftz_slug ) ) {
                        echo '<p>' . __( "Recomentamos instalar o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><a href="https://wordpress.org/plugins/cf7-to-zapier/" target="_blank">CF7 to Webhook</a><br>' . __( "para integrar com qualquer sistema via webhooks?", OG_TAGS_TEXTDOMAIN ) . '</p>';
                    } else if ( ! is_plugin_active( $cftz_slug ) ) {
                        echo '<p>' . __( "O que acha de ativar o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><a href="' . admin_url( "plugins.php#the-list" ) . '" target="_blank">CF7 to Webhook</a><br>' . __( "para integrar com qualquer sistema via webhooks?", OG_TAGS_TEXTDOMAIN ) . '</p>';
                    } else {
                        echo '<p>' . __( "Obrigado por usar também o plugin", OG_TAGS_TEXTDOMAIN ) . '<br><strong>CF7 to Webhook</strong></p>';
                    }
				}
			?>
		</aside>
	</div>
	
	<div class="row">
		<h2><?php _e( 'Documentação', OG_TAGS_TEXTDOMAIN ) ?></h2>
		<p><strong>OG Tags</strong> <?php _e( 'é um plugin voltado para otimizar o seu site no Facebook!', OG_TAGS_TEXTDOMAIN ) ?></p>
		
		<div class="row">
			<h3><?php _e( 'Configurações', OG_TAGS_TEXTDOMAIN ) ?></h3>
			<p><?php _e( 'O plugin reconhece o', OG_TAGS_TEXTDOMAIN ) ?> <strong><?php _e( 'nome e descrição', OG_TAGS_TEXTDOMAIN ) ?></strong> <?php _e( 'do seu site, que você já configurou, quando estava instalando o WordPress!', OG_TAGS_TEXTDOMAIN ) ?></p>
			<p><?php _e( 'Mas, se por algum motivo ou estratégia de divulgação, você quiser alterar esse conteúdo, o plugin deixa livre para você escolher um', OG_TAGS_TEXTDOMAIN ) ?> <strong><?php _e( 'nome e descrição', OG_TAGS_TEXTDOMAIN ) ?></strong> <?php _e( 'próprios para serem incluidos nas OG Tags e consequentemente serem vistos no Facebook.', OG_TAGS_TEXTDOMAIN ) ?></p>
			<p><?php _e( 'Para isso, basta preencher os campos acima, na seção "Dados do Site".', OG_TAGS_TEXTDOMAIN ) ?></p>
			<p><?php _e( 'Na seção Imagem Padrão, você pode incluir a URL de uma imagem a ser usada tanto para a Home do seu site, quanto nos casos em que o artigo não tem uma Imagem Destacada.', OG_TAGS_TEXTDOMAIN ) ?></p>
			<p><?php _e( 'A Open Graph também permite relacionarmos os artigos à uma página do Facebook e é o link dessa página que devemos inserir na seção "Dados dos Autores", além do', OG_TAGS_TEXTDOMAIN ) ?> <strong><?php _e( 'ID do perfil dos administradores', OG_TAGS_TEXTDOMAIN ) ?></strong> <?php _e( 'do blog, para que seja possível a moderação e administração dos plugins sociais do Facebook, caso você use algum, por exemplo o', OG_TAGS_TEXTDOMAIN ) ?> <a href="https://developers.facebook.com/docs/plugins/comments/" target="_blank"><?php _e( 'sistema de comentários', OG_TAGS_TEXTDOMAIN ) ?></a>.</p>
		</div>

		<div class="row">
			<h3><?php _e( 'Utilidade', OG_TAGS_TEXTDOMAIN ) ?></h3>
			<p><?php _e( 'Uma página com essas tags bem estruturadas, gera uma história interessante a cada vez que é curtida/publicada. É como se cada um que curtisse divulgasse tão bem quanto o próprio autor, que escolhe uma imagem chamativa, bem como uma descrição e título atraentes e que têm a ver com a página em si.', OG_TAGS_TEXTDOMAIN ) ?></p>
		</div>

		<div class="row">
			<h3><?php _e( 'Compatibilidade', OG_TAGS_TEXTDOMAIN ) ?></h3>
			<p><strong><?php _e( 'Desativar título personalizado', OG_TAGS_TEXTDOMAIN ) ?>:</strong> <?php _e( 'Alguns temas ou plugins podem alterar a forma que o WordPress lê o título de suas páginas. Você deve marcar essa opção caso isso gere algum problema na forma como o Facebook lê o título das suas páginas. O padrão é desmarcado.', OG_TAGS_TEXTDOMAIN ) ?></p>
		</div>
		
		<div class="row">
			<p><?php _e( 'Para saber mais sobre a API Open Graph', OG_TAGS_TEXTDOMAIN ) ?> <a href="https://mariovalney.com/integracao-com-o-facebook-open-graph/" target="_bank"><?php _e( 'visite nosso site', OG_TAGS_TEXTDOMAIN ) ?></a>!</p>
			<p><?php _e( 'Dúvidas? Sugestões? Envie um e-mail para', OG_TAGS_TEXTDOMAIN ) ?> <strong>mariovalney@gmail.com</strong> <?php _e( 'ou faça um', OG_TAGS_TEXTDOMAIN ) ?> <a href="https://github.com/mariovalney/og-tags" target="_blank"><?php _e( 'Fork no GitHub', OG_TAGS_TEXTDOMAIN ) ?></a>!</p>
		</div>
	</div>
</div>
