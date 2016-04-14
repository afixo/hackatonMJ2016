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
extract($_POST);
//var_dump($resultado);

$sql = "SELECT DISTINCT(NM_MUNICIPIO_PROPONENTE)  FROM `convenios_programas` WHERE UF_PROPONENTE = '$estado' GROUP BY NM_MUNICIPIO_PROPONENTE ORDER BY NM_MUNICIPIO_PROPONENTE ASC"; 
$stmt = $gestor->db->rawSelect($sql);
$stmt->execute();
$objGenerico = $stmt->fetchAll(PDO::FETCH_OBJ);	
//var_dump($objGenerico);
?>
<select class='form-control' name='cidade' id='cidade'>
	<option value=''>Todas</option>
<?php
if($objGenerico){
	//echo count($resultado);	
	for($i=0; $i < count($objGenerico) ; $i++) {  						
		$quantidade = $objGenerico[$i]->quantidade;					
		
	?>                 
					<option value="<?=utf8_encode($objGenerico[$i]->NM_MUNICIPIO_PROPONENTE)?>"><?=utf8_encode(ucWords(strtolower($objGenerico[$i]->NM_MUNICIPIO_PROPONENTE)))?></option>
	  <?php 
	} 
} 
?>
</select>	
