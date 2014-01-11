#OG Tags

**OG Tags** inclui as tags necessárias para integrar seu site ao Facebook com o mínimo de configurações.

> *OG Tags includes the tags necessary to integrate your website to Facebook with almost no configuration.*

## Descrição

O que "OG Tags" faz:

* Inclui o tipo de objeto Open Graph ("website" para a página inicial e "article" para os posts e artigos).
* Inclui as tag com propriedades nas página e acordo com a documentação da Open Graph API.
* Inclui seu ID como administrador dos Plugins Sociais como o de Comentários.
* Inclui sua Página no Facebook como "publisher" do site no Open Graph.
* Inclui uma imagem padrão para a Home e para os artigos sem Imagem Destacada.
* Usa a Imagem Destacada do post como og:image (ou seja, ela irá aparecer no Feed do Facebook).
* Uma página com poucas configurações. Queremos que seja tudo simples! Automático.

Idioma:

A Open Graph API não faz diferença quanto idiomas, mas a Documentação e a Página de Opções estão em português brasileiro.


> Features of "OG Tags":
>
> * Include type of object to Open Graph API ("website" for home and "article" for posts).
> * Include the tags with properties in the page according with Open Graph API documentation.
> * Include your ID as administrator for Social Plugins like Comments.
> * Include your Page as publisher for Open Graph's object.
> * Include a default image to Home and posts without Featured Image.
> * Use Featured Image how og:image (i.e. it will appear on Facebook' Feed).
> * Simple page with less configurations. We want to be simple! Automatic.
> 
> Language:
> 
> Open Graph does not make difference about languages, but the Documentation and the Options Page are in Brazilian Portuguese.


## Instalação

Após o download do arquivo ZIP:
 1. Faça o login no seu site e navegue até o menu "Plugins".
 2. Clique em "Adicionar Novo".
 3. Escolha a opção "Enviar".
 4. Clique em **Escolher Arquivo** e selecione o arquivo zip OG Tags.
 5. Clique em **Instalar Agora**.
 6. Feito isso, ative o plugin.

O plugin irá guardar sus configurações no Banco de Dados. 
Não se preocupe, isso será automático na ativação do plugin e quando você desativá-lo (esperamos que não faça isso) essas opções serão apagadas.

> After downloading the ZIP file: 
>  1.  Login to your WordPress site administrator panel and head over the 'Plugins' menu  
>  2.  Click 'Add New'.
>  3  Choose the 'Upload' option.
>  4. Click **Choose file** and select the OG Tags zip file.  
>  5.  Click **Install Now** button.  
>  6.  Once it is complete, activate the plugin.

## Configurações

O plugin reconhece o nome e descrição do seu site, que você já configurou, quando estava instalando o Wordpress! Mas, se por algum motivo ou estratégia de divulgação, você quiser alterar esse conteúdo, o plugin deixa livre para você escolher um nome e uma descrição próprios para serem incluidos nas OG Tags e consequentemente serem vistos no Facebook. 
Para isso, basta preencher os campos acima, na seção "Dados do Site".

Na seção Imagem Padrão, você pode incluir a URL de uma imagem a ser usada tanto para a Home do seu site, quanto nos casos em que o artigo não tem uma Imagem Destacada.

A Open Graph também permite relacionarmos os artigos à uma página do Facebook e é o link dessa página que devemos inserir na seção "Dados dos Autores", além do ID do perfil dos administradores do blog, para que seja possível a moderação e administração dos plugins sociais do Facebook, caso você use algum, por exemplo o sistema de comentários. 
Você deve separá-los por um espaço e a forma mais fácil de achar seu ID é digitando "http://graph.facebook.com/SEU-NOME-DE-USUÁRIO". Por exemplo: o ID do Mark Zuckerberg é 4.

## Changelog

#### 1.0

* Inclui o tipo de objeto Open Graph ("website" para a página inicial e "article" para os posts e artigos).
* Inclui as tag com propriedades nas página e acordo com a documentação da Open Graph API.
* Inclui seu ID como administrador dos Plugins Sociais como o de Comentários.
* Inclui sua Página no Facebook como "publisher" do site no Open Graph.
* Inclui uma imagem padrão para a Home e para os artigos sem Imagem Destacada.
* Usa a Imagem Destacada do post como og:image (ou seja, ela irá aparecer no Feed do Facebook).
* Uma página com poucas configurações. Queremos que seja tudo simples! Automático.

#### 1.1

* Criado o readme.txt
* Inserido no reposítório oficial Wordpress
* Retiramos o arquivo og-admin.php que processava a área de administração e incluímos seu conteúd no arquivo principal og-tags.php

#### 1.0

* Inclui o tipo de objeto Open Graph ("website" para a página inicial e "article" para os posts e artigos).
* Inclui as tag com propriedades nas página e acordo com a documentação da Open Graph API.
* Inclui seu ID como administrador dos Plugins Sociais como o de Comentários.
* Inclui sua Página no Facebook como "publisher" do site no Open Graph.
* Inclui uma imagem padrão para a Home e para os artigos sem Imagem Destacada.
* Usa a Imagem Destacada do post como og:image (ou seja, ela irá aparecer no Feed do Facebook).
* Uma página com poucas configurações. Queremos que seja tudo simples! Automático.

#### 1.1

* Criado o readme.txt
* Inserido no reposítório oficial Wordpress
* Retiramos o arquivo og-admin.php que processava a área de administração e incluímos seu conteúdo no arquivo principal og-tags.php

#### 1.1.2

* Otimizada a consulta ao banco de dados das opções do plugin.

#### 1.1.3

* Otimizados os arquivos do plugin.
* Melhorada a segurança.
* Integração com o upload do Wordpress para a imagem padrão.

#### 1.1.4

* Integração com o upload do Wordpress para a imagem padrão.
* (FIX) Bug na apresentação do título em sites com plugins e temas que alteram o wp_title.* Criada uma opção de compatibilidade com plugins e temas que utilizam filtros no wp_title.

### Prévia:

#### 1.2

* Previsão da apresentação do conteúdo na página de edição do post.

#### 1.3

* Edição do título, descrição e foto para páginas estáticas individualmente.

Sugestões e pedidos? Use o fórum -> http://wordpress.org/support/plugin/og-tags

## Credits

Contributors: @mariovalney
URL: http://projetos.jangal.com.br/ogtags
Tags: open graph, facebook, social, tags, Social Plugins
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
