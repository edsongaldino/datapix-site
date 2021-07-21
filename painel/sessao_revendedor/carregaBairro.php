<?php include("../sistema_mod_include.php"); ?>
<?php
verifica_sessao();
$codigo_cidade = $_POST['codigo_cidade'];

$sql_bairro = "SELECT codigo_bairro, nome_bairro FROM bairro WHERE codigo_cidade = '".$codigo_cidade."' ORDER BY nome_bairro ASC";
$query_bairros = $pdo->query($sql_bairro);
$resultado_bairro = $query_bairros->fetchAll( PDO::FETCH_ASSOC );

foreach($resultado_bairro AS $bairro):
    echo '<option value="'.$bairro["codigo_bairro"].'">'.$bairro["nome_bairro"].'</option>';
endforeach;
?>