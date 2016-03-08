<?php

/**
*	@Desenvolvido por Afixo Agência WEB
*	@url www.afixo.com.br
*	@email gestor@afixo.com.br
*
*	@autor Flávio Silva Brandão <flavio@afixo.com.br>
*	@version 07-03-2016 as 11:06:34
*/

if (file_exists('classes/db.php')){
require('classes/db.php');
require('classes/util/util.php');
require("classes/models/Estados.php"); 
require("classes/models/Programas.php"); 

} elseif (file_exists('../classes/db.php')){
require('../classes/db.php');
require('../classes/util/util.php');
require("../classes/models/Estados.php"); 
require("../classes/models/Programas.php"); 

} else {
require('../../classes/db.php');
require('../../classes/util/util.php');
require("../../classes/models/Estados.php"); 
require("../../classes/models/Programas.php"); 

} 
class Gestor {

	public $db;
	private $estados;
	private $programas;

	public function __construct() {
		$this->estados = new Estados();
		$this->programas = new Programas();

			$this->db = new DB(array(metodo=>1));
			$this->db->conectar();
		
		}

		// SETOR REFERENTE AOS METODOS GENERICOS

		public function montaOptionsSelect($tabela, $nomeExibicao, $selecionado, $ordenacao = '', $ordenacao_tipo = '',  $remover = ''){	

			$this->db->montaOptionsSelect($tabela, $nomeExibicao, $selecionado, $ordenacao = '', $ordenacao_tipo = '',  $remover = '');

		}


	// SETOR REFERENTE AS CLASSES DA TABELA ESTADOS

	public function retornarEstados($id, $campo = 'id', $tabela = 'estados', $ordenadoPor = '', $order = '', $limit = '') {
		$retorno = $this->estados->retornar($id, $campo , $tabela, $ordenadoPor, $order, $limit);
					
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function inserirEstados($objeto) {
		$retorno = $this->estados->inserir($objeto);
				 
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function editarEstados($objeto,$campo = 'id') {
		$retorno = $this->estados->editar($objeto,$campo);
				 
		if($retorno) {
			return true;
		} else {
			return false;
		}
	}
	public function excluirEstados($valor,$campo = 'id') {
		$retorno = $this->estados->excluir($valor,$campo) ;

				 
		if($retorno) {
				return true;
		} else {
			return false;
		}
	}


	// SETOR REFERENTE AS CLASSES DA TABELA PROGRAMAS

	public function retornarProgramas($id, $campo = 'id', $tabela = 'programas', $ordenadoPor = '', $order = '', $limit = '') {
		$retorno = $this->programas->retornar($id, $campo , $tabela, $ordenadoPor, $order, $limit);
					
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function inserirProgramas($objeto) {
		$retorno = $this->programas->inserir($objeto);
				 
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function editarProgramas($objeto,$campo = 'id') {
		$retorno = $this->programas->editar($objeto,$campo);
				 
		if($retorno) {
			return true;
		} else {
			return false;
		}
	}
	public function excluirProgramas($valor,$campo = 'id') {
		$retorno = $this->programas->excluir($valor,$campo) ;

				 
		if($retorno) {
				return true;
		} else {
			return false;
		}
	}
}
?>
