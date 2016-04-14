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
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Brasil Transparente</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" >    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<?php
		require("../inc/navbar.php");
		?>
		<div class="container-fluid" style=''>
			<div class='row'>
					<div class='col-sm-12' style=''>
					<?php 		
						$objConveniosProgramas = $gestor->retornarConveniosProgramas($id, 'NR_CONVENIO','convenios_programas','NR_CONVENIO','DESC');
						if ($objConveniosProgramas){
							if (count($objConveniosProgramas) < 2){
								$objConveniosProgramas = array($objConveniosProgramas);
							}
						}				
						if($objConveniosProgramas){
								for($i=0; $i < 1 ; $i++) {  	
										//if ($objConveniosProgramas[$i]->TX_SITUACAO != ""){				
										?>
										<div style='display:block; margin-top:8px;' class=''>
																			

											<div style='width:100%; display:block; overflow:hidden; min-height:20px; font-weight:bold'>
												<span style='float:left'><?=utf8_encode($objConveniosProgramas[$i]->TX_MODALIDADE)?><br>
											
											
												<?=$objConveniosProgramas[$i]->DT_INICIO_VIGENCIA?> até <?=$objConveniosProgramas[$i]->DT_FIM_VIGENCIA?></span>
											</div>
										<span class='info-resultado'><?=utf8_encode($objConveniosProgramas[$i]->TX_OBJETO_CONVENIO)?><br /></span>

										<div style='width:100%; display:block; overflow:hidden; min-height:20px; font-weight:bold'>
												<span style='float:left' class='outras-resultado'>
												<?php								
													if ($objConveniosProgramas[$i]->TX_SITUACAO){
														echo (utf8_encode($objConveniosProgramas[$i]->TX_SITUACAO) . " <br />");
													} else {
															echo "Não informado <br />";
													}											
													?>									
											
												<?=$objConveniosProgramas[$i]->VL_GLOBAL?>
													</span>
												
											</div>	
											<div style='width:100%; display:block; font-size:0.9em; overflow:hidden; min-height:20px'>
											<small style=''>(<i class='fa fa-eye' style=''>10)</i>&nbsp;(<i class='fa fa-comment' style=''>3)</i></small>
											
											</div>								
											
												<hr >
											<h5 style='font-weight:bold'>DETALHAMENTO DE INFORMAÇÕES</h5>	
										</div>
										<div style='font-size:1em'>
										
											<b>UF: </b> <?php echo (utf8_encode($objConveniosProgramas[$i]->UF_PROPONENTE)); if ($objConveniosProgramas[$i]->NM_MUNICIPIO_PROPONENTE){ ?><small> (<?=utf8_encode($objConveniosProgramas[$i]->NM_MUNICIPIO_PROPONENTE)?>)</small><?php } ?><br>	
											<b>Orgão superior: </b> <?=utf8_encode($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR)?><br>	
												
											<b>Concedente: </b> <?=utf8_encode($objConveniosProgramas[$i]->NM_ORGAO_CONCEDENTE)?><br>	
											<b>Responsável:</b> <?=utf8_encode($objConveniosProgramas[$i]->NM_RESPONS_CONCEDENTE)?><small> (<?=utf8_encode($objConveniosProgramas[$i]->TX_CARGO_RESPONS_CONCEDENTE)?>)</small>
											<br>
											<b>Proponente:</b> <?=utf8_encode($objConveniosProgramas[$i]->NM_PROPONENTE)?><br>
											 <b>Responsável:</b> <?=utf8_encode($objConveniosProgramas[$i]->NM_RESPONS_PROPONENTE)?><small> (<?=utf8_encode($objConveniosProgramas[$i]->TX_CARGO_RESPONS_PROPONENTE)?>)</small>
											<br><br>
											
											
											<b>Objeto:</b>
											<?=utf8_encode($objConveniosProgramas[$i]->TX_OBJETO_CONVENIO)?><br /><br />
											<b>Justificativa:</b>
											<?=utf8_encode($objConveniosProgramas[$i]->TX_JUSTIFICATIVA)?><br /><br />
											<b>Programa:</b>
											<?=utf8_encode($objConveniosProgramas[$i]->NM_PROGRAMA)?><br /><br />
																						
											
										
											<b>Valor Convênio:</b> <?=$objConveniosProgramas[$i]->VL_GLOBAL?><br>
											<b>Valor Liberado:</b> <?=$objConveniosProgramas[$i]->VL_REPASSE?><br>
											<b>Valor Contrapartida:</b> <?=$objConveniosProgramas[$i]->VL_CONTRAPARTIDA_TOTAL?><br><br>
											
											<b>Situação:</b>
											<?php								
												if ($objConveniosProgramas[$i]->TX_SITUACAO){
													echo (utf8_encode($objConveniosProgramas[$i]->TX_SITUACAO));
												} else {
														echo "Não informado";
												}											
												?>												
											<br><br>																		
																					

											<b>Início da Vigência:</b> 	<?=$objConveniosProgramas[$i]->DT_INICIO_VIGENCIA?><br>
											<b>Publicação:</b> 	<?=$objConveniosProgramas[$i]->DT_PUBLICACAO?><br>											
											<b>Fim da Vigência:</b> 	<?=$objConveniosProgramas[$i]->DT_FIM_VIGENCIA?><br><br>
											<?php if ($objConveniosProgramas[$i]->DT_ULTIMO_PAGAMENTO){ ?>
											<b>Data Última Liberação:</b> 	<?=$objConveniosProgramas[$i]->DT_ULTIMO_PAGAMENTO?><br>
											<?php } ?>
											
												
											<b>Ação Orçamentária:  </b><?=$objConveniosProgramas[$i]->CD_ACAO_PPA?><br />
											<b>Possui Chamamento Público/Concurso de Projetos? </b><?php if ($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR == 'S' ){ echo "Sim"; } else { echo "Não"; } ?><br />
																				
											<b>Deve Apresentar Plano de Trabalho? </b><?php if ($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR == 'S' ){ echo "Sim"; } else { echo "Não"; } ?><br />
											<b>Aceita Proposta de Proponente não cadastrado? </b><?php if ($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR == 'S' ){ echo "Sim"; } else { echo "Não"; } ?><br />
											<b>Aceita Despesa Administrativa? </b><?php if ($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR == 'S' ){ echo "Sim"; } else { echo "Não"; } ?><br />
											
											<b>Quantidade de empenhos: </b><?php echo (int) $objConveniosProgramas[$i]->QT_EMPENHOS?></span><br>
											<b>Quantidade de aditivos: </b><?php echo (int) $objConveniosProgramas[$i]->QT_ADITIVOS?></span><br>
											<b>Quantidade de prorrogações: </b><?php echo (int) $objConveniosProgramas[$i]->QT_PRORROGAS?></span><br>
											
									
										</div>
										<hr >
										<div id="fb-root"></div>
																
						
										<!-- Your share button code -->
										<div class="fb-share-button" 
											data-href="http://digitaleads.com/leads/campanhas/<?=$pasta?>" 
											data-layout="button_count" style='margin:0 auto; display:block; width:130px'>
										</div>	
										
										<hr >								
										<h5 style='font-weight:bold'>Como você avalia 
										
										<?php
										
										if ($objConveniosProgramas[$i]->TX_MODALIDADE){
											echo (" este " . utf8_encode($objConveniosProgramas[$i]->TX_MODALIDADE) . " ?");
										} else {								
											
											echo " este Convênio?";
										}	
										?>
										
										</h5>
										<label><input type='radio' name='avaliacao[]' id='avaliacao1' value='1'  />&nbsp;Ruim</label><br>
										<label><input type='radio' name='avaliacao[]' id='avaliacao2' value='3'  />&nbsp;Inadequado</label><br>
										<label><input type='radio' name='avaliacao[]' id='avaliacao2' value='5'checked  />&nbsp;Razoável</label><br>
										<label><input type='radio' name='avaliacao[]' id='avaliacao3' value='6'  />&nbsp;Moral</label><br>
										<label><input type='radio' name='avaliacao[]' id='avaliacao4' value='8'  />&nbsp;Eficiente</label><br>
										<label><input type='radio' name='avaliacao[]' id='avaliacao4' value='10'  />&nbsp;Muito Eficiente</label><br>
										<div style=''>
											<textarea id="opiniao" name="opiniao" placeholder='Informe um comentário, sugestão ou até mesmo uma crítica.' style="width:100%; margin-left:0px; margin-top:20px; height:100px; min-height:100px; max-height:100px; margin-bottom:10px; display:block"></textarea>
										</div>
										
										<div style=" display:block; min-width:30px; padding-top:10px; min-height:30px; padding-right:10px ">
										
										<a class="btn btn-default " href="javascript:void(0);" onclick='avaliar()'    style='width:100%;  text-align:center; padding-top:10px; width:100%; display:block; margin-right:10px; border-left:0; border-right:0; border-top:0;'>
											
							<span class="fa-stack fa-lg">
								<i class="fa fa-circle fa-stack-2x" style='color:#E2EFE7'></i>
							  <i class="fa fa-pencil  fa-stack-1x " style='color:#333'></i>
							</span>											
											Fiscalizar
										</a>
										
										</div>
									<?php 
										//}
									}
						} 					
									
					?>  					
					
					
					<hr>
					
					</div>
					
			</div>
		</div>
    
    
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="../js/jquery-1.12.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));		
	<?php
	if (preg_match('/iphone|ipod|android/',strtolower($_SERVER['HTTP_USER_AGENT']))){
	?>	
	  // Hides mobile browser's address bar when page is done loading.
	  window.addEventListener('load', function(e) {
		setTimeout(function() { window.scrollTo(0, 1); }, 1);
	  }, false);
	<?php
	}
	?>		
	</script>
  </body>
</html>      
