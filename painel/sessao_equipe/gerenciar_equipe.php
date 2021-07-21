<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();

// Coletando dados para consulta
$titulo = addslashes(trim($_GET['titulo_equipe']));

if($titulo) {
	$titulos = explode(" ",$titulo);
	$total_titulos = sizeof($titulos);
	
	$condicao_consulta .= " AND (";
	
	for($i=0;$i<$total_titulos;$i++) {
		$condicao_consulta .= "titulo_equipe LIKE '%".$titulos[$i]."%'";
		
		if(($i+1) != $total_titulos) {
			$condicao_consulta .= " OR ";
		}
	}
	
	$condicao_consulta .= ")";
	
	unset($i);
}

// Coleta os dados
$sql_equipe = "SELECT id_equipe, titulo_equipe, status FROM equipe WHERE status <> 'E'".$condicao_consulta." ORDER BY id_equipe DESC";
$query_equipe = $pdo->query($sql_equipe);
$resultado_equipe = $query_equipe->fetchAll( PDO::FETCH_ASSOC );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include("../sistema_mod_include_head.php"); ?>
</head>
<body>
<div class="titulo-sessao-azul">Equipe</div>
<?php include("../sistema_aviso.php"); ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>?acao=consultar" enctype="multipart/form-data" onsubmit="javascript: this.button.value='Aguarde, carregando...'; this.button.disabled='disabled';">
  <tr>
    <td><input type="button" name="button" id="button" onclick="javascript: window.open('incluir_equipe.php','_self');" value="Incluir novo equipe" /></td>
  </tr>
  <tr>
    <td>
      <div id="gerenciar_equipe" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Filtros</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="campo-form">Nome:</td>
                <td><input name="titulo_equipe" type="text" id="titulo_equipe" size="50" maxlength="150" value="<?php echo $titulo; ?>" /></td>
              </tr>
              <tr>
                <td class="campo-form">&nbsp;</td>
                <td><input type="submit" name="button" id="button" value="Filtrar equipe" /></td>
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
var gerenciar_equipe = new Spry.Widget.TabbedPanels("gerenciar_equipe");
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
            <td>Nome</td>
            <td width="20">&nbsp;</td>
            <td width="20">&nbsp;</td>
          </tr>
          <?php foreach($resultado_equipe AS $executa_equipe): ?>
          <tr bgcolor="<?php if(is_int($i/2) != 1) { echo "#EDEFF3"; } else { echo "#FFFFFF"; }; ?>">
            <td>
            <div align="center">
            <?php
              if($executa_equipe['status'] == "L") {
                echo '<img src="../imagens/icone/icone_ok.png" title="Parceiro liberadp" width="16" height="16" border="0" />';
              }
              if($executa_equipe['status'] == "B") {
                echo '<img src="../imagens/icone/icone_erro.png" title="Parceiro bloqueado" width="16" height="16" border="0" />';
              }
            ?>
            </div>
            </td>
            <td><div align="center"><?php echo $executa_equipe['id_equipe']; ?></div></td>
            <td><?php echo $executa_equipe['titulo_equipe']; ?></td>
            <td><div align="center"><a href="alterar_equipe.php?id_equipe=<?php echo base64_encode($executa_equipe['id_equipe']); ?>" target="_self"><img src="../imagens/icone/icone_alterar.png" title="Alterar a equipe" width="16" height="16" border="0" /></a></div></td>
            <td><div align="center"><a href="javascript: confirma_acao('Tem certeza que deseja excluir &quot;<?php echo $executa_equipe['titulo_equipe']; ?>&quot;?','excluir_equipe.php?id_equipe=<?php echo base64_encode($executa_equipe['id_equipe']); ?>');" target="_self"><img src="../imagens/icone/icone_excluir.gif" title="Excluir o parceiro" width="16" height="16" border="0" /></a></div></td>
          </tr>
          <?php $i += 1; endforeach; ?>
        </table>
    </td>
  </tr>
</table>
</body>
</html>