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

require('../../classes/gestor.php');
$util = new Util();
$gestor   = new Gestor();

extract($_GET);
extract($_POST);
$removerColuna = array('id');


//var_dump($_POST);

$arrayUrl = explode("/", $_SERVER['REQUEST_URI']);
$pasta = $arrayUrl[count($arrayUrl)-2];



if ($id_orgaos){
	$resultado = $gestor->retornarProgramas(array($pasta,'DISPONIBILIZADO',$id_orgaos),array('UF_HABILITADA','TX_SITUACAO_PROGRAMA','CD_ORG_SUPERIOR'),'programas');
	if ($resultado){
		if (count($resultado) < 2){
			$resultado = array($resultado);
		}
	}
}
//var_dump($resultado);
?>
<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--><html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>DENUNC.IO</title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../img/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../img/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../img/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../../img/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="../../img/touch/apple-touch-icon.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="../../img/touch/apple-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#222222">


        <!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
        <!--
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="">
        -->

        <!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
        <!--
        <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
        -->

        <link rel="stylesheet" href="../../css/normalize.css">

        <link rel="stylesheet" href="../../css/jquery-ui.css">
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link rel="stylesheet" href="../../css/bootstrap-theme/jquery-ui-1.9.2.custom.css">
        <link rel="stylesheet" href="../../css/font-awesome.css">

        <link rel="stylesheet" href="../../css/main.css">

        
        
        <script src="../../js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
      <body>
        <!-- Add your site or application content here -->
        
        
        <header style="">
			<?php 
			if($NM_ORGAO_SUPERIOR){
			?>
            <div id="divVoltarLocal" onclick="document.location.href='../<?=$pasta?>'">
    	        <i class="fa fa-chevron-left fa-align-left" style="margin-left:13px; margin-top:13px; color:#FFF"></i>
            </div>			
			<?php 
			} else {
			?>				
            <div id="divVoltarLocal" onclick='history.back();'>
    	        <i class="fa fa-chevron-left fa-align-left" style="margin-left:13px; margin-top:13px; color:#FFF"></i>
            </div>
			<?php 
			} 
			?>	            
            <div id="divTitulo">
		        <h1 style="float:left">DENUNC.IO</h1>
            </div>
            <div id="divConfig">
        	    <i class="fa fa-search fa-fw" style=" margin-top:13px; margin-right:13px; "></i>
            </div>            
        </header>
    	<article style="padding-top:40px">
              <?php
             require('../../includes/menu.php');             
             ?>          	
            <div style="height:65px;  overflow:hidden; width:320px; margin:0 auto; padding-top:8px; background:#FFC; position:fixed; z-index:9998">
                <div style='font-weight:bold; font-size:1.2em; padding-left:10px; padding-top:0px; padding-right:5px;'>
					<form id="frmConveniosProgramas" name="frmConveniosProgramas" action="" method="post" enctype="multipart/form-data">
					
					<?php
					if (!$NM_MUNICIPIO_PROPONENTE){	
						echo 'Informe a cidade que deseja conhecer e fiscalizar os convênios e transferências da União.<span style="color:#5D9CC1; float:right;"><small style="padding-right:5px; padding-top:5px">'.$gestor->retornarEstados($pasta,'sigla')->nome.'</small></span>';
					} else {					
						echo 'Selecione o convênios e transferências da União que deseja conhecer e fiscalizar. <span style="color:#5D9CC1; float:right; padding-right:5px; padding-top:5px"><small style="padding-right:5px; padding-top:5px">'. ucfirst(strtolower($NM_MUNICIPIO_PROPONENTE)) . ', '.$gestor->retornarEstados($pasta,'sigla')->nome.'</small></span>';
				    }
					?>														
						<input type="hidden" id="NM_MUNICIPIO_PROPONENTE" name="NM_MUNICIPIO_PROPONENTE" value="<?=$NM_MUNICIPIO_PROPONENTE?>"/>
					 												
						<input type="hidden" id="NM_ORGAO_SUPERIOR" name="NM_ORGAO_SUPERIOR" value="<?=$NM_ORGAO_SUPERIOR?>"/>
					</form>

				</div>
                
            </div>
            
	        <ul class="lista" id="lista" style='margin-top:60px' data-role="listview" >
			<?php 		
			if(!$NM_ORGAO_SUPERIOR){
			
				if($NM_MUNICIPIO_PROPONENTE){ // se o municipio foi selecionado
					
					
					$objConveniosProgramas = $gestor->retornarConveniosProgramas(array($pasta,$NM_MUNICIPIO_PROPONENTE),array('UF_PROPONENTE','NM_MUNICIPIO_PROPONENTE'),'convenios_programas','NR_CONVENIO','DESC');
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
								<li onclick="document.location.href='../../convenios/?id=<?=$objConveniosProgramas[$i]->NR_CONVENIO?>'">
								<div style='display:block; margin-top:8px; max-width:80%; '><b><?=$objConveniosProgramas[$i]->NR_CONVENIO?> / <?=utf8_encode($objConveniosProgramas[$i]->TX_MODALIDADE)?><br />
								
								
								<?php
													
								
								if ($objConveniosProgramas[$i]->TX_SITUACAO){
									echo (utf8_encode($objConveniosProgramas[$i]->TX_SITUACAO) . " <br />");
								}
								
								for($j = 0; $j < 6; $j++){
									?>
									<i class="fa fa-star-o" style="margin-right:1px;  color:#c7514d"></i>
									<?php					
								}
								
								
								?><br>
								<?=$objConveniosProgramas[$i]->DT_INICIO_VIGENCIA?> até <?=$objConveniosProgramas[$i]->DT_FIM_VIGENCIA?><br /><?=$objConveniosProgramas[$i]->VL_GLOBAL?><br />
								</b><?=utf8_encode($objConveniosProgramas[$i]->TX_OBJETO_CONVENIO)?><br />
								
								<small><b><?=utf8_encode($objConveniosProgramas[$i]->NM_PROPONENTE)?></b></small><br />
								<small><b><?=utf8_encode($objConveniosProgramas[$i]->NM_ORGAO_SUPERIOR)?></b></small>
								</div>
								
								<div style=" display:block; min-width:30px; padding-top:10px; min-height:30px; padding-right:10px ">
								
								<a class="btn btn-success" href="../../convenios/?id=<?=$objConveniosProgramas[$i]->NR_CONVENIO?>"   style='padding-top:5px; width:100%; display:block; margin-right:10px;	'>
									Conhecer <i class="fa fa-plus"></i> Fiscalizar
								</a>
								
								</div>
								
								
								
								</li>
							<?php 
								//}
							}
					} 					
					
					

				} else { // se o municipio nao foi selecionado, exibir os estados
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
				}
			}	
			?>  

            </ul>
        </article>    
        <footer>
        </footer>

        <script src="../../js/vendor/zepto.min.js"></script>
        <script src="../../js/jquery-1.12.1.min.js"></script>
         <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/helper.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
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
		
			function voltar(){
				document.location.href='../';
			}
		
		    function buscarProgramas(municipio, orgao){
				$("#NM_MUNICIPIO_PROPONENTE").val(municipio);
				//if (orgao > 0){ 
					$("#NM_ORGAO_SUPERIOR").val(orgao);
				//}	
				//document.frmProgramas.action = '?id_orgaos='+orgao;
				document.frmConveniosProgramas.submit();
			}
		
		
            var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
            g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
            s.parentNode.insertBefore(g,s)}(document,"script"));
        </script>
    </body>
</html>
