<?php
include_once("ferramenta/PHPMailer/PHPMailerAutoload.php");
include("site_mod_include.php");

if($_POST["acao"] == "envia-form-contato"){

	// Dados formulário
	$nome = $_POST['nome'];
    $email = $_POST['email'];
    $meio_contato = $_POST['meio'];
	$telefone = $_POST['telefone'];
	$assunto = "Novo E-mail Site Datapix";
	$mensagem = $_POST['mensagem'];

    $status_contato = envia_contato($nome,$email,$telefone,$assunto,$mensagem);

    if($status_contato) {
        $status_envio = "sucesso";
        redireciona("confirma-contato/$status_envio/".codifica("Recebemos seu contato e você receberá uma resposta no prazo máximo de 24 horas"));
    } else {
        $status_envio = "erro";
        redireciona("confirma-contato/$status_envio/".codifica("Não foi possível enviar a mensagem. Tente novamente!"));
    }


}else{

    redireciona("/index.php");

}
?>