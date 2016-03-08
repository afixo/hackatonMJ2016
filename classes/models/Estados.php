<?php

/**
*	@Desenvolvido por Afixo Agência WEB
*	@url www.afixo.com.br
*	@email gestor@afixo.com.br
*
*	@autor Flávio Silva Brandão <flavio@afixo.com.br>
*	@version 07-03-2016 as 11:06:34
*/

class Estados extends DB {

	private $tabela = 'estados';
	private $id_estado;
	private $codigo_ibge;
	private $sigla;
	private $nome;
	private $dtm_lcto;

	/**
	* Método construtor do objeto estados  
	 @param inteiro id_estado
	 @param string codigo_ibge
	 @param char sigla
	 @param string nome
	 @param timestamp dtm_lcto

	**/
	public function __construct($id_estado="",$codigo_ibge="",$sigla="",$nome="",$dtm_lcto="") {
		$this->id_estado = $id_estado;
		$this->codigo_ibge = $codigo_ibge;
		$this->sigla = $sigla;
		$this->nome = $nome;
		$this->dtm_lcto = $dtm_lcto;
	}

	public function retornar($id, $campo = 'id', $tabela = 'estados', $ordenadoPor = '', $order = '', $limit = '') {
		return parent::retornar($id, $campo, $tabela, $ordenadoPor, $order, $limit);
	}

	public function inserir($objeto, $tabela = 'estados') {
		return parent::inserir($objeto, $tabela);
	}

	public function editar($objeto, $campo = 'id', $tabela = 'estados') {
		return parent::editar($objeto, $campo, $tabela);
	}

	public function excluir($valor, $campo = 'id', $tabela = 'estados'){
		return parent::excluir($valor, $campo, $tabela);
	}

}
?>