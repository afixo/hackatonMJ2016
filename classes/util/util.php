<?php
/*
 *	Sistema: Exemplo Afixo PHP5
 *	Autor: Flávio Silva Brandão
 *	Email: flaviofsb@hotmail.com
 *	Versão: 1.0
 *	Data da criação: 29/04/2008
 *	Hora da criação: 16:00:00
 *
 *	Data da geração do arquivo: 29-04-2008 as 16:18:12
 */
class Util {
	public $html;
	public $posicaoImagem;
	public $largura;
	public $altura;
	public $db;
	public $erro;
	public $acido;
	public function __construct($acido = "") {
		$this->db = $conexao;
		$this->acido = $acido;
	}	

	function removeAcentos($string, $padrao = 0 ) {
		if ($padrao == 1) {
			
			//$string = utf8_encode($string);
		}
			$string = htmlentities(strtolower($string));
			$string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/",'$1', $string);
			return $string;	
	}
		
	function formatarCEP($campo, $formatado = true){
		
		if ($formatado == true){		
			$retorno = substr($campo, 0,2) . '.' . substr($campo, 3,3) . '-' . substr($campo, 7,2);
		} else {
			$campo = str_replace(".","",$campo);
			$retorno = str_replace("-","",$campo);			
		}
		return $retorno;
	}
	
	function formatarTELEFONE($campo, $formatado = true){
		
		if ($formatado == true){		
			$retorno = $campo;
		} else {
			$campo = str_replace("(","",$campo);
			$campo = str_replace(")","",$campo);
			$campo = str_replace(" ","",$campo);
			$retorno = str_replace("-","",$campo);			
		}
		return $retorno;
	}	
	
	function formatarCPF_CNPJ($campo, $formatado = true){
		//retira formato
		$codigoLimpo = ereg_replace("[' '-./ t]",'',$campo);
		// pega o tamanho da string menos os digitos verificadores
		$tamanho = (strlen($codigoLimpo) -2);
		//verifica se o tamanho do código informado é válido
		if ($tamanho != 9 && $tamanho != 12){
			return false;
		}	 
		if ($formatado){
			// seleciona a máscara para cpf ou cnpj
			$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##'; 	 
			$indice = -1;
			for ($i=0; $i < strlen($mascara); $i++) {
				if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
			}
			//retorna o campo formatado
			$retorno = $mascara;	 
		}else{
			//se não quer formatado, retorna o campo limpo
			$retorno = $codigoLimpo;
		}	 
		return $retorno;
	 
	}	
	
	//You do not need to alter these functions
	public function getHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}
	//You do not need to alter these functions
	public function getWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}

	public function byte_convert($bytes, $precision=2) {
		$units = array('', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$unit = 0;
	
		do {
			$bytes /= 1024;
			$unit++;
		} while ($bytes > 1024);
	
		return sprintf("%1.{$precision}f%s", $bytes, $units[$unit]);
	}
	/*
	@arquivo Ex.: $_FILES['arquivo']
	@caminho Ex.: ../../uploads/caminho/

*/	
	public function uploadGenerics($arquivo, $caminho){		
		$erro = $config = array();		
		// Prepara a variável do arquivo
		$arquivo = isset($arquivo) ? $arquivo : FALSE;			
		// Formulário postado... executa as ações
		if ($arquivo) {  	
			// Imprime as mensagens de erro
			if (sizeof($erro)) {
				return $erro;
			} else { // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
				// Pega extensão do arquivo
				preg_match("/\.(gif|png|jpg|jpeg|doc|pdf|octet-stream|force-download|mpeg|mpeg3|mpg|x-mpeg|mp3){1}$/i", $arquivo["name"], $ext);		
				// Gera um nome único para a imagem
				
				$ext = explode('.',$arquivo["name"]);
				
				$nome_unico = md5(uniqid(time())) . "." . $ext[1];		
				// Cria caminho de onde o arquivo ficará se não existir		
				
	
				if( !file_exists($caminho) ){
					mkdir($caminho);
				}				
				// Faz o upload do arquivo
				if (move_uploaded_file($arquivo["tmp_name"], $caminho . '/' . $nome_unico)) { return $nome_unico; } else { 
					$erro[] = "Erro ao enviar o arquivo. <br />";
					return erro;
				}
			}
		}
	}	
	/*
	@caminho Ex.: imagem.jpg
	@diretorio Ex.: ../../uploads/caminho
	@largura Ex.: 365
	@altura Ex.: 300
	@$identificador P, M, G
	@tipo Ex.: 1 - Fit, 2 - Crop
	@modo Ex.: ftp, normal
*/
	public function thumb($caminho, $diretorio, $largura, $altura, $identificador, $tipo, $x=0,$y=0, $modo = "normal"){
		$arrArq = explode('.',$caminho);
		$i1 = $this->acido->image($diretorio.$caminho, $diretorio.$arrArq[0].$identificador.'.'.$arrArq[1]); 
		if ($tipo == "1"){ //fit
			$this->acido->Fit($i1, $largura, $altura);
		} else {
			
			//echo($x . " -- " . $y . " / " . $x1 . " " . $y1);
			//die;			
			$this->acido->crop($i1, $x, $y, $largura, $altura);
		}
		$i1->save(ASIDO_OVERWRITE_ENABLED);		
	}
	/*
	@arquivo Ex.: $_FILES['arquivo']
	@caminho Ex.: ../../uploads/caminho
	@limite_tipo Ex.: 1 - Igualdade, 2 - Maximo
	@tipo Ex.: 1 - Imagem, 2 - Pdf/msword 3 - audio/mpeg
	@modo Ex.: ftp, normal
*/	
	public function upload($arquivo, $caminho, $limite_tipo, $limite_w, $limite_h, $tipo, $modo = "normal"){
		
		$erro = $config = array();
		
		// Prepara a variável do arquivo
		$arquivo = isset($arquivo) ? $arquivo : FALSE;
		
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = 1048576;
		
		// Largura máxima (pixels)
		$config["largura"] = $limite_w;
		
		// Altura máxima (pixels)
		$config["altura"]  = $limite_h;
		// Formulário postado... executa as ações
		if ($arquivo) {  
			if ($tipo == 1){ // se imagem
			//var_dump($arquivo);
//			echo(sizeof($erro)." 222 -a: ".$arquivo." -c: ".$caminho." -lt: ".$limite_tipo." -lw: ".$limite_w." -lh: ".$limite_h." -t ".$tipo." -m ".$modo);								
				// Verifica se o mime-type do arquivo é de imagem
				if (!eregi("^image\/(pjpeg|jpeg|png|gif)$", $arquivo["type"])) {
					$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, gif ou png. <br />";
				} else {
					
					// Verifica tamanho do arquivo
					if ($arquivo["size"] > $config["tamanho"]) {
						$erro[] = "Arquivo em tamanho muito grande! A imagem deve ser de no máximo " . $this->byte_convert($config["tamanho"]) . ". <br />";
					}
					//echo($arquivo["size"] . " - " . $config["tamanho"]);
					
					// Para verificar as dimensões da imagem
					$tamanhos = getimagesize($arquivo["tmp_name"]);
					
					if ($limite_tipo == 1){ // igualdade
						// Verifica largura
						if ($tamanhos[0] != $config["largura"]) {
							$erro[] = "Largura da imagem deve ser " . $config["largura"] . " pixels. <br />";
						}
				
						// Verifica altura
						if ($tamanhos[1] != $config["altura"]) {
							$erro[] = "Altura da imagem deve ser " . $config["altura"] . " pixels. <br />";
						}
					} elseif($limite_tipo == 2){ // maximo

						// Verifica largura
						if ($tamanhos[0] > $config["largura"]) {
							$erro[] = "Largura da imagem não deve ultrapassar " . $config["largura"] . " pixels. <br />";
						}
						// Verifica altura
						if ($tamanhos[1] > $config["altura"]) {
							$erro[] = "Altura da imagem não deve ultrapassar " . $config["altura"] . " pixels. <br />";
						}						
					}
				}			
				
			} elseif($tipo == 2){ // se pdf ou doc
				if (!eregi("^application\/(pdf|msword)$", $arquivo["type"])) {
					$erro[] = "Arquivo em formato inválido! O Arquivo deve ser doc, pdf. <br />";
				} 				
			} elseif($tipo == 3){ // se mp3
				if (!eregi("^audio\/(mpeg|mpeg3|mpg|x-mpeg|mp3)$", $arquivo["type"]) && !eregi("^application\/(force-download|octet-stream)$", $arquivo["type"])) {
					$erro[] = "Arquivo em formato inválido! O Arquivo deve ser mp3. <br />";
				} 				
			}
			
			// Imprime as mensagens de erro
			if (sizeof($erro)) {
				return $erro;
			} else { // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
				// Pega extensão do arquivo
				preg_match("/\.(gif|png|jpg|jpeg|doc|pdf|octet-stream|force-download|mpeg|mpeg3|mpg|x-mpeg|mp3){1}$/i", $arquivo["name"], $ext);
		
				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		
				// Caminho de onde a imagem ficará
				
				if( !file_exists($caminho) ){
					mkdir($caminho);
				}
				$imagem_dir = $caminho . $imagem_nome;
		
				// Faz o upload da imagem
				if (move_uploaded_file($arquivo["tmp_name"], $imagem_dir)) { return $imagem_nome; } else { 
					$erro[] = "Erro ao enviar o arquivo. <br />";
					return erro;
				}
			}
		}
	}
   public function checarEmail($endereco){
      $pattern = "^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9\-\.]+$";
      if (eregi($pattern, $endereco)){
         return true;
      }
      else {
         return false;
      }   
   }
	public function retornaValor($valor, $formato_saida){
		if ($formato_saida == "mysql"){
			$valor = str_replace(".","",$valor);
			$valor = str_replace(",",".",$valor);		
		} else {
			$valor = number_format($valor,2,",",".");		
		}
		return $valor;
	}	
	/**	
	* @abstract Tratamento de injections em formulários.	
	* @return string	
	*/	
	public function antiInjection($str){		
		// Remove palavras suspeitas de injection.		
		//$str = preg_replace(sql_regcase("/(\n|\r|%0a|%0d|Content-Type:|bcc:|to:|cc:|Autoreply:|from|select|insert|delete|where|drop table|show tables||\*|--|\\\\)/"), "", $str);
		//$str = trim($str);  //Remove espaços vazios.	
		//$str = addslashes($str); // Adiciona barras invertidas à uma string.	
		
		return $str;
	} 		
	/**	
	* @abstract Antes de tratar os injections, verifica se é vetor ou não.	
	*/	
	public function validaParametro($vetor){		
		if (is_array($vetor)){
			foreach ($vetor as $chave => $valor){
				if (is_array($valor)){				
					$vetor[$chave] = $this->validaParametro($valor);
				} else { 
					$vetor[$chave] = $this->antiInjection($valor);
				}	
			}
		} else {
			$vetor[$chave] = $this->validaParametro($valor);
		}
		return $vetor;
	}
/*
  $_POST = validaParametro($_POST);
  $_GET = validaParametro($_GET);
*/
	public function retornaData($data, $formato_saida){
		if ($formato_saida == "br"){
			return date("d/m/Y", strtotime($data)); 
		} else {
			$data = explode("/",$data);
			return $data[2] . "-" . $data[1] . "-" . $data[0];
		}	
	}		
	public function encripty($texto){
	  return base64_encode(base64_encode(base64_encode($texto)));
	}	
	public function decripty($texto){
	  return base64_decode(base64_decode(base64_decode($texto)));
	}		
	public function calculaIdade($data_nasc) {
		$data_nasc=explode("/",$data_nasc);
		$data=date("d/m/Y");
		$data=explode("/",$data);
		$anos=$data[2]-$data_nasc[2];
		if ($data_nasc[1] > $data[1]) {
		return $anos-1;
		} if ($data_nasc[1] == $data[1]) {
		if ($data_nasc[0] <= $data[0]) {
		return $anos;
		break;
		} else {
		return $anos-1;
		break;
		}
		} if ($data_nasc[1] < $data[1]) {
		return $anos;
		}
	}	
	//transforma o primeiro nome de cada palavra da string em maiusculo
	//utilizado para nomes de Classes e Metodos
	//Ex: tipo_equipamento => TipoEquipamento
	public function toUpperForClass($string, $caracter)
	{
		$novaString = explode($caracter, $string);
		for ($i=0; $i<=count($novaString); $i++){
			$stringSaida .= ucfirst($novaString[$i]) . ""; 
		}		
		return $stringSaida;
	}	
	//transforma o primeiro nome de cada palavra da string em maiusculo e da um espaço
	//utilizado para o titulo do gestor
	//Ex: tipo_equipamento => Tipo Equipamento
	public function toUpperForTitle($string, $caracter)
	{
		$novaString = explode($caracter, $string);
		for ($i=0; $i<=count($novaString); $i++){
			$stringSaida .= ucfirst($novaString[$i]) . " "; 
		}		
		return $stringSaida;
	}		
	//transforma o primeiro nome de cada palavra da string em maiusculo
	//transformando depois o primeiro caracter da string em minisculo
	//utilizado para nomes de objetos
	//Ex: TipoEquipamento => tipoEquipamento
	public function toUpperForProperty($string, $caracter)
	{
		$novaString = explode($caracter, $string);
		for ($i=0; $i<=count($novaString); $i++){
			if ($i==0){
				$stringSaida .= strtolower($novaString[$i]) . ""; 
			} else {
				$stringSaida .= ucfirst($novaString[$i]) . ""; 
			}			
		}		
		return $stringSaida;
	}	
}
?>
