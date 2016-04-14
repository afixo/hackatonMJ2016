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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
		<div class="container" style=''>
			<div class='row'>
				
			
					<div class='col-sm-12' style=''>
						<h4 class='sobre-h4'>Entenda</h4>
						<div class='sobre-div-informacoes'>
							<div class="well" style=''><i class='fa fa-info fa-2x' style='margin-left:10px'></i></div>						
							<p class='entenda'>As informações relacionados aos convênios e transferências do Governo no seu Estado.</p>
						</div>
						<h4 class='sobre-h4'>Envolva-se</h4>
						<div class='sobre-div-informacoes'>
							<div class="well" style=' '><i class='fa fa-bullhorn fa-2x' style='margin-left:0px'></i></div>						
							<p style=''>Avalie, comente, envie fotos, compartilhe nas redes sociais e realize a fiscalização dessas execuções.</p>
						</div>
						
						<h4 class='sobre-h4'>Fiscalize</h4>
						<div class='sobre-div-informacoes'>
							<div class="well" style=''><i class='fa fa-pencil fa-2x' style='margin-left:4px'></i></div>						
							<p style=''>Sendo um fiscal nas execuções das políticas públicas você esta colaborarando para um país menos corrupto.</p>
						</div>						
						
						<button class='btn btn-primary sobre-btn' style='width:100%; text-align:center'> ENTRAR </button>
					</div>
					
			</div>
		</div>
    
    
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="../js/jquery-1.12.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script>
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
