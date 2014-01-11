<?php
// EVITANDO ACESSO DIRETO
if (!function_exists('ogtags_install')) {
	echo '<h1>You Shall Not Pass!</h1>';
	die;
}

// DEFAULT OPTIONS
	$ogtags_install_fbdmins = '';
	$ogtags_install_publisher = 'https://www.facebook.com/facebook';
	$ogtags_install_image_default = plugins_url( 'facebook.jpg', __FILE__ );
	$ognomedoblog = get_bloginfo('name');
	$ogdescricaodoblog = get_bloginfo('description');
	$ogdebugfilter = 'false';

// ADD TO WP_OPTIONS
	$ogtags_options = array('ogtags_fbadmins' => $ogtags_install_fbdmins , 
		'ogtags_publisher' => $ogtags_install_publisher ,
		'ogtags_image_default' => $ogtags_install_image_default ,
		'ogtags_nomedoblog' => $ognomedoblog ,
		'ogtags_descricaodoblog' => $ogdescricaodoblog ,
		'ogtags_debug_filter' => $ogdebugfilter );

	add_option( 'ogtags_options', $ogtags_options );
?>