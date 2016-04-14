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

extract($_POST);
$removerColuna = array('id');
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
		<!-- Preloader -->
		<div id="preloader">
			<div id="status">&nbsp;</div>
		</div>	  
		<?php
		require("../inc/navbar.php");
		?>
		<div class="container-fluid" style=''>
			<div class='row'>
				
				<form name='frm' id='frm' onsubmit='return false' method='post' enctype='multipart/form-data' >
					<div class='col-sm-12' id='resultado'>

	<label for='filtro' style='width:100%'>Filtrar:
	<input type='text' name='filtro' id='filtro' class='form-control search' placeholder='Informe o termo de seu interesse' /></label>

	<hr>
	        <ul class="lista list" id="lista" style='margin-top:10px' data-role="listview" >
			<?php 		

					
					if ($cidade) {
						if ($tx_modalidade) {
							$objConveniosProgramas = $gestor->retornarConveniosProgramas(array($estado,$cidade,$tx_modalidade),array('UF_PROPONENTE','NM_MUNICIPIO_PROPONENTE','TX_MODALIDADE'),'convenios_programas','NR_CONVENIO','DESC');						
						} else {
							$objConveniosProgramas = $gestor->retornarConveniosProgramas(array($estado,$cidade),array('UF_PROPONENTE','NM_MUNICIPIO_PROPONENTE'),'convenios_programas','NR_CONVENIO','DESC');						
						}
					} else {
						if ($tx_modalidade) {
							$objConveniosProgramas = $gestor->retornarConveniosProgramas(array($estado,$tx_modalidade),array('UF_PROPONENTE','TX_MODALIDADE'),'convenios_programas','NR_CONVENIO','DESC');						
						} else {
							$objConveniosProgramas = $gestor->retornarConveniosProgramas(array($estado),array('UF_PROPONENTE'),'convenios_programas','NR_CONVENIO','DESC');						
						}						
					
					}					
					
					if ($objConveniosProgramas){
						if (count($objConveniosProgramas) < 2){
							$objConveniosProgramas = array($objConveniosProgramas);
						}
					}				
					if($objConveniosProgramas){
							//echo count($resultado);	
							for($i=0; $i < count($objConveniosProgramas) ; $i++) {  	
								//if ($objConveniosProgramas[$i]->TX_SITUACAO != ""){				
							?>                 
								<li>
								<div style='display:block; margin-top:8px; max-width:97%; ' class=''>
									

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
									
									
									</div>								

								</div>
								<div style=" display:block; min-width:30px; padding-top:10px; min-height:30px; padding-right:10px ">
								
								<div class="btn btn-default" onclick="document.location.href='../convenios/?id=<?=$objConveniosProgramas[$i]->NR_CONVENIO?>'; return false"  style=' padding-top:10px; width:100%; display:block; margin-right:10px; border-left:0; border-right:0; border-top:0;	'>
								
								
								
								<small style=''>(<i class='fa fa-eye' style=''>10)</i>&nbsp;(<i class='fa fa-comment' style=''>3)</i></small>
								
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x" style='color:#E2EFE7'></i>
									<i class="fa fa-bullhorn  fa-stack-1x " style='color:#333'></i>
							  
								</span>
								Envolva-se
								</div>
								
								</div>
								
								
								
								</li>
							<?php 
								//}
							}
					} 					
			?>  

            </ul>
       
   


					</div>				
				</form>
			</div>
		</div>
    


   
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="../js/jquery-1.12.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>    
    <script src="../js/list.js"></script>
    <script>	
	$('frm').submit(function(){
		 return false;
	});		
	var options = {
	  valueNames: [ 'info-resultado','outras-resultado' ]
	};

	var resultado = new List('resultado', options);	
	
		
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

	<!-- Preloader -->
    //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(350).css({'overflow':'visible'});
        })
    //]]>
</script> 	
  </body>
</html>      
