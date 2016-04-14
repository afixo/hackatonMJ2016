<?php 
/**
*	@Desenvolvido por Afixo Agência WEB
*	@url www.afixo.com.br
*	@email gestor@afixo.com.br
*
*	@autor Flávio Silva Brandão <flavio@afixo.com.br>
*	@version 28-10-2013 as 21:56:57
*/

ob_start();
session_start();

require('../classes/gestor.php');
$util = new Util();
$gestor   = new Gestor();

extract($_GET);
$removerColuna = array('id');
$resultado = $gestor->retornarEstados('','nome','estados','nome','ASC');

if ($resultado){
	if (count($resultado) < 2){
		$resultado = array($resultado);
	}
}
//var_dump($resultado);

$sql = "SELECT DISTINCT(NM_MUNICIPIO_PROPONENTE), COUNT(NM_MUNICIPIO_PROPONENTE) AS quantidade  FROM `convenios_programas` WHERE UF_PROPONENTE = '$pasta' GROUP BY NM_MUNICIPIO_PROPONENTE ORDER BY NM_MUNICIPIO_PROPONENTE ASC"; 
$stmt = $gestor->db->rawSelect($sql);
$stmt->execute();
$objGenerico = $stmt->fetchAll(PDO::FETCH_OBJ);	
//var_dump($objGenerico);
if($objGenerico){
	//echo count($resultado);	
	for($i=0; $i < count($objGenerico) ; $i++) {  						
		$quantidade = $objGenerico[$i]->quantidade;					
		
	?>                 
				<li onclick="buscarProgramas('<?=utf8_encode($objGenerico[$i]->NM_MUNICIPIO_PROPONENTE)?>');"><span style='float:left; margin-top:8px'><?=utf8_encode(ucWords(strtolower($objGenerico[$i]->NM_MUNICIPIO_PROPONENTE)))?></span><div style="background:#fff; border:1px sollid #333; border-radius:30%; min-width:30px; padding:5px; height:30px; float:right; margin-right:5px"><span style='width:100%; text-align:center; display:block; margin-top:3px'><?=$quantidade?></span></div></li>
	  <?php 
	} 
} 
