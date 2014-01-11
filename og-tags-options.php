<?php
// EVITANDO ACESSO DIRETO
if (!function_exists('ogtags_administration')) {
  echo '<h1>You Shall Not Pass!</h1>';
  die;
}

// RECEBENDO OS DADOS APÓS SALVAR
  if (isset($_POST["ogtags_update_fbdmins"])) {
    $ogtags_update_fbdmins = $_POST["ogtags_update_fbdmins"]; 
  }
  if (isset($_POST["ogtags_update_publisher"])) {
    $ogtags_update_publisher = $_POST["ogtags_update_publisher"]; 
  }
  if (isset($_POST["ogtags_update_image_default"])) {
    $ogtags_update_image_default = $_POST["ogtags_update_image_default"]; 
  }
  if (isset($_POST["ogtags_update_ognomedoblog"])) {
    $ogtags_update_ognomedoblog = $_POST["ogtags_update_ognomedoblog"]; 
  }
  if (isset($_POST["ogtags_update_ogdescricaodoblog"])) {
    $ogtags_update_ogdescricaodoblog = $_POST["ogtags_update_ogdescricaodoblog"]; 
  }
  if (isset($_POST["ogtags_update_ogdebugfilter"])) {
    $ogtags_update_ogdebugfilter = $_POST["ogtags_update_ogdebugfilter"]; 
  }

// ADD TO WP_OPTIONS
  if (isset($_POST["ogtags_form"])) {
    
    $ogtags_options = array('ogtags_fbadmins' => $ogtags_update_fbdmins, 
      'ogtags_publisher' => $ogtags_update_publisher ,
      'ogtags_image_default' => $ogtags_update_image_default ,
      'ogtags_nomedoblog' => $ogtags_update_ognomedoblog ,
      'ogtags_descricaodoblog' => $ogtags_update_ogdescricaodoblog ,
      'ogtags_debug_filter' => $ogtags_update_ogdebugfilter );

    update_option( 'ogtags_options', $ogtags_options );
  }

  $ogtags_options = get_option( 'ogtags_options' );

?>

<div class="wrap ogtags">
  <aside class="ogtags-sidebar">
    <h2>Siga no Twitter!</h2>
    <a href="https://twitter.com/mariovalney" class="twitter-follow-button" data-show-count="false" data-lang="pt" data-size="large">Siga no Twitter!</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  <br>
  <h2>Conheça o Jangal!</h2>
    <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fjangal.com.br&amp;width&amp;height=395&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=715085735176268" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:395px;" allowTransparency="true"></iframe>
  </aside>

  <h2>OG TAGS - Área de Administração</h2>
  <br>
  <form action="" method="post">
    <h3> Dados do Site </h3>
    <label>Nome do site: </label><input required type="text" class="nome" name="ogtags_update_ognomedoblog" value="<?php echo $ogtags_options['ogtags_nomedoblog']; ?>"/><br>
    <label>Descrição do site: </label><input required type="text" class="descricao" name="ogtags_update_ogdescricaodoblog" value="<?php echo $ogtags_options['ogtags_descricaodoblog']; ?>"/><br>
    <br>
    <h3> Imagem Padrão </h3>
    <label>URL da imagem <br> (deve ter pelo menos 200x200): </label>
      <input required id="upload_image_url" class="imagem" type="text" name="ogtags_update_image_default" value="<?php echo $ogtags_options['ogtags_image_default']; ?>"/>
      <input id="upload_image_button" class="button" type="button" value="Upload Image" />
    <br>
    <h3> Dados dos Autores </h3>
    <label>Link da Página no Facebook: </label><input required class="pagina" type="text" name="ogtags_update_publisher" value="<?php echo $ogtags_options['ogtags_publisher']; ?>"/><br>
    <label>ID dos Administradores (separados com um espaço): </label><input required class="admins" type="text" name="ogtags_update_fbdmins" value="<?php echo $ogtags_options['ogtags_fbadmins']; ?>"/>
    <br><br>
    <h4> Compatibilidade </h4>
    <label>Desativar título personalizado: </label> <input type="checkbox" name="ogtags_update_ogdebugfilter" <?php if ($ogtags_options['ogtags_debug_filter']) {echo 'value="true" checked';} else {echo 'value="false"';} ?> > <span class="ogtags-descricao"> Padrão: desmarcado. </span>

    <br><br>
    <input type="hidden" name="ogtags_form" value="yes">
    <input id="send" class="button button-primary" type="submit" value="Salvar Alterações">
  </form>
  <br><br><br>
  <h2> Documentação </h2>
  <p><strong>OG Tags</strong> é um plugin voltado para otimizar o seu site no Facebook!</p>
  <h3> Configurações </h3>
  <p> O plugin reconhece o <strong>nome</strong> e <strong>descrição</strong> do seu site, que você já configurou, quando estava instalando o Wordpress! Mas, se por algum motivo ou estratégia de divulgação, você quiser alterar esse conteúdo, o plugin deixa livre para você escolher um <strong>nome</strong> e uma <strong>descrição</strong> próprios para serem incluidos nas OG Tags e consequentemente serem vistos no Facebook.
    <br>Para isso, basta preencher os campos acima, na seção <strong>"Dados do Site"</strong>.</p>
  <p> Na seção <strong>Imagem Padrão</strong>, você pode incluir a URL de uma imagem a ser usada tanto para a Home do seu site, quanto nos casos em que o artigo não tem uma Imagem Destacada.</p>
  <p> A Open Graph também permite relacionarmos os artigos à uma <strong>página do Facebook</strong> e é o link dessa página que devemos inserir na seção <strong>"Dados dos Autores"</strong>, além do <strong>ID do perfil dos administradores</strong> do blog, para que seja possível a moderação e administração dos plugins sociais do Facebook, caso você use algum, por exemplo o <a href="https://developers.facebook.com/docs/plugins/comments/" target="_blank">sistema de comentários</a>.
    <br> Você deve separá-los por um espaço e a forma mais fácil de achar seu ID é digitando <strong>"http://graph.facebook.com/SEU-NOME-DE-USUÁRIO"</strong>. Por exemplo: o ID do <a href="https://www.facebook.com/zuck" target="_blank">Mark Zuckerberg</a> é <a href="http://graph.facebook.com/zuck" target="_blank">4</a>.</p>
  <h3> Utilidade </h3>
  <p>Uma página com essas tags bem estruturadas, gera uma história interessante a cada vez que é curtida/publicada. É como se cada um que curtisse divulgasse tão bem quanto o próprio autor, que escolhe uma imagem chamativa, bem como uma descrição e título atraentes e que têm a ver com a página em si.</p>
  <h3> Compatibilidade </h3>
  <p><strong>Desativar título personalizado:</strong> Alguns temas ou plugins podem alterar a forma que o WordPress lê o título de suas páginas. Você deve marcar essa opção caso isso gere algum problema na forma como o Facebook lê o título das suas páginas. O padrão é desmarcado.</p>
  <br>
  <p>Para saber mais sobre a API Open Graph <a href="http://jangal.com.br/dev/facebook/integracao-com-o-facebook-open-graph/" target="_bank">visite nosso site</a>!</p>
  <p>Dúvidas? Sugestões? Envie um e-mail para <strong>mariovalney@gmail.com</strong> ou faça um <a href="https://github.com/mariovalney/og-tags" target="_blank">Fork no GitHub</a>!</p>
</div>