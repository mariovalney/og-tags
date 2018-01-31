jQuery(document).ready(function($){

    var custom_uploader;

    $('#ogtags-upload-btn').click(function(event) {

        event.preventDefault();

        // Se a tela de upload já abriu, abre de novo
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        // Alterando as opções do objeto wp.media
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: OGTAGS.choose_image,
            button: {
                text: OGTAGS.choose_image
            },
            multiple: false
        });
 
        // Quando um arquivo for selecionado, pega a url e seta no campo url
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image_url').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

});