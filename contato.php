<?php
include("site_mod_include.php");
$status_envio = protege($_GET["envio"]); // id_empreendimento
?>
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

  
  <div class="contact-form wrapper">

    <div class="container">

      <?php if($status_envio == "erro"){?>
      <div class="mensagem alert-danger">
          <strong>Ops!</strong> Algo deu errado com sua solicitação. Pedimos desculpas! Tente novamente mais tarde.
      </div>
      <?php }?>

      <?php if($status_envio == "sucesso"){?>
      <div class="mensagem alert-success">
          <strong>OK!</strong> Sua solicitação foi enviada. <br/>Aguarde nosso contato em até 48h.
      </div>
      <?php }?>

      <h2 class="text-center">Formulário de Contato</h2>

      <p class="text-center">Se você quiser mandar e-mail pelo formulário abaixo, pode ter certeza que iremos responder o mais breve possível!</p>

      <form role="form" method="post" autocomplete="off" action="envia-contato.php">
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
              <label>Seu nome</label>
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="nome" class="form-control required" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
              <label>Seu e-mail</label>
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
              <input type="text" name="email" class="form-control required ckEmail" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
              <label>Seu telefone</label>
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-earphone"></span></span>
              <input type="text" name="telefone" class="form-control phone" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
              <label>Assunto</label>
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-map-marker"></span></span>
              <input type="text" name="assunto" class="form-control required" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-sm-8">
            <div class="input-group">
              <label>Mensagem</label>
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
              <textarea name="mensagem" class="form-control required" rows="10" resize="false"></textarea>
            </div>
            <input name="acao" type="hidden" class="form-control phone verify" value="envia-form-contato" />
            <button type="submit" class="btn btn-border btn-lg pull-right">Enviar e-mail</button>
          </div>
        </div>
      </form>

     
     

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