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
        <?php require_once ("site_mod_topo.php");?>
    </header>		 
    <div class="top-page"></div>

  
  <div class="blog wrapper">

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