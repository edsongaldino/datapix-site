<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Pega o id
$id_noticia = (int) base64_decode(addslashes(trim($_GET['id_noticia'])));
		
try{

  // REALIZA A ALTERAÇÃO
  $sql_exclui = "UPDATE noticia SET status = 'E' WHERE id_noticia = '".$id_noticia."'";
	$exclui = $pdo->prepare($sql_exclui);
	$exclui->execute();

    $excluir = true;
    
  }catch (PDOException $e){
    echo 'Error: '. $e->getMessage();
    $excluir = false;
  } 

// Verifica se deu erro
if($excluir) {
	// Log
	salvar_log($_SESSION["id_usuario"],"excluir noticia",$sql_exclui, $pdo);
		
	echo "<script>";
	echo "open('gerenciar_noticias.php?aviso=ok&msg=noticia excluída com sucesso.','_self');";
	echo "</script>";
} else {
	// Log
	salvar_log($_SESSION["id_usuario"],"erro",$sql_exclui, $pdo);
		
	echo "<script>";
	echo "open('gerenciar_noticias.php?aviso=erro&msg=Não foi possível exclui a noticia.','_self');";
	echo "</script>";
}
?>