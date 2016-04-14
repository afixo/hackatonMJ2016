<?php
/**
*	@Desenvolvido por Afixo Agência WEB
*	@url www.afixo.com.br
*	@email gestor@afixo.com.br
*
*	@autor Flávio Silva Brandão <flavio@afixo.com.br>
*	@version 15-03-2012 as 15:03:36
*/

class DB {
	private $servidor; // 0 - local / 1 - online
	private $email;
	private $senha;
	private $admin;
	public $db;
	public $ultimoId;
	public function conectar(){	
		if (!$this->db instanceof PDO){		
			if ($this->servidor == 0) {
				$this->db = new PDO("mysql:host=127.0.0.1;dbname=corrupcao", 'root', 'afixo');
			} else {
				$this->db = new PDO("mysql:host=127.0.0.1;dbname=afixoco_mj", 'afixoco_padrao', 'afixo2014');
			}				
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
		}	
	}
    /**
     * Passando as propriedades refletidas para o construtor da classe generica
     *
     * @param mixed[] $properties The object properties
     * 
     * @throws Exception
     */
    public function __construct(Array $propriedades)
    {
		if ($propriedades['metodo'] != 1 ) {
			$classeRefletida = new ReflectionObject($this);	
			foreach ($classeRefletida->getProperties() as $propriedade) {
				if (!array_key_exists($propriedade->name, $propriedades)) {
					throw new Exception("Impossível de criar o objeto. Propriedade faltando: {$propriedade->name}");
				}	
				$this->{$propriedade->name} = $propriedades[$propriedade->name];
				echo $propriedade->name . "<br>";
			}			
		}
    }
/**
 *
 * @Insere um objeto refletido em sua respectiva tabela
 *
 * @acces public
 *
 * @param array $values
 *
 * @retorna int o ultimo Id inserido no success ou false na falha
 *
 */
	public function inserir($values, $tabela)
    {		
		self::conectar();
		/*** snarg the field names from the first array member ***/
		$fieldnames = array_keys($values[0]);
		/*** now build the query ***/
		$size = sizeof($fieldnames);
		$i = 1;
		$sql = "INSERT INTO " .$tabela ;
		/*** set the field names ***/
		$fields = '( ' . implode(' ,', $fieldnames) . ' )';
		/*** set the placeholders ***/
		$bound = '(:' . implode(', :', $fieldnames) . ' )';
		/*** put the query together ***/
		$sql .= $fields.' VALUES '.$bound;
		/*** prepare and execute ***/
		$stmt = $this->db->prepare($sql);
		
		foreach($values as $vals)
		{	
		   $retorno = $stmt->execute($vals);			
		}
		//echo "<br><br>$retorno<br>";
		if ($retorno){
		//	$this->ultimoId = $this->db->lastInsertId();
			if ($this->db->lastInsertId()){	
				return  $this->db->lastInsertId();
			} else {
				return true;	
			}
		} else {
			return false;	
		}			
	}
	public function editar($objeto, $campo, $tabela)
    {
		$tabela = self::get_classe_chamada();
		self::conectar();		
		foreach($objeto[0] as $chave=>$value)
		{			
			if ($chave == $campo){
				$id = $value;
			} else {				
				$sql = "UPDATE `$tabela` SET `$chave`='" .  $value . "' WHERE `".$campo."` = $id";
				//echo $sql . "<br />";
				$stmt = $this->db->prepare($sql);
				$retorno = @$stmt->execute();
			}
		}	
		if ($retorno){
			return true;
		} else {
			return false;	
		}					
	}
		public function retornar($id, $campo, $tabela, $ordernadoPor, $ordem, $limit) {
		self::conectar();
		
		if (is_array($id) && is_array($campo)){
			
			
			for($i =0 ; $i < count($campo); $i++){
				
				if($i == 0){
					$campos = "`$campo[$i]` = '$id[$i]' ";
				} else {
					$campos .= "AND `$campo[$i]` = '$id[$i]' ";
				}
				
			}
			
			$select    = "SELECT * FROM " . $tabela . " WHERE " . $campos;
			if ($ordernadoPor && $ordem){
					$select = $select . "ORDER BY " . $ordernadoPor . " " . $ordem;				
				}	
			if ($limit){
					$select = $select . " LIMIT " . $limit;				
			}			
			//echo $select;
			$statement = $this->db->prepare($select);
			
		} else {
		
			
			
			if ($id){
				$select    = "SELECT * FROM " . $tabela . " WHERE `$campo` = :id";		
				if ($ordernadoPor && $ordem){
					$select = $select . " ORDER BY " . $ordernadoPor . " " . $ordem;				
				}	
				if ($limit){
					$select = $select . " LIMIT " . $limit;				
				}	
				$statement = $this->db->prepare($select);
				$statement->bindParam(':id', $id, PDO::PARAM_INT);		
			} else {			
				$select    = "SELECT * FROM " . $tabela . " ";			
				if ($ordernadoPor && $ordem){
					$select = $select . "ORDER BY " . $ordernadoPor . " " . $ordem;				
				}						
				if ($limit){
					$select = $select . " LIMIT " . $limit;				
				}					
				$statement = $this->db->prepare($select);			
			}
		}
        //echo $select;
        $statement->execute();
	
		if ($statement->rowCount() == 1) {
        	$result = $statement->fetch(PDO::FETCH_OBJ);
		} else {
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
		}

        return ($result);
	}


    /**
     * Remover um registro do banco de dados
     *
     * @return boolean
     */
	public function excluir($id, $campo, $tabela) {		
		self::conectar();
        $sql    = "DELETE FROM " . $tabela . " WHERE `$campo` = $id";
        
        //echo $sql . '<br><br>';
        $statement = $this->db->prepare($sql);
        //$statement->bindParam(':id', $id, PDO::PARAM_INT);
        if ( @$statement->execute() ){ return true; } else { return false;}
	}

		// função que retornan as colunas da tabela

	public function montaOptionsSelect($tabela, $nomeExibicao, $selecionado, $ordenacao = "", $ordenacao_tipo = "",  $remover = "") {
		self::conectar();
		if (!empty($nomeExibicao)){
			if (!empty($ordenacao) && !empty($ordenacao_tipo)){
				$ordem = " ORDER BY " . $ordenacao . " " . $ordenacao_tipo;
			}
			$sql = "SELECT id, ".$nomeExibicao." FROM ".$tabela . $ordem;				
			$stmt = $this->db->prepare($sql);
			$resultado = $stmt->execute();
			$texto = "";
			while ($row = $stmt->fetch()){
				$id = $row["id"];
				$nome = $row[$nomeExibicao];
				$removerItem = false;				
				foreach($remover as $item){
					if ($item == $id){
						$removerItem = true;
					}
				}										
				if (!$removerItem)				
					if (intval($selecionado) == $id){
						$texto .= "<option value='" . $id . "' selected='selected'>".$nome."</option>" ;
					}else {
						$texto .= "<option value='" . $id . "'>".$nome."</option>" ;				
					}
				}
			}
			echo $texto;			
	}
	protected static function get_classe_chamada(){		
		$frase = get_called_class();
		$frase = lcfirst($frase);		
		if ( preg_match("/[A-Z]/", $frase)){
			//echo $frase . "<br>";
			$keywords = preg_split("/[A-Z]/", $frase);
			$i =0;
			foreach($keywords as $palavras){
				if ($i < count($keywords) ){
				$novaFrase .= $palavras . "_"	. substr($frase, $pos + strlen($palavras), 1);
				}
				$i++;
			}
			//echo ( strtolower(substr($novaFrase,0,-2)) );		
			//die;
			$novaFrase =  strtolower(substr($novaFrase,0,-2)) ;
		} else {
			$novaFrase =  $frase ;
		}
		return $novaFrase;
	}	
    /**
     * Get all class properties
     *
     * @return string[]
     */
    protected static function getFields()
    {
        static $fields = array();
        $called_class  = get_called_class();
        if (!array_key_exists($called_class, $fields)) {
            $reflection_class = new ReflectionClass($called_class);
            $propriedades = array();
            foreach ($reflection_class->getProperties() as $propriedade) {
			   if ($propriedade->name !=="db"){ // ajuste para retirar a propriedade db da lista
				    $propriedades[] = $propriedade->name;
				}
            }
            $fields[$called_class] = $propriedades;
        }
        return $fields[$called_class];
    }	
	  /**
     * Monta o Sql de Select baseado na reflexão da classe
     *
     * @return string
     */
    protected static function getSelect()
    {
        return "SELECT " . implode(', ', self::getFields()) . " FROM ";
    }	
	

	

        /***

         *

         * @select values from table

         *

         * @access public

         *

         * @param string $table The name of the table

         *

         * @param string $fieldname

         *

         * @param string $id

         *

         * @return array on success or throw PDOException on failure

         *

         */



        public function selecionarRand($table, $limite = 1)

        {

			if ($limite > 1){

				$sql = " LIMIT " . $limite;

			}

			

            $this->conexao();

            $sql = "SELECT * FROM `$table` ORDER BY RAND() " . $sql;

			$stmt = $this->db->prepare($sql);

            $stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);	

		}	

		

        public function selecionarRandWhere($table, $campo, $operacao, $valor, $limite = 1)

        {

			if ($limite > 1){

				$sql = " LIMIT " . $limite;

			}

			

            $this->conexao();

            $sql = "SELECT * FROM `$table` WHERE $campo $operacao '$valor' ORDER BY RAND() " . $sql;

			

//			echo $sql;

			$stmt = $this->db->prepare($sql);

            $stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);	

		}		




        /**

         *

         * @execute a raw query

         *

         * @access public

         *

         * @param string $sql

         *

         * @return array

         *

         */

        public function rawSelect($sql)

        {

            self::conectar();

			//echo $sql . "<br />";

            return $this->db->query($sql);

        }



        /**

         *

         * @run a raw query

         *

         * @param string The query to run

         *

         */

        public function rawQuery($sql)

        {

            self::conectar();

            $this->db->query($sql);

        }	
}
?>
