<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Pega o id
$id_equipe = (int) base64_decode(addslashes(trim($_GET['id_equipe'])));
		
try{

    // REALIZA A ALTERAÇÃO
    $sql_exclui = "UPDATE equipe SET status = 'E' WHERE id_equipe = '".$id_equipe."'";
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
	salvar_log($_SESSION["id_usuario"],"excluir equipe",$sql_exclui, $pdo);
		
	echo "<script>";
	echo "open('gerenciar_equipe.php?aviso=ok&msg=Item excluído com sucesso.','_self');";
	echo "</script>";
} else {
	// Log
	salvar_log($_SESSION["id_usuario"],"erro",$sql_exclui, $pdo);
		
	echo "<script>";
	echo "open('gerenciar_equipe.php?aviso=erro&msg=Não foi possível excluir o item.','_self');";
	echo "</script>";
}
?>