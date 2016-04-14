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
require("classes/models/ConveniosProgramas.php"); 
require("classes/models/Avaliacoes.php"); 

} elseif (file_exists('../classes/db.php')){
require('../classes/db.php');
require('../classes/util/util.php');
require("../classes/models/Estados.php"); 
require("../classes/models/Programas.php"); 
require("../classes/models/ConveniosProgramas.php"); 
require("../classes/models/Avaliacoes.php"); 
} else {
require('../../classes/db.php');
require('../../classes/util/util.php');
require("../../classes/models/Estados.php"); 
require("../../classes/models/Programas.php"); 
require("../../classes/models/ConveniosProgramas.php"); 
require("../../classes/models/Avaliacoes.php"); 
} 
class Gestor {

	public $db;
	private $estados;
	private $programas;
	private $conveniosProgramas;
	private $avaliacoes;
	
	public function __construct() {
		$this->estados = new Estados();
		$this->programas = new Programas();
		$this->conveniosProgramas = new ConveniosProgramas();
		$this->avaliacoes = new Avaliacoes();
			$this->db = new DB(array(metodo=>1));
			$this->db->conectar();
		
		}

		// SETOR REFERENTE AOS METODOS GENERICOS

		public function montaOptionsSelect($tabela, $nomeExibicao, $selecionado, $ordenacao = '', $ordenacao_tipo = '',  $remover = ''){	

			$this->db->montaOptionsSelect($tabela, $nomeExibicao, $selecionado, $ordenacao = '', $ordenacao_tipo = '',  $remover = '');

		}


	// SETOR REFERENTE AS CLASSES DA TABELA ESTADOS

	public function retornarAvaliacoes($id, $campo = 'id', $tabela = 'avaliacoes', $ordenadoPor = '', $order = '', $limit = '') {
		$retorno = $this->avaliacoes->retornar($id, $campo , $tabela, $ordenadoPor, $order, $limit);
					
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function inserirAvaliacoes($objeto) {
		$retorno = $this->avaliacoes->inserir($objeto);
				 
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function editarAvaliacoes($objeto,$campo = 'id') {
		$retorno = $this->avaliacoes->editar($objeto,$campo);
				 
		if($retorno) {
			return true;
		} else {
			return false;
		}
	}
	public function excluirAvaliacoes($valor,$campo = 'id') {
		$retorno = $this->avaliacoes->excluir($valor,$campo) ;

				 
		if($retorno) {
				return true;
		} else {
			return false;
		}
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


	// SETOR REFERENTE AS CLASSES DA TABELA CONVENIOS PROGRAMAS

	public function retornarConveniosProgramas($id, $campo = 'id', $tabela = 'convenios_programas', $ordenadoPor = '', $order = '', $limit = '') {
		$retorno = $this->conveniosProgramas->retornar($id, $campo , $tabela, $ordenadoPor, $order, $limit);
					
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function inserirConveniosProgramas($objeto) {
		$retorno = $this->conveniosProgramas->inserir($objeto);
				 
		if($retorno) {
			return $retorno;
		} else {
			return false;
		}
	}
	public function editarConveniosProgramas($objeto,$campo = 'id') {
		$retorno = $this->conveniosProgramas->editar($objeto,$campo);
				 
		if($retorno) {
			return true;
		} else {
			return false;
		}
	}
	public function excluirConveniosProgramas($valor,$campo = 'id') {
		$retorno = $this->conveniosProgramas->excluir($valor,$campo) ;

				 
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
