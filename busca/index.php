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
				
				<form name='frm' id='frm' action='resultado.php' method='post' enctype='multipart/form-data' >
					<div class='col-sm-12' style=''>
					
							<label style='width:100%'>Qual estado a fiscalizar?
								<select class='form-control' name='estado' id='estado' style='  '>
									<option value=''>&nbsp;&nbsp;Selecione um estado</option>
									<?php 
									if($resultado){
										//echo count($resultado);	
										for($i=0; $i < count($resultado) ; $i++) {  
										?>   
										<option value='<?=strtolower($resultado[$i]->sigla)?>'><?=utf8_encode(ucfirst(strtolower($resultado[$i]->nome)))?></option>
										<?php 								 
										} 
									}
									?>  
								</select>							
							</label>
					</div>		
					<div class='col-sm-12' style=''>		
							<label style='width:100%; padding-top:5px; padding-bottom:5px;'>Cidade?
							<div id='div_cidade'>
								<select class='form-control' name='cidade' id='cidade' style='   '>
									<option value=''>Todas</option>
								</select>	
							</div>
							</label>
					</div>		
					<div class='col-sm-12' style=''>								
							<label style='width:100%'>O que deseja fiscalizar?
							<select class='form-control' name='tx_modalidade' id='tx_modalidade' style='  '>
								<option value=''>Todas as execuções</option>
 
										     								
										<option value="Contrato de Repasse">Contratos de Repasse</option>
										     								
										<option value="Convênio">Convênios</option>
										     								
										<option value="Convênio ou Contrat">Convênios ou Contratos</option>
										     								
										<option value="Termo de Cooperação">Termos de Cooperações</option>
										     								
										<option value="Termo de Parceria">Termos de Parcerias</option>
							</select>	
							</label>
						<br>						
							<label style='width:100%'>Situação?
							<select class='form-control' name='tx_situacao' id='tx_situacao' style='  '>
								<option value=''>Todas</option>
 
;
;
;
;
;
;
;
;
;
										     								
										<option value="Aguardando Prestação de Contas">Aguardando Prestação de Contas</option>
										     								
										<option value="Em execução">Em execução</option>
										     								
										<option value="Prestação de Contas enviada para Análise">Prestação de Contas enviada para Análise</option>
										     								
										<option value="Proposta Aprovada e Plano de Trabalho Complementado enviado para Análise">Proposta Aprovada e Plano de Trabalho Complementado enviado para Análise</option>
										     								
										<option value="Proposta Aprovada e Plano de Trabalho em Complementação">Proposta Aprovada e Plano de Trabalho em Complementação</option>
										
										<option value="Proposta/Plano de Trabalho em Análise">Proposta/Plano de Trabalho em Análise</option>
										     								
										<option value="Prestação de Contas Rejeitada">Prestação de Contas Rejeitada</option>
										     								
										<option value="Prestação de Contas em Complementação">Prestação de Contas em Complementação</option>
										     								
										<option value="Prestação de Contas Aprovada">Prestação de Contas Aprovada</option>
										     								
										<option value="Assinado">Assinado</option>
							</select>	
							</label>
						<br><br>
						<button type='button' class='btn btn-default' style='width:100%;  text-align:center; padding-top:10px; width:100%; display:block; margin-right:10px; border-left:0; border-right:0; border-top:0;' id='conhecer'>
							<span class="fa-stack fa-lg">
								<i class="fa fa-circle fa-stack-2x" style='color:#E2EFE7'></i>
							  <i class="fa fa-search  fa-stack-1x " style='color:#333'></i>
							</span>
							 Buscar </button>
					</div>
					<!--div class='col-sm-6'>
						
						<fieldset class='form-control' style='overflow:hidden; height:auto; padding-bottom:62px'>
							<legend class='form-control legenda'>Entrar:</legend>
							
							<input type='text'  class='form-control' name='email' placeholder='Email' />
							<br />
							<input type='password'  class='form-control' name='senha' placeholder='Senha' style='margin-bottom:10px' />
							
							<label><input type='checkbox' name='anonimo' value='1' checked />&nbsp;Anônimo</label>
 						</fieldset>
					
					</div-->
				
				</form>
			</div>
		</div>
    
    
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="../js/jquery-1.12.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script>
	$( "#conhecer" ).click(function() {
		 if( $( "#estado :selected" ).val() != "" ){ // envia o form
			$( "#frm" ).submit()
		 } else { // alerta pra selecionar ao menos o estado
			alert('Informe o estado desejado.');
		 }	
	});		
	$( "#estado" ).change(function() {
		
		
	  if( $( "#estado :selected" ).val() != "" ){	  

			$( "#div_cidade" ).load( "ajax_cidade.php", { estado: $( "#estado :selected" ).val() }, function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					// se precisar algo no sucesso
				} 	
				if(statusTxt == "error"){
					// se precisar algo no erro -> alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
	  }
	});		
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
