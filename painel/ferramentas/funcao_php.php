<?php
// Função para remover as tags html que não podem ser utilizada
function fonte_editor($txt) {
	$txt = str_replace("</div>","<br>",$txt);
	$txt = strip_tags($txt,"<a><b><strong><i><em><br>");
	
	return $txt;
}

// Salvar log - salvar_log('1','walbernir','DELETE FROM LOG WHERE CODIGO=BENI')
function salvar_log($id_usuario_log,$operacao_log,$comando_log, $pdo) {
	// Armazena o log
	$sql_log = 'INSERT INTO sistema_logs (id_usuario,ip,data,hora,operacao,comando) VALUES ("'.$id_usuario_log.'","'.$_SERVER["REMOTE_ADDR"].'","'.date("Ymd",time()).'","'.date("His",time()).'","'.$operacao_log.'","'.addslashes($comando_log).'")';

	// Atualizando o ultimo acesso			
	$atualiza_log = $pdo->prepare($sql_log);
	$atualiza_log->execute();
	
	// Apaga as variáveis
	unset($id_usuario_log,$operacao_log,$comando_log,$sql_log,$atualiza_log);
}

// Função para converte valores decimais para o padrão MySQL
function conv_valor_iso($valor) {
	$valor = str_replace(",",".",str_replace(".","",$valor));
	return $valor;
}

// Função para converte a data de portugues para o padrao Iso
function converte_data_mysql($data) {
	if($data) {
		$data = explode("/",$data);
		return $data[2]."-".$data[1]."-".$data[0];
	} else {
		return "0000-00-00";
	}
}

// Função para converte a data de Iso para o padrao port
function converte_data_port($data) {
	if($data) {
		$data = explode("-",$data);
		return $data[2]."/".$data[1]."/".$data[0];
	} else {
		return "00/00/0000";
	}
}

// Função para verificar se o campo ta vazio, se tiver, coloca N�o informado
function verifica_vazio($valor, $retorna) {
	$valor = trim($valor);

	if($valor) {
		return $valor;	
	} else {
		if($retorna == "") {
			return "-";
		} else {
			return $retorna;
		}
	}
}

// Verifica a sessao;
function verifica_sessao() {
	session_start();
	
	if($_SESSION['usuario_acesso'] != "765q3498b5t9erw87tsd48f6ds4f9849tre87t9r87ter") {
		echo "<script>";
		echo "open('/painel/sistema_login.php','_parent');";
		echo "</script>";
	}
}

// Remove todos os acentos e caracteres espeicias
function remove_acentos($texto) {
	$texto = strtolower(strtr($texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ -", "aaaaeeiooouucAAAAEEIOOOUUC__"));
	$texto = preg_match("[^a-zA-Z0-9_]", "", $texto);
	
	return $texto;
}



// Redimensiona a imagem
function redimensiona_imagem2($width_img,$height_img,$nome_arquivo,$novo_nome,$diretorio,$diretorio_destino,$forca_proporcao) {
	// Pega tamanho da foto
	$tamanho = getimagesize($diretorio.$nome_arquivo);
	
	// Fator imagem nova
	$fator1 = $width_img / $height_img;
	
	// Fator imagem original
	$fator2 = $tamanho[0] / $tamanho[1];

	// Faz o redimensionamento
	if($fator2 <= $fator1) {
		$width = $width_img;
		$width_ajuste = $tamanho[0]/$width;
		$height = $tamanho[1]/$width_ajuste;		
	} else {
		$height = $height_img;
		$height_ajuste = $tamanho[1]/$height;
		$width = $tamanho[0]/$height_ajuste;		
	}

	// Verifica se � pra for�a a propor��o (ou seja, a imagem ficar toda dentro do tamanho definido)
	if($forca_proporcao == "S") {
		// Verifica novamente pra ver se esta tudo ok
		if($width > $width_img) {
			$width = $width_img;
			$width_ajuste = $tamanho[0]/$width;
			$height = $tamanho[1]/$width_ajuste;
		}
		if($height > $height_img) {
			$height = $height_img;
			$height_ajuste = $tamanho[1]/$height;
			$width = $tamanho[0]/$height_ajuste;
		}
	}

	// Ajusta a margem para centralizar a imagem
	$pos_x = ($width_img-$width)/2;
	$pos_y = ($height_img-$height)/2;
	
	// Grava a imagem
	$tamanho_red = imagecreatetruecolor($width_img, $height_img); // definir tamanho fixo aqui
	imagefill($tamanho_red, 0, 0, imagecolorallocate($tamanho_red, 255, 255, 255)); // aplica o fundo branco
	imagecopyresampled($tamanho_red, imagecreatefromjpeg($diretorio.$nome_arquivo), $pos_x, $pos_y, 0, 0, $width, $height, $tamanho[0], $tamanho[1]);

	// Gera a nova imagem e salva em uma variavel
	ob_start();	
	imagejpeg($tamanho_red, NULL, 100);
	$imagem_final = ob_get_contents();
	ob_end_clean();

	// Cria um arquivo temporario e salva a imagem
	$arquivo_temp = tempnam($_SERVER['DOCUMENT_ROOT']."/painel/ferramentas/tmp", "TMP");
	$arquivo_temp_handle = fopen($arquivo_temp, "w");
	fwrite($arquivo_temp_handle, $imagem_final);
	fclose($arquivo_temp_handle);
	
	// Apaga arquivo temporario
	//unlink($arquivo_temp);
}

// Lista todos os arquivos de um diretorio
function lista_arquivo_diretorio($diretorio) {
	$conteudo_dir = array();

	if(is_dir($diretorio)) { // verifica se � diretorio 
		$abre_diretorio = @opendir($diretorio); // abre o diretorio
	
		if($abre_diretorio) { // verifica se abriu
			while(($arquivo = readdir($abre_diretorio)) != false) { // pega o conteudo
				if(filetype($diretorio.$arquivo) == "file") { // pega somente os arquivos, retirando os subdiretorios
					$conteudo_dir[] = $arquivo;
				}
			}
		
			closedir($abre_diretorio); // fecha o diretorio
			
			return $conteudo_dir; // retorna os arquivos
		}
	}
}


function texto($id_texto, $tipo, $pdo){

	// Coleta os dados
	$sql_texto = "SELECT id_texto, titulo, subtitulo, resumo, texto, arquivo FROM textos WHERE id_texto = '".$id_texto."'";
	$query_texto = $pdo->query($sql_texto);
	$texto = $query_texto->fetch( PDO::FETCH_ASSOC );


	switch($tipo):

		case ($tipo == 'titulo'):
			$resultado = $texto["titulo"];
		break;

		case ($tipo == 'subtitulo'):
			$resultado = $texto["subtitulo"];
		break;

		case ($tipo == 'texto'):
			$resultado = $texto["texto"];
		break;

		case ($tipo == 'imagem'):
			$resultado = $texto["arquivo"];
		break;

		case ($tipo == 'resumo'):
			$resultado = $texto["resumo"];
		break;


	endswitch;

	return ($resultado);
}

function redimensiona_imagem($caminho_imagem, $largura, $altura){

	// Retorna o identificador da imagem
	$imagem = imagecreatefromjpeg($caminho_imagem);
	
	// Cria duas variáveis com a largura e altura da imagem
	list( $largura, $altura ) = getimagesize( $caminho_imagem );
	
	// Nova largura e altura
	$proporcao = 0.5;
	$nova_largura = $largura * $proporcao;
	$nova_altura = $altura * $proporcao;
	
	// Cria uma nova imagem em branco
	$nova_imagem = imagecreatetruecolor( $nova_largura, $nova_altura );
	
	// Copia a imagem para a nova imagem com o novo tamanho
	imagecopyresampled(
		$nova_imagem, // Nova imagem 
		$imagem, // Imagem original
		0, // Coordenada X da nova imagem
		0, // Coordenada Y da nova imagem 
		0, // Coordenada X da imagem 
		0, // Coordenada Y da imagem  
		$nova_largura, // Nova largura
		$nova_altura, // Nova altura
		$largura, // Largura original
		$altura // Altura original
	);
	
	// Cria a imagem
	imagejpeg( $nova_imagem, $caminho_imagem, 100 );
	
	// Remove as imagens temporárias
	imagedestroy($imagem);
	imagedestroy($nova_imagem);

}
?>