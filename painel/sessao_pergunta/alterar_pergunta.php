<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Pega o id
$id_pergunta_resposta = (int) base64_decode(addslashes(trim($_GET['id_pergunta_resposta'])));

// Pega os dados
$sql_pergunta_resposta = "SELECT pergunta, resposta, status FROM perguntas_resposta WHERE id_pergunta_resposta = ".$id_pergunta_resposta."";
$query_pergunta_resposta = mysql_query($sql_pergunta_resposta);
$executa_pergunta_resposta = mysql_fetch_assoc($query_pergunta_resposta);

if($_GET['acao'] == 'alterar') {
	// PEGA OS DADOS DO FORMUL�RIO
	$pergunta = addslashes(trim($_POST['pergunta']));
	$resposta = addslashes(trim($_POST['resposta']));
	$status = addslashes(trim($_POST['status']));
		
	// REALIZA A ALTERA��O
	$sql_alterar = "UPDATE perguntas_resposta SET pergunta = '".$pergunta."', resposta = '".$resposta."', status = '".$status."' WHERE id_pergunta_resposta = ".$id_pergunta_resposta."";
	$query_alterar = mysql_query($sql_alterar);

	// VERIFICA SE DEU ERRO
	if($query_alterar) {
		// Log
		salvar_log($_SESSION["id_usuario"],"alterar pergunta_resposta",$sql_alterar);
	
		echo "<script>";
		echo "open('gerenciar_perguntas.php?aviso=ok&msg=Informa��es da pergunta e resposta alterada com sucesso.','_self');";
		echo "</script>";
	} else {
		// Log
		salvar_log($_SESSION["id_usuario"],"erro",$sql_inclui);
	
		echo "<script>";
		echo "open('".$_SERVER['SCRIPT_NAME']."?aviso=erro&msg=N�o foi poss�vel alterar as informa��es da pergunta e resposta.&id_pergunta_resposta=".base64_encode($id_pergunta_resposta)."','_self');";
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
<body onload="document.form1.pergunta.focus();">
<div class="titulo-sessao-azul">Alterar pergunta e resposta</div>
<?php include("../sistema_aviso.php"); ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=alterar&id_pergunta_resposta=<?php echo base64_encode($id_pergunta_resposta); ?>" enctype="multipart/form-data" onsubmit="javascript: this.button.value='Aguarde, carregando...'; this.button.disabled='disabled';">
  <tr>
    <td colspan="2">
      <div id="alterar_pergunta_resposta" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es da pergunta e resposta</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td valign="top" class="campo-form">Pergunta:</td>
                <td><textarea name="pergunta" cols="50" rows="5" id="pergunta"><?php echo $executa_pergunta_resposta['pergunta']; ?></textarea></td>
              </tr>
              <tr>
                <td valign="top" class="campo-form">Resposta:</td>
                <td>
                	<script src="../ferramentas/editor/nicEdit.js" type="text/javascript"></script>
                    <script>
                        var id_textarea = 'resposta';
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
                    <input type="button" name="iniciar_copia" id="iniciar_copia" onclick="" value="Copiar conte�do externo" class="button" />
                    <textarea name="resposta" cols="60" rows="10" id="resposta"><?php echo $executa_pergunta_resposta['resposta']; ?></textarea>
                    <div id="boxColarConteudo">
                        <div id="boxColarConteudoFormularioCentral">
                            <div class="boxColarConteudoFormularioCentralTitulo">Copiar conte�do externo</div>
                            <div class="boxColarConteudoFormularioCentralDetalhe">Para copiar o conte�do de uma fonte externa, cole o texto abaixo e clica em finalizar c�pia.</div>
                            <div class="boxColarConteudoFormularioCentralForm"><textarea name="conteudo_externo" id="conteudo_externo"></textarea></div>
                            <div class="boxColarConteudoFormularioCentralBotoes"><input type="button" name="finalizar_copia" id="finalizar_copia" onclick="" value="Finalizar c�pia" class="button" /> - <input type="button" name="cancelar_copia" id="cancelar_copia" onclick="javascript: ocultar_camada('boxColarConteudo');" value="Cancelar" class="button" /></div>
                        </div>
                    </div> 
              </td>
              </tr>
              <tr>
                <td class="campo-form">Status:</td>
                <td>
                <select name="status" id="status">
                  <option value="L" <?php if($executa_pergunta_resposta['status'] == "L") { echo 'selected="selected"'; } ?>>Liberado</option>
                  <option value="B" <?php if($executa_pergunta_resposta['status'] == "B") { echo 'selected="selected"'; } ?>>Bloqueado</option>
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
  	<td><div class="info-observacao">&nbsp;</div></td>
    <td><div align="right"><input type="submit" name="button" id="button" value="Salvar altera&ccedil;&otilde;es" /></div></td>
  </tr>
</form>
</table>
<script type="text/javascript">
var alterar_pergunta_resposta = new Spry.Widget.TabbedPanels("alterar_pergunta_resposta");
</script>
</body>
</html>