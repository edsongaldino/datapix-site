<?php include "site_mod_include.php";?>
<?php
//Abre a conexão
$pdo = Database::conexao();

//consulta noticias
$sql_consulta_noticias = "SELECT id_noticia, titulo_noticia, resumo_noticia, data_noticia, arquivo FROM noticia WHERE status = 'L' ORDER BY RAND() LIMIT 4";
$resultado_noticias = $pdo->query( $sql_consulta_noticias );
$noticias = $resultado_noticias->fetchAll( PDO::FETCH_ASSOC );
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once ("site_mod_head.php");?>
    </head>
    <body class="home">
        
    <header>
        <div class="container">

        <div class="brand hidden-xs">
        <a href="index.php">
            <h1 class="hidden">Datapix</h1>
            <img src="img/brand.png" title="Datapix"  alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Datapix" class="animated fadeIn" />
            <img src="img/brand-arrow-red.png" title="Datapix" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Datapix" class="arrow-red animated fadeInLeft"/>
            <img src="img/brand-arrow-white.png" title="Datapix" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Datapix"  class="arrow-white animated fadeInRight"/>
        </a>
        </div>

        <div class="navbar" role="navigation">

        <!-- Show Mobile -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu">
            <span class="sr-only">Navega&ccedil;&atilde;o</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand visible-xs animated fadeInUp">
            <img src="img/brand-mobile.gif" title="Datapix" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Datapix" />
            </a>
        </div> 

        <div class="phone-group phone-group-mobile hidden-xs"><span class="glyphicon glyphicon-earphone"></span> (65) 99603-0422</div>
        <div class="phone-group phone-group-mobile visible-xs"><span class="glyphicon glyphicon-earphone"></span> <a href="tel:+556539275480">+55 (65) 3927 5480</a><br/><a href="tel:+5565996030422">+55 (65) 99603 0422</a></div>

        <div class="navbar-menu navbar-collapse collapse">
            <ul class="nav navbar-nav animated fadeIn">
            <li><a href="empresa.php">A Datapix</a></li>
            <li><a href="javascript:void(0);" onclick="$('.service-group').ScrollTo({offsetTop:'0'}); if(window.innerWidth < 768) $('.navbar-menu').collapse('hide');">Solu&ccedil;&otilde;es</a></li>
            <li><a href="portfolio.php">Portf&oacute;lio</a></li>
            <li><a href="javascript:void(0);" onclick="$('.blog-group').ScrollTo({offsetTop:'0'}); if(window.innerWidth < 768) $('.navbar-menu').collapse('hide');">Blog</a></li>
            <li><a href="contato.php">Contato</a></li>
            <li class="phone-group hidden-xs hidden-sm"><a href="javascript:void(0);" onclick="$('.contact').ScrollTo({offsetTop:'0'}); if(window.innerWidth < 768) $('.navbar-menu').collapse('hide');"><span class="glyphicon glyphicon-earphone"></span> +55 (65) 3927 5480<br/>+55 (65) 99603 0422</a></li>
            <li class="socialmedia hidden-xs hidden-sm">
                <a href="https://www.facebook.com/datapix/"><img src="img/ico-fb.gif" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logo Facebook"></a>
            </li>
            <li class="client-area-button hidden-xs hidden-sm"><a data-target="#call-me" data-toggle="modal" href="javascript:;" onclick="$('#interesse').val($(this).html())" class="btn btn-border"><span class="glyphicon glyphicon-envelope"></span> Quero mais visibilidade</a></li>
            <li class="visible-xs visible-sm"><a data-target="#call-me" data-toggle="modal" href="javascript:;" onclick="$('#interesse').val($(this).html())"><span class="glyphicon glyphicon-envelope"></span> Quero mais visibilidade</a></li>
            </ul>
        </div>

        </div>

    </div>
    </header>	
    <div id="slideshow" class="carousel-slideshow carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                  <div class="item active">
          <img src="uploads/banners/0000021_regular_slide-home.jpg" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Banner" class="img-slide hidden-xs"/>
          <img src="uploads/banners/0000021_small_slide-home.jpg" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Banner" class="img-slide visible-xs"/>

            <div class="caption container">
              <div class="caption-inner">
<div class="caption-title animated fadeInDown">Sites feitos sob medida<br />
para aumentar suas vendas</div>

<div class="caption-summary container animated fadeInUp">
<div class="row">
<div class="col-xs-3 text-center"><img src="img/ico-slide-custom.gif" /><br />
<span>Layout Personalizado</span></div>

<div class="col-xs-3 text-center"><img src="img/ico-slide-responsive.gif" /><br />
<span>Design Responsivo</span></div>

<div class="col-xs-3 text-center"><img src="img/ico-slide-crm.gif" /><br />
<span>Gerenciamento de Conte&uacute;do</span></div>

<div class="col-xs-3 text-center"><img src="img/ico-slide-seo.gif" /><br />
<span>Otimizado para o Google</span></div>
</div>
</div>
<a class="btn btn-lg btn-border btn-border-inverter animated fadeInUp" data-target="#call-me" data-toggle="modal" href="javascript:;" onclick="$('#interesse').val($(this).html())">Quero um website para aumentar meu faturamento</a></div>
            </div>      

          </div>
                  </div>
        <div class="caret-down-page text-center"><a  href="javascript:void(0);" onclick="$('.service-group').ScrollTo({offsetTop:'0'});"><span class="glyphicon glyphicon-chevron-down"></span></a></div>
    </div>

    

<div class="service-group wrapper text-center">
<div class="container">
<h2>Solu&ccedil;&otilde;es para alavancar o seu neg&oacute;cio</h2>

<div class="row">
<div class="col-sm-4">
<div class="service-group-item">
<div class="service-image"><a  href="/criacao-de-sites"><img src="img/ico-service-websites.gif" /></a></div>

<div class="service-title"><a  href="/criacao-de-sites">Cria&ccedil;&atilde;o de Sites</a></div>

<div class="service-summary">Para neg&oacute;cios que querem expandir sua visibilidade por meio da internet. Contamos com uma solu&ccedil;&atilde;o eficaz para desenvolvimento de Website.</div>
<a class="btn btn-border" href="/criacao-de-sites">Saiba mais</a></div>
</div>

<div class="col-sm-4">
<div class="service-group-item">
<div class="service-image"><a href="/criacao-de-sistemas-web"><img src="img/ico-service-sistemas.gif" /></a></div>

<div class="service-title"><a href="/criacao-de-sistemas-web">Sistemas Web</a></div>

<div class="service-summary">Sistemas web sob medida que facilitar&atilde;o os processos desde o cadastro de clientes ao controle financeiro da sua empresa.</div>
<a class="btn btn-border" href="/criacao-de-sistemas-web">Saiba mais</a></div>
</div>

<div class="col-sm-4">
<div class="service-group-item">
<div class="service-image"><img src="img/ico-service-ecommerces.gif" /></div>
<div class="service-title">Lojas Virtuais</div>



<div class="service-summary">Para quem quer mais oportunidades para aumentar as vendas do seu neg&oacute;cio local. Venda pela internet para qualquer lugar!</div>
<a class="btn btn-border" href="/criacao-de-lojas-virtuais">Saiba mais</a></div>
</div>



</div>
</div>
</div>

<div class="caret-down-page black text-center"><a href="javascript:void(0);" onclick="$('.case-group').ScrollTo({offsetTop:'0'});"><span class="glyphicon glyphicon-chevron-down"></span></a></div></div>    
    

<div class="blog-group wrapper">
    <div class="container">
        <h2 class="text-center">BLOG</h2>
        
        <?php foreach ($noticias AS $noticia):?>
        <div class="col-sm-3 blog-post">
            <div class="blog-imagem"><a href="artigo/<?php echo $noticia["id_noticia"];?>/<?php echo url_amigavel($noticia["titulo_noticia"]);?>"><img src="conteudos/noticia/<?php echo $noticia["arquivo"];?>" alt="" width="100%"></a></div>
            <h3><?php echo $noticia["titulo_noticia"];?></h3>
            <div class="data-post"><?php echo converte_data_portugues($noticia["data_noticia"]);?></div>
            <div class="blog-resumo"><?php echo $noticia["resumo_noticia"];?></div>
        </div>
        <?php endforeach;?>

    </div>
</div>
  

<div class="number-group wrapper text-center" style="display:none;">
<div class="container">
<h2>O que j&aacute; conquistamos</h2>

<div class="row">
<div class="col-sm-6 col-md-3">
<div class="number-value">+400</div>

<div class="number-title">Websites<br class="hidden-xs" />
desenvolvidos</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="number-value">+13</div>

<div class="number-title">Anos de experi&ecirc;ncia em desenvolvimento web</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="number-value">+380</div>

<div class="number-title">Clientes j&aacute; atendidos<br class="hidden-xs" />
em todo o Brasil</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="number-value">+180</div>

<div class="number-title">Projetos hospedados em nossos servidores</div>
</div>
</div>
</div>
</div>
    
    
    
    <div class="client-group wrapper text-center hidden-xs">
      <h2 class="text-center">Alguns de nossos clientes</h2>
      <div class="container">
      <div class="row">
              <div class="col-xs-4 col-sm-3 col-md-3"><a href="http://ortobelcolchoes.com.br" target="_blank"><img src="uploads/publicacoes/clientes/logo/ortobel.png" class="img-responsive" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Maroneze"></a></div>
              <div class="col-xs-4 col-sm-3 col-md-3"><a href="http://realmat.com.br" target="_blank"><img src="uploads/publicacoes/clientes/logo/realmat.png" class="img-responsive" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo AMM"></a></div>
              <div class="col-xs-4 col-sm-3 col-md-3"><a href="http://www.lapv.com.br/" target="_blank"><img src="uploads/publicacoes/clientes/logo/lapv.png" class="img-responsive" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Castelo branco"></a></div>
              <div class="col-xs-4 col-sm-3 col-md-3"><a href="http://solucaotoaletes.com.br/" target="_blank"><img src="uploads/publicacoes/clientes/logo/solucao.png" class="img-responsive" alt="Desenvolvimento e Cria&ccedil;&atilde;o de Sites e Sistemas Web, Logotipo Treide"></a></div>
      </div>
      </div>
      <a href="javascript:;" data-toggle="modal" data-target="#call-me" onclick="$('#interesse').val($(this).html())" class="btn btn-lg btn-border">Seja nosso cliente</a>
    </div>
    
    
	<a href="javascript:void(0);" class="btn-gotop hidden" onclick="$('header').ScrollTo({offsetTop:'0'});">
	  <span class="glyphicon glyphicon-chevron-up"></span>
	</a>
    



	  <div class="contact wrapper">
	    <?php require_once("site_mod_contato.php");?>
	  </div>


    <footer>
        <div class="container">
            <div class="footer-copyright text-center">&copy; <?php echo date('Y'); ?><span class="hidden-xs">.</span><br class="visible-xs"/> Todos os direitos reservados.</div>
        </div>
    </footer>

    
    <?php require_once("site_mod_footer.php");?>
        
    
</html>