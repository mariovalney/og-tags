jQuery(document).ready(function($){
    var custom_uploader;
 
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        // SE A TELA DE UPLOAD JÁ ABRIU, ABRE DE NOVO
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        // ALTERANDO AS OPÇÕES DO OBJETO WP.MEDIA
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Escolha a Imagem',
            button: {
                text: 'Escolher Imagem'
            },
            multiple: false
        });
 
        // QUANDO UM ARQUIVO FOR SELECIONADO, PEGA A URL E SETA NO CAMPO URL
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image_url').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
});