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

$removerColuna = array('id');
$objeto = $gestor->retornarLocais($id_locais);

$resultado = $gestor->retornarVisitas($id_locais,'id_locais','visitas','data_hora','DESC');
//var_dump($resultado);
	if ($resultado){
		if (count($resultado) < 2){
			$resultado = array($resultado);
		}
		
		
		$total = count($resultado);
		
		$totalEstrelas = 0;
		foreach($resultado as $o){
			
			$totalEstrelas = $totalEstrelas + $o->avaliacao;
		}
		
		$media = $totalEstrelas/$total;
		$arrayMedia = explode(".",$media);
		$mediaInteira = $arrayMedia[0];
		//echo $totalEstrelas;		
		
	}


$bases = $gestor->retornarBases($objeto->id_bases)->nome;

?>
<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Minha cidade</title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../img/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../img/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="../img/touch/apple-touch-icon.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
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

        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/font-awesome.css">
		<link rel="stylesheet" href="../js/jquery.rating.css" />
        <link rel="stylesheet" href="../css/redmond/jquery-ui-1.10.3.custom.css">
        
        <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
        <script type="text/javascript">

		
		function initialize() {
		  var mapOptions = {
			zoom: 17,
			center: new google.maps.LatLng(<?=$objeto->latitude?>, <?=$objeto->longitude?>),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  }
		  var map = new google.maps.Map(document.getElementById('mapa'),
										mapOptions);
		
		  var image = 'images/beachflag.png';
		  var myLatLng = new google.maps.LatLng(<?=$objeto->latitude?>, <?=$objeto->longitude?>);
		  var beachMarker = new google.maps.Marker({
			  position: myLatLng,
			  map: map
		  });
		  
		  
		  var mapOptions = {
			zoom: 7,
			center: new google.maps.LatLng(<?=$objeto->latitude?>, <?=$objeto->longitude?>),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  }
		  var map = new google.maps.Map(document.getElementById('mapaProximos'),
										mapOptions);
		
		  var image = 'images/beachflag.png';
		  var myLatLng = new google.maps.LatLng(<?=$objeto->latitude?>, <?=$objeto->longitude?>);
		  var beachMarker = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  icon: image
		  });  
		}
		
		
		</script>
    </head>
    <body>
    <!-- Add your site or application content here -->
 
    
<form id="frmLocais" name="frmLocais" method="post" enctype="multipart/form-data" action="../localidades/">
<input type="hidden" id="id_bairros" name="id_bairros" value=""/>
<input type="hidden" id="id_bases" name="id_bases" value=""/>
<input type="hidden" id="id_locais" name="id_locais" value=""/>

</form>   
<form id="frm" name="frm" method="post" enctype="multipart/form-data" >   
    <header style="">
      <div id="divVoltarLocal" onclick="voltar(<?=$objeto->id_bases;?>,<?=$objeto->id_bairros;?>);">
    <i class="fa fa-chevron-left fa-align-left" style="margin-left:13px; margin-top:13px;"></i>
            </div>
<div id="divTitulo">
		        <h1 style="float:left">
					<?php					
					if ( strlen($bases) >= 24){
						$exibeBase = substr($bases,0,21) . "...";
					} else {
						$exibeBase = $bases;
					}
					echo ucfirst($exibeBase);		
					?>
				</h1>
            </div>
            <div id="divConfig">
       	      <i class="fa fa-cog fa-fw" style=" margin-top:13px; margin-right:13px; "></i>
            </div>            
        </header>
    	<div id="pagina">
             <?php
             require('../includes/menu.php');              
             ?>  			
             <div style="width:99%; height:130px; background:#FFF; border:1px solid #333; overflow:hidden">             
				 <img src="../img/cidade2.jpg" style='width:320px; margin-top:-30px; float:left' />
				 <div style='position:relative;  height:25px; margin-right:10px; margin-top:-70px; float:right; color:#FFF; width:250px; margin-right:5px'>
					 
					 <div class='btnImagens' style='width:65px; height:25px; float:right;'>
						<i class="fa fa-camera" style=" margin-top:5px; margin-left:7px; font-size:0.9em"></i>
						<span style='font-size:0.7em'>Enviar</span>					
					 </div>             
					 
					 <div class='btnImagens' style='width:100px; height:25px; float:right; margin-right:10px;'>
						<i class="fa fa-picture-o" style=" margin-top:5px; margin-left:7px; font-size:0.9em"></i>
						<span style='font-size:0.7em'>Nenhuma foto</span>					
					 </div>             				 
				 </div>
				 
             </div>
             
             
             
			<span style="margin-left:7px;">
			<?php
			if ($resultado){
				
				for($i = 0; $i < $mediaInteira; $i++){
					?>
					<i class="fa fa-star" style="margin-right:1px; margin-top:13px; color:#c7514d"></i>
					<?php					
				}
				
				if($arrayMedia[1]){
				?>
				<i class="fa fa-star-half-o" style="margin-right:1px; margin-top:13px; color:#c7514d"></i>
				<?php
				}
			}
			?>
			<h1 style='margin:0 padding:0; text-align:left; margin-left: 7px; line-height:1em; 
			display:block; overflow:hidden; min-height:30px; margin-top:0px'>
			<?php					
			$exibeLocal = strtolower($objeto->local);
			echo ucfirst($exibeLocal);		
			?>
			</h1>
			</span>			
        <span style="font-size:0.9em;  margin-left:7px; display:block">
			<? echo(ucfirst(strtolower($objeto->endereco)));?>
        <? if($objeto->telefone) { ?>
		<? echo('<br />'.$objeto->telefone);?>
		<? } ?>
		<? if($objeto->site) { ?>
		<? echo('<br />'.$objeto->site);?>
		<? } ?>        
        
        </span>
			<div style="border:1px solid #999; width:96%; height:290px; display:block; margin:0 auto; margin-top:20px;" id="mapa">
            
            </div>
    <div style="width:95%; margin:0 auto;">
    
     
     <hr />
     <?php
     	if (!isset($_SESSION['MINHACIDADE_codigo'])) {
	?>
	
	
	<?php
	} else {
	?>		
     
     
     <h3>Qual a sua avaliação do local?</h3>
    <p style="display:block; clear:left; text-align:left; padding-bottom:15px;">    
    <input name ="avaliacao_nota" id="avaliacao_nota" type="radio" class="star" value="1" checked="checked" />
    <input name ="avaliacao_nota" id="avaliacao_nota" type="radio" class="star" value="2" />
    <input name ="avaliacao_nota" id="avaliacao_nota" type="radio" class="star" value="3" />
    <input name ="avaliacao_nota" id="avaliacao_nota" type="radio" class="star" value="4" />
    <input name ="avaliacao_nota" id="avaliacao_nota" type="radio" class="star" value="5" />                
    </p>
    <input name ="local" id="local" type="hidden" class="" value="<?=$id_locais?>" />  
    <input name ="operacao" id="operacao" type="hidden" class="" value="inserir" />  
     <input name ="avaliacao" id="avaliacao" type="hidden" class="" value="1" />  
    <p style="display:block; clear:left;  margin:0 ; text-align:left; margin-top:15px;"> 
    <label for="opiniao">Você tem algum comentário a fazer a respeito da visita?</label>
    <textarea id="opiniao" name="opiniao" style="width:99%; margin-left:0px; margin-top:20px; height:100px; min-height:100px; max-height:100px; margin-bottom:10px; display:block"></textarea>
    <a class="large button blue" href="javascript:void(0);" onClick='avaliar()' style="width:275px; margin:0" >Avaliar</a>
    </p>        
     <hr />   
     
    <? } ?>  
    <h3>Últimas Avaliações</h3>


    <?php

	
    
    
    if ($resultado){
		$escreveu = false;
		foreach($resultado as $obj) {
			if ($obj->opiniao){
			$escreveu = true;
			?>
			 <p style="text-align:left; margin:0">
				<strong><?=$util->retornaData($obj->data_hora,'br')?> <?=substr($obj->data_hora,11)?></strong>
				<br />
				<?=$obj->opiniao?>
				<hr />
			</p>
			<? 
			}
		}
		if ($escreveu == false){
			?> 
			<p style="text-align:left; margin:0">
			Nenhuma avaliação encontrada.
			<br />
			<strong>Seja o primeiro.</strong>
			</p>
			<?
		}
    
    } else { ?> 
    <p style="text-align:left; margin:0">
    Nenhuma avaliação encontrada.
    <br />
    <strong>Seja o primeiro.</strong>
    </p>
    <? } ?> 
        



     
    
	</div>
    
    
    <div style="width:250px; height:80px; max-width:250px; max-height:80px; display:block; margin:0 auto; margin-top:70px;">
    </div>
    </form> 
        </div>    
        <footer>
    </footer>
		<script src="../js/vendor/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=false&language=en"></script>
		<script type="text/javascript" src="../js/jquery.rating.js"></script>
        <script src="../js/vendor/zepto.min.js"></script>
        <script src="../js/vendor/jquery-ui-1.10.3.custom.js"></script>
        <script src="../js/helper.js"></script>

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
            var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
            g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
            s.parentNode.insertBefore(g,s)}(document,"script"));
        </script>
        <script type="text/javascript">
			
$('.star').rating({ callback: function(value, link){ 
	$("#avaliacao").val(value);	
	} }); 			

		var createGMapFromAddress = function(address, gmap_id, map_options){
		map_options = (map_options) ? map_options : {
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		},                                
		map = new google.maps.Map(document.getElementById(gmap_id), map_options),
		geoclient = new google.maps.Geocoder();                                
		geoclient.geocode({'address': address}, function(results, status){
			if(status == google.maps.GeocoderStatus.OK){
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map, 
					position: results[0].geometry.location,
					title : address                       
				});
			} 
		});  
	};
		
		
function avaliar(){
			var titulo = '';
			var quantidadeErros = 0;
			var mensagem = '';	
			if (quantidadeErros>0){
				if (quantidadeErros>1){
					titulo = 'Erros:';			
				} else {
					titulo = 'Erro:';
				}
				var $dialog = $('<div></div>').append(mensagem);
					$dialog.dialog({
					bgiframe: true,
					modal: true,
					title:titulo,
					resizable:false,
					minWidth: 180,
					buttons: {
						"OK": function() {					
							$(this).dialog( "close" );	
							return false;				
						}
					}				
					});	

			 } else {
				 
				$.post('process.php',$('#frm').serialize(),
						
				   function(data){					   
										
					   if(data > 0){ // 1 ou maior 
										
						   titulo = 'Sucesso';				
						   mensagem = 'Avaliação gravada com sucesso.';
						   $('#opiniao').val('');
							var $dialog = $('<div></div>').append(mensagem);
							$dialog.dialog({
							bgiframe: true,
							modal: true,
							title:titulo,
							resizable:false,
							minWidth: 180,
							buttons: {
								"OK": function() {					
									location.reload();			
								}
							},
							close: function() {
							  location.reload();	
							}				
							});							   
						   
										
					   } else { //erro
										
						   titulo = 'Erro';										
						   mensagem = 'Não foi possível avaliar o local.';
						   
							var $dialog = $('<div></div>').append(mensagem);
							$dialog.dialog({
							bgiframe: true,
							modal: true,
							title:titulo,
							resizable:false,
							minWidth: 180,
							buttons: {
								"OK": function() {					
									$(this).dialog( "close" );	
									return false;				
								}
							}				
							});							   
										
					   }	
					   
					   
					   
					   
					   });	 
				 
				 
			 }			
			
			
		}		
		
		<?php
		
		if ($objeto->latitude > 0 && $objeto->longitude > 0){ 
			?>
		
			google.maps.event.addDomListener(window, 'load', initialize);
		
			<?php
		} else {
		?>
		createGMapFromAddress('<? echo($objeto->endereco)?>, Recife - Pernambuco', 'mapa');
		
		<?php
		}
		?>
		</script>
    </body>
</html>
