
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once ("site_mod_head.php");?>
    </head>
    <body class="home">
        
    <header>
        <?php require_once ("site_mod_topo.php");?>
    </header>		 
    <div class="top-page"></div>

  
    <div class="case-group wrapper">
    <div class="container">
    <h2 class="text-center">Cases de Sucesso</h2>

    <div class="row">
    <div class="col-lg-4">
    <div class="case-group-item">

    <div class="case-title">Studio7</div>

    <div class="case-type">Website</div>

    <div class="case-summary">Um verdadeiro funil de vendas cheio de &quot;Call to Actions&quot;, focado em proporcionar muitas convers&otilde;es.</div>
    <a class="btn btn-border btn-border-inverter-transparent" href="/case-website-studio7">Saiba mais</a></div>
    </div>

    <div class="col-lg-4">
    <div class="case-group-item">

    <div class="case-title">UNESC</div>

    <div class="case-type">Sistema Web</div>

    <div class="case-summary">Funcionalidades customizadas para atender necessidades espec&iacute;ficas de uma das maiores Universidades do Esp&iacute;rito Santo.</div>
    <a class="btn btn-border btn-border-inverter-transparent" href="/case-sistema-web-unesc">Saiba mais</a></div>
    </div>

    <div class="col-lg-4">
    <div class="case-group-item">

    <div class="case-title">Casulos</div>

    <div class="case-type">E-Commerce</div>

    <div class="case-summary">A loja de Artigos Militares aumentou seu faturamento com essa ferramenta de venda completa que proporciona uma experi&ecirc;ncia de compra online super simples.</div>
    <a class="btn btn-border btn-border-inverter-transparent" href="/case-ecommerce-casulos">Saiba mais</a></div>
    </div>
    </div>

    <div class="case-footer">
    <div class="container text-center"><a class="btn btn-lg btn-border" data-target="#call-me" data-toggle="modal" href="javascript:;" onclick="$('#interesse').val($(this).html())">Seja voc&ecirc; tamb&eacute;m um case de sucesso</a></div>
    </div>
    </div>
    </div>

    
    

	<a href="javascript:void(0);" class="btn-gotop hidden" onclick="$('header').ScrollTo({offsetTop:'0'});">
	  <span class="glyphicon glyphicon-chevron-up"></span>
	</a>
    



	  <div class="contact wrapper">
	    <?php require_once("site_mod_contato.php");?>
	  </div>


    <footer>
        <div class="container">
            <div class="footer-copyright text-center">&copy; 2010-2017<span class="hidden-xs">.</span><br class="visible-xs"/> Todos os direitos reservados.</div>
        </div>
    </footer>

    
     <?php require_once("site_mod_footer.php");?>
        


</html>