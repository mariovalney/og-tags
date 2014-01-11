<?php

// EVITANDO ACESSO DIRETO
if (!function_exists('ogtags_uninstall')) {
	echo '<h1>You Shall Not Pass!</h1>';
	die;
}

// EXCLUDE FROM WP_OPTIONS
	delete_option( 'ogtags_options' );
?>