<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Coletando dados para consulta
$descricao = addslashes(trim($_GET['descricao']));

if($descricao) {
	$descricaos = explode(" ",$descricao);
	$total_descricaos = sizeof($descricaos);
	
	$condicao_consulta .= " AND (";
	
	for($i=0;$i<$total_descricaos;$i++) {
		$condicao_consulta .= "descricao LIKE '%".$descricaos[$i]."%'";
		
		if(($i+1) != $total_descricaos) {
			$condicao_consulta .= " OR ";
		}
	}
	
	$condicao_consulta .= ")";
	
	unset($i);
}

// Coleta os dados
$sql_slideshows = "SELECT id_slideshow, descricao, tamanho, data_inicial, data_final, status FROM slideshows WHERE status <> 'E'".$condicao_consulta." ORDER BY id_slideshow DESC";
$query_slideshows = $pdo->query($sql_slideshows);
$resultado_slideshows = $query_slideshows->fetchAll( PDO::FETCH_ASSOC );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include("../sistema_mod_include_head.php"); ?>
</head>
<body>
<div class="titulo-sessao-azul">Slideshows</div>
<?php include("../sistema_aviso.php"); ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=consultar" enctype="multipart/form-data" onsubmit="javascript: this.button.value='Aguarde, carregando...'; this.button.disabled='disabled';">
  <tr>
    <td><input type="button" name="button" id="button" onclick="javascript: window.open('incluir_slideshow.php','_self');" value="Incluir novo slideshow" /></td>
  </tr>
  <tr>
    <td>
      <div id="gerenciar_slideshow" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Filtros</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="campo-form">Descrição:</td>
                <td><input name="descricao" type="text" id="descricao" size="50" maxlength="150" value="<?php echo $descricao; ?>" /></td>
              </tr>
              <tr>
                <td class="campo-form">&nbsp;</td>
                <td><input type="submit" name="button" id="button" value="Filtrar slideshows" /></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</form>
</table>
<script type="text/javascript">
var gerenciar_slideshow = new Spry.Widget.TabbedPanels("gerenciar_slideshow");
</script>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EDEFF3">
  <tr>
    <td><div class="barra-endereco"></div></td>
  </tr>
  <tr>
    <td>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="20">&nbsp;</td>
            <td width="20">Id</td>
            <td>Descrição</td>
            <td width="80">Tamanho</td>
            <td width="80">Data inicial</td>
            <td width="80">Data final</td>
            <td width="20">&nbsp;</td>
            <td width="20">&nbsp;</td>
          </tr>
          <?php foreach($resultado_slideshows AS $executa_slideshows){ ?>
          <tr bgcolor="<?php if(is_int($i/2) != 1) { echo "#EDEFF3"; } else { echo "#FFFFFF"; }; ?>">
            <td>
            <div align="center">
            <?php
              if($executa_slideshows['status'] == "L") {
                echo '<img src="../imagens/icone/icone_ok.png" title="Slideshow liberado" width="16" height="16" border="0" />';
              }
              if($executa_slideshows['status'] == "B") {
                echo '<img src="../imagens/icone/icone_erro.png" title="Slideshow bloqueado" width="16" height="16" border="0" />';
              }
            ?>
            </div>
            </td>
            <td><div align="center"><?php echo $executa_slideshows['id_slideshow']; ?></div></td>
            <td><?php echo $executa_slideshows['descricao']; ?></td>
            <td><?php echo $executa_slideshows['tamanho']; ?></td>
            <td><?php echo converte_data_port($executa_slideshows['data_inicial']); ?></td>
            <td><?php echo converte_data_port($executa_slideshows['data_final']); ?></td>
            <td><div align="center"><a href="alterar_slideshow.php?id_slideshow=<?php echo base64_encode($executa_slideshows['id_slideshow']); ?>" target="_self"><img src="../imagens/icone/icone_alterar.png" title="Alterar o slideshow" width="16" height="16" border="0" /></a></div></td>
            <td><div align="center"><a href="javascript: confirma_acao('Tem certeza que deseja excluir &quot;<?php echo $executa_slideshows['descricao']; ?>&quot;?','excluir_slideshow.php?id_slideshow=<?php echo base64_encode($executa_slideshows['id_slideshow']); ?>');" target="_self"><img src="../imagens/icone/icone_excluir.gif" title="Excluir o slideshow" width="16" height="16" border="0" /></a></div></td>
          </tr>
          <?php $i += 1; } ?>
        </table>
    </td>
  </tr>
</table>
</body>
</html>