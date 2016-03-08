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
class Paginacao
{
    public $paginador = 'pagina';    
    private $solicitador;
    public $sql;
    public $limite;
    public $quantidade = 4;
    private $conexao;
	private $util;
	public $qtdEncontrado;
	
    // Construtor carrega a string usada para como paginador
    public function __construct($conexao = "", $util) 
    {
        $this->solicitador = $_REQUEST["{$this->paginador}"];
		$this->conexao = $conexao;    
		$this->util = $util;  
		
    }
	
    // Construtor carrega a string usada para como paginador
    public function setQuantidade($limite) 
    {
		
        $this->limite = $limite; 
		
    }	

    // Retorna o número de resultados encontrados    
    public function resultado()
    {
		
		
        $this->resultado = $this->conexao->rawSelect(str_replace('*', 'COUNT(*)', $this->sql));
		$this->resultado = $this->conexao->rawSelect($this->sql);
		$res = sizeof($this->resultado->fetchAll());
		$this->qtdEncontrado = $res;
		//echo $res . "<br />";
		
        $this->numeroResultados = $res;
        return $this->numeroResultados;
    }
    // Imprime um texto amigável mostrando o status das paginas em relação ao resultado atual
    public function imprimeBarraResultados()
    {        
        if($this->resultado() > 0) {
            //echo '<p class="info_resultado_busca">';
            echo 'Exibindo página <b style="font-size:20px">' . $this->paginaAtual()  . '</b> de <b style="font-size:20px">' . $this->paginasTotais() . '</b> disponíveis para <b style="font-size:20px">'.$this->resultado().'</b> resultados encontrados.';
        } else {
//            echo '<p class="info_resultado_busca">Não foram encontrados resultados para sua busca.</p>';
        }    
    }    
    // Calcula o número total de páginas
    public function paginasTotais()
    {        
        $paginasTotais = ceil($this->resultado() / $this->limite);
        return $paginasTotais;
    }
    // Procura o número da página Atual
    public function paginaAtual()
    {
        if (isset($this->solicitador) && is_numeric($this->solicitador)) {         
            $this->paginaAtual = (int) $this->solicitador;
        } else {
            $this->paginaAtual = 1;
        }

        if ($this->paginaAtual > $this->paginasTotais()) {
            $this->paginaAtual = $this->paginasTotais();
        }

        if ($this->paginaAtual < 1) {
            $this->paginaAtual = 1;
        }

        return $this->paginaAtual;
        
    }
    // Calcula o offset da consulta
    private function offset()
    {
        $offset = ($this->paginaAtual() - 1) * $this->limite;    
        return $offset;
    }
	//buscaJoin('desenho','arquivo',$campos,$colunas,$buscas)
	public function buscaJoin($tabela, $tabelaJoin, $camposExibicao, $coluna, $busca, $orderBy = NULL, $order = NULL){
	
		//var_dump($coluna);
		//echo("<br />");
		//var_dump($busca);		
		//echo "<br><br> ---------- <br><br>" . $coluna;
		//echo "<br><br> ---------- <br><br>" . $busca;
		if ($coluna && $busca){
			if (is_array($coluna) && is_array($busca)){			

				$sql = "SHOW COLUMNS FROM ".$tabelaJoin;			
				$stmt = $this->conexao->rawSelect($sql);				
				$cont = sizeof($coluna);
				
				$obj = $stmt->fetchAll();
				$contColuna = sizeof($obj);
				for($i=0; $i < $cont; $i++){
					//echo $i . "<br>";
					for($j=0; $j < $contColuna; $j++){
						//echo $obj[$j]["Field"] . " | " . $coluna[$i] . "<br>";
						if ($obj[$j]["Field"] == $coluna[$i]){	
							
							if (!empty($busca[$i])){	
								if ($obj[$j]["Type"] == "date"){							
									$where .= $coluna[$i]." = '".$this->util->retornaData($busca[$i],"us")."' AND ";								
								} else {
									
									if(substr($obj[$j]["Type"],0,7) == "varchar"){
										$where .= $coluna[$i]." LIKE '%".$busca[$i]."%' AND ";	
									} else {
										$where .= $coluna[$i]." = '".$busca[$i]."' AND ";	
									}									
								}
							}						
						
						}
					}
				}		
				
				$cont = sizeof($coluna);
				for($i=0; $i < $cont; $i++){
					if (!empty($busca[$i])){	
						if ($coluna[$i] == "data"){									
							$where .= $coluna[$i]." = '".$this->util->retornaData($busca[$i],"us")."' AND ";
						} else {
							$where .= $coluna[$i]." LIKE '%".$busca[$i]."%' AND ";	
						}
					}									
				}						
			} else {	
				$where .= $coluna." LIKE '%".$busca."%' ";
			}
		} else {
			$where    = "";
		}		
		if ($where){
			// procurar and no final			
			if (substr($where, -4, 4) == "AND " ){
				$where = substr($where, 0, -4);
			} 
			$where = " WHERE " . $where;
		}
		
		
		
		
		if ($orderBy && $order){
			$this->sql = "SELECT ".$camposExibicao." FROM $tabela INNER JOIN $tabelaJoin
			ON $tabela.id".ucfirst($tabelaJoin)."=$tabelaJoin.id $where  ORDER BY $orderBy $order";
		} else {
			$this->sql = "SELECT ".$camposExibicao." FROM $tabela INNER JOIN $tabelaJoin
			ON $tabela.id".ucfirst($tabelaJoin)."=$tabelaJoin.id $where";	
		}		
		
		//echo "<br><br> ---------- <br><br>" . $this->sql();
		return $this->conexao->rawSelect($this->sql());
	}	
	
	public function busca($tabela, $coluna="", $busca="", $orderBy = NULL, $order = NULL){

//echo "<br>---" . $busca ."<br>" ; 

		if (!empty($coluna) && !empty($busca)){
			
			if (is_array($coluna) && is_array($busca)){				
				$sql = "SHOW COLUMNS FROM ".$tabela;			
				$stmt = $this->conexao->rawSelect($sql);				
				$cont = sizeof($coluna);
				
				$obj = $stmt->fetchAll();
				$contColuna = sizeof($obj);
				for($i=0; $i < $cont; $i++){
					//echo $i . "<br>";
					for($j=0; $j < $contColuna; $j++){
						
						if ($obj[$j]["Field"] == $coluna[$i]){	
							
							if (!empty($coluna[$i]) && ($busca[$i] != '')){	
								//echo $coluna[$i] . " - " . $busca[$i] ."<br>";
								if ($obj[$j]["Type"] == "date"){							
									$where .= $coluna[$i]." = '".$this->util->retornaData($busca[$i],"us")."' AND ";								
								} else {
									if(substr($obj[$j]["Type"],0,7) == "varchar"){
										$where .= $coluna[$i]." LIKE '%".$busca[$i]."%' AND ";	
									} else {
										$where .= $coluna[$i]." = '".$busca[$i]."' AND ";	
									}
								}
							}	else {
								//echo $busca[$i] . " - Vazio<br>";	
							}					
						
						}
					}
				}				
								
			} else {	
				$sql = "SHOW COLUMNS FROM ".$tabela;			
				$stmt = $this->conexao->rawSelect($sql);				
				$cont = sizeof($coluna);
				
				$obj = $stmt->fetchAll();
				$contColuna = sizeof($obj);
				for($i=0; $i < $cont; $i++){			
					for($j=0; $j < $contColuna; $j++){
						
						if ($obj[$j]["Field"] == $coluna){	
							if(substr($obj[$j]["Type"],0,7) == "varchar"){
								$where .= $coluna." LIKE '%".$busca."%' ";
							} elseif ($obj[$j]["Type"] == "date"){							
									$where .= $coluna." = '".$this->util->retornaData($busca,"us")."' AND ";								
							} elseif ($obj[$j]["Type"] == "datetime"){							
									$where .= $coluna." >= '".$this->util->retornaData($busca,"us")." 00:00:00' AND " . $coluna." <= '".$this->util->retornaData($busca,"us")." 23:59:59'";								
							}					
							 else {
								$where .= $coluna." = '".$busca."' ";
							}
						} 
					}
				}
				
			}
			
		} else {
			$where    = "";
		}		
		if ($where){
			// procurar and no final			
			if (substr($where, -4, 4) == "AND " ){
				$where = substr($where, 0, -4);
			} 
			$where = " WHERE " . $where;
		}
		if (is_array($orderBy) && is_array($order)){		
			for($i=0; $i <= count( $orderBy ) ; $i++){
				$cmp .= $orderBy[$i] . " " . $order[$i] . ",";
			}
			$cmp = substr($cmp, 0, -3);
			//echo "<br><br> ---------- <br><br>" . $cmp;
			if ($cmp){
			$this->sql = "SELECT * FROM $tabela $where ORDER BY $cmp";	
				
			}
		} elseif ($orderBy && $order){
			$this->sql = "SELECT * FROM $tabela $where ORDER BY $orderBy $order";
		} else {
			$this->sql = "SELECT * FROM $tabela $where";			
		}
		//echo "<br><br> ---------- <br><br>" . $this->sql;
		return $this->conexao->rawSelect($this->sql());
	}
	
	
    // Retorna o SQL para trabalhar posteriormente
    public function sql()
    {
        $sql = $this->sql .  " LIMIT {$this->limite} OFFSET {$this->offset()} ";
        return $sql;
    }
    // Imprime a barra de navegação da paginaçaõ
    public function imprimeBarraNavegacao() 
    {
		
        if($this->resultado() > 0) {        
			if($this->paginasTotais() > 1){			
				echo '<div id="navegacao_busca" class="paginacao"><ul>';
				if ($this->paginaAtual() > 1) {
					echo "<li  class='Anterior'><a href='?" . $this->paginador . "=1"  . $this->reconstruiQueryString($this->paginador) . "'>«« Primeira</a></li>";
					$anterior = $this->paginaAtual() - 1;
					echo "<li class='Anterior'><a href='?" . $this->paginador . "=" . $anterior . $this->reconstruiQueryString($this->paginador) . "'>« Anterior</a></li>";
				}
				
				for ($x = ($this->paginaAtual() - $this->quantidade); $x < (($this->paginaAtual() + $this->quantidade) + 1); $x++) {
					if (($x > 0) && ($x <= $this->paginasTotais())) {
						if ($x == $this->paginaAtual()) {
							echo "<li class='paginaAtual'>$x</li>";
						} else {
							echo "<li><a href='?" . $this->paginador . "=" . $x . $this->reconstruiQueryString($this->paginador) . "'>$x</a></li>";
						}
					}
				}
				
				if ($this->paginaAtual() != $this->paginasTotais()) {
					$paginaProxima = $this->paginaAtual() + 1;
					echo "<li class='Proxima'><a href='?" . $this->paginador . "=" . $paginaProxima . $this->reconstruiQueryString($this->paginador) . "'>Próxima »</a></li>";
				  //  echo "<li class='Proxima'><a href='?" . $this->paginador . "=" . $this->paginasTotais() . $this->reconstruiQueryString($this->paginador) . "'>Última »»</a></li>";
				}
				
				echo '</ul></div>';    
			}
        }    
    }
	
// Imprime a barra de navegação da paginaçaõ
    public function imprimeBarraNavegacao2() 
    {
		
        if($this->resultado() > 0) {        
			if($this->paginasTotais() > 1){			
				//echo $this->paginasTotais();
				
				//echo $this->paginaAtual();
				echo '<ul class="pag">';
				for ($x = ($this->paginaAtual() - $this->quantidade); $x < (($this->paginaAtual() + $this->quantidade) + 1); $x++) {
					

					if (($x > 0) && ($x <= $this->paginasTotais())) {
						if ($x < $this->paginasTotais()){
							$pipe = "&nbsp;|&nbsp;";
							//echo("menor<br>");
						} else {
							$pipe = "&nbsp;";	
							//echo("igual<br>");						
						}
						if ($x == $this->paginaAtual()) {
							echo "<li><font style='color:#000'>$x</font>".$pipe."</li>";
						} else {
							echo "<li><a href='?" . $this->paginador . "=" . $x . $this->reconstruiQueryString($this->paginador) . "'>$x</a>".$pipe."</li>";
						}
					}
				}				
				echo '</ul>';    
			}
        }    
    }	
    // Monta os valores da Query String novamente
    public function reconstruiQueryString($valoresQueryString) {
        if (!empty($_SERVER['QUERY_STRING'])) {
            $partes = explode("&", $_SERVER['QUERY_STRING']);
            $novasPartes = array();
            foreach ($partes as $val) {
                if (stristr($val, $valoresQueryString) == false)  {
                    array_push($novasPartes, $val);
                }
            }
            if (count($novasPartes) != 0) {
                $queryString = "&".implode("&", $novasPartes);
            } else {
                return false;
            }
            return $queryString; // nova string criada
        } else {
            return false;
        }
    }    
    
} 
?>