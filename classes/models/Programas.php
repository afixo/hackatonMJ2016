<?php

/**
*	@Desenvolvido por Afixo Agência WEB
*	@url www.afixo.com.br
*	@email gestor@afixo.com.br
*
*	@autor Flávio Silva Brandão <flavio@afixo.com.br>
*	@version 07-03-2016 as 11:06:34
*/

class Programas extends DB {

	private $tabela = 'programas';
	private $CD_PROGRAMA;
	private $NM_PROGRAMA;
	private $TX_ACAO_PPA;
	private $TX_DESCRICAO_PROGRAMA;
	private $TX_SITUACAO_PROGRAMA;
	private $CD_ORG_SUPERIOR;
	private $NM_ORG_SUPERIOR;
	private $CD_ORG_CONCEDENTE;
	private $NM_ORG_CONCEDENTE;
	private $DT_DISPONIBILIZACAO;
	private $ANO_DISPONIBILIZACAO;
	private $MES_DISPONIBILIZACAO;
	private $DT_INC_VIGENCIA;
	private $ANO_INC_VIGENCIA;
	private $MES_INC_VIGENCIA;
	private $DT_FIM_VIGENCIA;
	private $ANO_FIM_VIGENCIA;
	private $MES_FIM_VIGENCIA;
	private $CD_MANDATARIA;
	private $NM_MANDATARIA;
	private $CD_EXECUTOR;
	private $NM_EXECUTOR;
	private $IN_CRITERIO_SELECAO;
	private $IN_CHAMA_PUBLICO;
	private $IN_REQUER_BENS_SERV;
	private $IN_REQUER_CRONO_DESEMB;
	private $IN_ACEITA_PROP_SEM_CADASTRO;
	private $IN_REQUER_PLANO_TRABALHO;
	private $IN_EMENDA_PARLAMENTAR;
	private $UF_HABILITADA;
	private $TX_REGIAO_GEOGRAFICA;
	private $ID_PROGRAMA_CONVENIO;

	/**
	* Método construtor do objeto programas  
	 @param bigint CD_PROGRAMA
	 @param string NM_PROGRAMA
	 @param string TX_ACAO_PPA
	 @param string TX_DESCRICAO_PROGRAMA
	 @param string TX_SITUACAO_PROGRAMA
	 @param inteiro CD_ORG_SUPERIOR
	 @param string NM_ORG_SUPERIOR
	 @param inteiro CD_ORG_CONCEDENTE
	 @param string NM_ORG_CONCEDENTE
	 @param string DT_DISPONIBILIZACAO
	 @param inteiro ANO_DISPONIBILIZACAO
	 @param string MES_DISPONIBILIZACAO
	 @param string DT_INC_VIGENCIA
	 @param string ANO_INC_VIGENCIA
	 @param string MES_INC_VIGENCIA
	 @param string DT_FIM_VIGENCIA
	 @param string ANO_FIM_VIGENCIA
	 @param string MES_FIM_VIGENCIA
	 @param string CD_MANDATARIA
	 @param string NM_MANDATARIA
	 @param inteiro CD_EXECUTOR
	 @param string NM_EXECUTOR
	 @param string IN_CRITERIO_SELECAO
	 @param string IN_CHAMA_PUBLICO
	 @param string IN_REQUER_BENS_SERV
	 @param string IN_REQUER_CRONO_DESEMB
	 @param string IN_ACEITA_PROP_SEM_CADASTRO
	 @param string IN_REQUER_PLANO_TRABALHO
	 @param string IN_EMENDA_PARLAMENTAR
	 @param string UF_HABILITADA
	 @param string TX_REGIAO_GEOGRAFICA
	 @param inteiro ID_PROGRAMA_CONVENIO

	**/
	public function __construct($CD_PROGRAMA="",$NM_PROGRAMA="",$TX_ACAO_PPA="",$TX_DESCRICAO_PROGRAMA="",$TX_SITUACAO_PROGRAMA="",$CD_ORG_SUPERIOR="",$NM_ORG_SUPERIOR="",$CD_ORG_CONCEDENTE="",$NM_ORG_CONCEDENTE="",$DT_DISPONIBILIZACAO="",$ANO_DISPONIBILIZACAO="",$MES_DISPONIBILIZACAO="",$DT_INC_VIGENCIA="",$ANO_INC_VIGENCIA="",$MES_INC_VIGENCIA="",$DT_FIM_VIGENCIA="",$ANO_FIM_VIGENCIA="",$MES_FIM_VIGENCIA="",$CD_MANDATARIA="",$NM_MANDATARIA="",$CD_EXECUTOR="",$NM_EXECUTOR="",$IN_CRITERIO_SELECAO="",$IN_CHAMA_PUBLICO="",$IN_REQUER_BENS_SERV="",$IN_REQUER_CRONO_DESEMB="",$IN_ACEITA_PROP_SEM_CADASTRO="",$IN_REQUER_PLANO_TRABALHO="",$IN_EMENDA_PARLAMENTAR="",$UF_HABILITADA="",$TX_REGIAO_GEOGRAFICA="",$ID_PROGRAMA_CONVENIO="") {
		$this->CD_PROGRAMA = $CD_PROGRAMA;
		$this->NM_PROGRAMA = $NM_PROGRAMA;
		$this->TX_ACAO_PPA = $TX_ACAO_PPA;
		$this->TX_DESCRICAO_PROGRAMA = $TX_DESCRICAO_PROGRAMA;
		$this->TX_SITUACAO_PROGRAMA = $TX_SITUACAO_PROGRAMA;
		$this->CD_ORG_SUPERIOR = $CD_ORG_SUPERIOR;
		$this->NM_ORG_SUPERIOR = $NM_ORG_SUPERIOR;
		$this->CD_ORG_CONCEDENTE = $CD_ORG_CONCEDENTE;
		$this->NM_ORG_CONCEDENTE = $NM_ORG_CONCEDENTE;
		$this->DT_DISPONIBILIZACAO = $DT_DISPONIBILIZACAO;
		$this->ANO_DISPONIBILIZACAO = $ANO_DISPONIBILIZACAO;
		$this->MES_DISPONIBILIZACAO = $MES_DISPONIBILIZACAO;
		$this->DT_INC_VIGENCIA = $DT_INC_VIGENCIA;
		$this->ANO_INC_VIGENCIA = $ANO_INC_VIGENCIA;
		$this->MES_INC_VIGENCIA = $MES_INC_VIGENCIA;
		$this->DT_FIM_VIGENCIA = $DT_FIM_VIGENCIA;
		$this->ANO_FIM_VIGENCIA = $ANO_FIM_VIGENCIA;
		$this->MES_FIM_VIGENCIA = $MES_FIM_VIGENCIA;
		$this->CD_MANDATARIA = $CD_MANDATARIA;
		$this->NM_MANDATARIA = $NM_MANDATARIA;
		$this->CD_EXECUTOR = $CD_EXECUTOR;
		$this->NM_EXECUTOR = $NM_EXECUTOR;
		$this->IN_CRITERIO_SELECAO = $IN_CRITERIO_SELECAO;
		$this->IN_CHAMA_PUBLICO = $IN_CHAMA_PUBLICO;
		$this->IN_REQUER_BENS_SERV = $IN_REQUER_BENS_SERV;
		$this->IN_REQUER_CRONO_DESEMB = $IN_REQUER_CRONO_DESEMB;
		$this->IN_ACEITA_PROP_SEM_CADASTRO = $IN_ACEITA_PROP_SEM_CADASTRO;
		$this->IN_REQUER_PLANO_TRABALHO = $IN_REQUER_PLANO_TRABALHO;
		$this->IN_EMENDA_PARLAMENTAR = $IN_EMENDA_PARLAMENTAR;
		$this->UF_HABILITADA = $UF_HABILITADA;
		$this->TX_REGIAO_GEOGRAFICA = $TX_REGIAO_GEOGRAFICA;
		$this->ID_PROGRAMA_CONVENIO = $ID_PROGRAMA_CONVENIO;
	}

	public function retornar($id, $campo = 'id', $tabela = 'programas', $ordenadoPor = '', $order = '', $limit = '') {
		return parent::retornar($id, $campo, $tabela, $ordenadoPor, $order, $limit);
	}

	public function inserir($objeto, $tabela = 'programas') {
		return parent::inserir($objeto, $tabela);
	}

	public function editar($objeto, $campo = 'id', $tabela = 'programas') {
		return parent::editar($objeto, $campo, $tabela);
	}

	public function excluir($valor, $campo = 'id', $tabela = 'programas'){
		return parent::excluir($valor, $campo, $tabela);
	}

}
?>