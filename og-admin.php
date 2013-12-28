<?php
// DEFAULT OPTIONS
if (isset($_POST["ogtags_update_fbdmins"])) {
	$ogtags_update_fbdmins = $_POST["ogtags_update_fbdmins"]; 
}
if (isset($_POST["ogtags_update_publisher"])) {
	$ogtags_update_publisher = $_POST["ogtags_update_publisher"]; 
}
if (isset($_POST["ogtags_update_image_default"])) {
	$ogtags_update_image_default = $_POST["ogtags_update_image_default"]; 
}
if (isset($_POST["ogtags_ognomedoblog"])) {
	$ogtags_ognomedoblog = $_POST["ogtags_ognomedoblog"]; 
}
if (isset($_POST["ogtags_ogdescricaodoblog"])) {
	$ogtags_ogdescricaodoblog = $_POST["ogtags_ogdescricaodoblog"]; 
}

// ADD TO WP_OPTIONS
if (isset($_POST["ogtags_form"])) {
	update_option( 'ogtags_fbadmins', $ogtags_update_fbdmins );
	update_option( 'ogtags_publisher', $ogtags_update_publisher );
	update_option( 'ogtags_image_default', $ogtags_update_image_default );
	update_option( 'ogtags_nomedoblog', $ogtags_ognomedoblog );
	update_option( 'ogtags_descricaodoblog', $ogtags_ogdescricaodoblog );

	echo "<script>alert('Dados atualizados com sucesso.');</script>";
}
?>