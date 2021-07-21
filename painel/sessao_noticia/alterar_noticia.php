<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Pega o id
$id_noticia = (int) base64_decode(addslashes(trim($_GET['id_noticia'])));

// Pega os dados
$sql_noticia = "SELECT titulo_noticia, texto_noticia, resumo_noticia, data_noticia, arquivo, status FROM noticia WHERE id_noticia = '".$id_noticia."'";
$query_noticia = $pdo->query($sql_noticia);
$executa_noticia = $query_noticia->fetch( PDO::FETCH_ASSOC );

if($_GET['acao'] == 'alterar') {
	// PEGA OS DADOS DO FORMULÁRIO
  $titulo = addslashes(trim($_POST['titulo_noticia']));
  $resumo = addslashes(trim($_POST['resumo']));
	$status = addslashes(trim($_POST['status']));
  $texto = addslashes(trim(fonte_editor($_POST['texto'])));
  $data = addslashes(trim($_POST['data']));
		
	// Verifica se existe algum arquivo
  if (empty($_FILES['arquivo']['name'])) {

    $nome_arquivo = $executa_noticia["arquivo"];
		
	} else {

    $uploaddir = '../../conteudos/noticia/';
    $uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);
    
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
      $nome_arquivo = basename($_FILES['arquivo']['name']);
      $diretorio_arquivo = 'https://melloeborgesadvogados.com.br/conteudos/noticia/'.$nome_arquivo;
      redimensiona_imagem($diretorio_arquivo,350,224);
		}
		else{
				// Log
			salvar_log($_SESSION["id_usuario"],"erro","não foi possivel incluir o arquivo ".$nome_arquivo, $pdo);
		}
		
	}
	
	try{

		// REALIZA A ALTERAÇÃO
		$sql_alterar = "UPDATE noticia SET titulo_noticia = '".$titulo."', texto_noticia = '".$texto."', resumo_noticia = '".$resumo."', data_noticia = '".$data."', arquivo = '".$nome_arquivo."', status = '".$status."' WHERE id_noticia = ".$id_noticia."";
		$atualiza_noticia = $pdo->prepare($sql_alterar);
		$atualiza_noticia->execute();

		$altera = true;
		
	}catch (PDOException $e){
		echo 'Error: '. $e->getMessage();
		$altera = false;
	} 

	// VERIFICA SE DEU ERRO
	if($altera) {
		// Log
		salvar_log($_SESSION["id_usuario"],"alterar noticia",$sql_alterar, $pdo);
	
		echo "<script>";
		echo "open('gerenciar_noticias.php?aviso=ok&msg=Informações da noticia alterada com sucesso.','_self');";
		echo "</script>";
	} else {
		// Log
		salvar_log($_SESSION["id_usuario"],"erro",$sql_inclui, $pdo);
	
		echo "<script>";
		echo "open('".$_SERVER['SCRIPT_NAME']."?aviso=erro&msg=Não foi possível alterar as informações do noticia.&id_noticia=".base64_encode($id_noticia)."','_self');";
		echo "</script>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include("../sistema_mod_include_head.php"); ?>
</head>
<body onload="document.form1.titulo_noticia.focus();">
<div class="titulo-sessao-azul">Alterar noticia</div>
<?php include("../sistema_aviso.php"); ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=alterar&id_noticia=<?php echo base64_encode($id_noticia); ?>"  enctype="multipart/form-data" onsubmit="javascript: this.button.value='Aguarde, carregando...'; this.button.disabled='disabled';">
  <tr>
    <td colspan="2">
      <div id="alterar_noticia" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td class="campo-form">T&iacute;tulo:</td>
                <td><input name="titulo_noticia" type="text" id="titulo_noticia" class="campo-nome" value="<?php echo $executa_noticia['titulo_noticia']; ?>" size="50" maxlength="150" /></td>
              </tr>
              <tr>
                <td class="campo-form">Imagem:</td>
                <td><input name="arquivo" type="file" id="arquivo" size="50" /> (.jpg *)</td>
              </tr>
              <tr>
                <td valign="top" class="campo-form">Resumo:</td>
                <td><textarea name="resumo" cols="60" rows="3" id="resumo" maxlength="200"><?php echo $executa_noticia['resumo_noticia']; ?></textarea></td>
              </tr>
              <tr>
                <td class="campo-form">Data:</td>
                <td><input name="data" type="date" id="data_noticia" class="campo-data" value="<?php echo $executa_noticia['data_noticia']; ?>" size="50" /></td>
              </tr>
							<tr>
                <td valign="top" class="campo-form">Texto:</td>
                <td>
					      <script src="../ferramentas/editor/nicEdit.js" type="text/javascript"></script>
                    <script>
                        var id_textarea = 'texto';
                        var id_botao_submit = 'button'
                        var id_botao_ini_copiar = 'iniciar_copia';
                        var id_botao_fim_copiar = 'finalizar_copia';
                        
                        bkLib.onDomLoaded(function() {
                            new nicEditor({buttonList:['save','bold','italic','underline','link','unlink','html'],iconsPath:'../ferramentas/editor/nicEditorIcons.gif'}).panelInstance(id_textarea);
                            
                            document.getElementById(id_botao_submit).onclick = function() {
                                document.getElementById(id_textarea).value = nicEditors.findEditor(id_textarea).getContent();
                            }
                            
                            document.getElementById(id_botao_ini_copiar).onclick = function() {
                                mostrar_camada('boxColarConteudo');
                                var conteudo_temp = nicEditors.findEditor(id_textarea).getContent();
                                                if(conteudo_temp == "<br>") { conteudo_temp = ""; }
                                conteudo_temp = conteudo_temp.replace(/(<br>)/ig,"\n");
                                conteudo_temp = conteudo_temp.replace(/(<([^>]+)>)/ig,"");
                                document.getElementById('conteudo_externo').value = conteudo_temp;
                                document.getElementById('conteudo_externo').focus();
                            }
                            
                            document.getElementById(id_botao_fim_copiar).onclick = function() {
                                var conteudo_temp = document.getElementById('conteudo_externo').value;
                                var regX = /\n/gi ;
                                
                                conteudo_temp = conteudo_temp.replace(/(<([^>]+)>)/ig,"");
                                s = new String(conteudo_temp);
                                s = s.replace(regX, "<br> \n");
                                conteudo_temp = s;
                                
                                nicEditors.findEditor(id_textarea).setContent(conteudo_temp);
                                ocultar_camada('boxColarConteudo');
                            }
                        });
                    </script>
                    <input type="button" name="iniciar_copia" id="iniciar_copia" onclick="" value="Copiar conteúdo externo" class="button" />
                    <textarea name="texto" cols="60" rows="10" id="texto"><?php echo $executa_noticia['texto_noticia']; ?></textarea>
                    <div id="boxColarConteudo">
                        <div id="boxColarConteudoFormularioCentral">
                            <div class="boxColarConteudoFormularioCentralTitulo">Copiar conteúdo externo</div>
                            <div class="boxColarConteudoFormularioCentralDetalhe">Para copiar o conteúdo de uma fonte externa, cole o texto abaixo e clica em finalizar cópia.</div>
                            <div class="boxColarConteudoFormularioCentralForm"><textarea name="conteudo_externo" id="conteudo_externo"></textarea></div>
                            <div class="boxColarConteudoFormularioCentralBotoes"><input type="button" name="finalizar_copia" id="finalizar_copia" onclick="" value="Finalizar cópia" class="button" /> - <input type="button" name="cancelar_copia" id="cancelar_copia" onclick="javascript: ocultar_camada('boxColarConteudo');" value="Cancelar" class="button" /></div>
                        </div>
                    </div>
                </td>
              </tr>

              <tr>
                <td class="campo-form">Status:</td>
                <td>
                <select name="status" id="status">
                  <option value="L" <?php if($executa_noticia['status'] == "L") { echo 'selected="selected"'; } ?>>Liberado</option>
                  <option value="B" <?php if($executa_noticia['status'] == "B") { echo 'selected="selected"'; } ?>>Bloqueado</option>
                </select>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </td>
  </tr>
  <tr>
  	<td><div class="info-observacao"><span class="negrito">*</span> Recomenda&ccedil;&otilde;es da extens&atilde;o e / ou tamanho do arquivo.</div></td>
    <td><div align="right"><input type="submit" name="button" id="button" value="Salvar altera&ccedil;&otilde;es" /></div></td>
  </tr>
</form>
</table>
<script type="text/javascript">
var alterar_noticia = new Spry.Widget.TabbedPanels("alterar_noticia");
</script>
</body>
</html>