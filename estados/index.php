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

        <link rel="stylesheet" href="../css/jquery-ui.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap-theme/jquery-ui-1.9.2.custom.css">
        <link rel="stylesheet" href="../css/font-awesome.css">

        <link rel="stylesheet" href="../css/main.css">

        
        
        <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
      <body>
        <!-- Add your site or application content here -->
        
<form id="frmEstados" name="frmEstados"  method="post" enctype="multipart/form-data">
<input type="hidden" id="id_estados" name="id_estados" value=""/>
</form>        
        <header style="">
            <div id="divVoltar">
    	        <i class="fa fa-chevron-left fa-align-left" style="margin-left:13px; margin-top:13px; color:#FFF"></i>
            </div>
            <div id="divTitulo">
		        <h1 style="float:left">DENUNC.IO</h1>
            </div>
            <div id="divConfig">
        	    <i class="fa fa-cog fa-fw" style=" margin-top:13px; margin-right:13px; "></i>
            </div>            
        </header>
    	<article style="padding-top:40px">
              <?php
             require('../includes/menu.php');             
             ?>          	
            <div style="height:65px; width:320px; margin:0 auto; padding-top:1px;   font-size:1em; padding-left:0px; background:#FFC; position:fixed; z-index:9998">
                <h2 style='padding-left:0; margin-left:10px; line-height:1.4'>Informe o estado que deseja conhecer e fiscalizar os convênios e transferências da União.</h2>
            </div>
            
	        <ul class="lista" id="lista" style='margin-top:50px' data-role="listview">
<?php 
if($resultado){
	//echo count($resultado);	
	for($i=0; $i <= count($resultado) ; $i++) {  
		
		
		//$objProgramas = $gestor->retornarConveniosProgramas($resultado[$i]->sigla,'UF_PROPONENTE','convenios_programas');
		//$objProgramas = $gestor->retornarConveniosProgramas($pasta, 'UF_PROPONENTE','convenios_programas');
		$quantidade = 0;
		if ($objProgramas){
			$quantidade = count($objProgramas);
		}	
		
		
	?>                 
            	<li style='padding-top:22px; min-height:63px;' onclick="document.location.href='<?=strtolower($resultado[$i]->sigla)?>/';"><span style='float:left; margin-top:8px'><?=utf8_encode($resultado[$i]->nome)?><a style="display:none"><?=$util->removeAcentos($resultado[$i]->nome,1)?></a></span></li>
	  <?php 
	  
	} 

}
?>  
            </ul>
        </article>    
        <footer>
        </footer>

        <script src="../js/vendor/zepto.min.js"></script>
        <script src="../js/jquery-1.12.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
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
		
			function voltar(){
				document.location.href='../';
			}
		
		
		
		
            var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
            g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
            s.parentNode.insertBefore(g,s)}(document,"script"));
        </script>
    </body>
</html>
