<?
ob_start();
session_start();
?>

<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>DENUNC.IO</title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

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

        <link rel="stylesheet" href="css/normalize.css">

        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme/jquery-ui-1.9.2.custom.css">
        <link rel="stylesheet" href="css/font-awesome.css">

        <link rel="stylesheet" href="css/main.css">

        
        
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        
    </head>
    <body style=''>
    <!-- Add your site or application content here -->
    <header style="">
      <div id="divVoltar">
    
            </div>
<div id="divTitulo">
		        <h1 style="float:left">DENUNC.IO</h1>
            </div>
            <div id="divConfig">
       	      
            </div>            
        </header>
    	<div id="pagina" style="padding-top:54px;background:#FFC; font-size:1.2em ">

  
 		<img src="img/dadosabertos.png" width="290" height="" alt="Prefeitura do Recife" style="margin-left:15px; display:block"> 
 <br>


<h2>Entenda</h2>
<p>As informações relacionados aos convênios e transferências do Governo no seu Estado.
</p>
<h2>Fiscalize</h2>
<p>
	 Avalie, comente, envie fotos, compartilhe nas redes sociais e realize a fiscalização dessas execuções.
</p>
    <h2>Envolva-se</h2>
<p>Sendo um fiscal nas execuções das políticas públicas você esta colaborarando para um país menos corrupto.
</p>
<a class="large button blue" style='min-width:290px; display:block' href="estados/">ENTRAR</a>

<div id="status">
</div>



        <footer>
    </footer>


        <script src="js/vendor/zepto.min.js"></script>
        <script src="js/jquery-1.12.1.min.js"></script>
         <script src="js/bootstrap.min.js"></script>
        <script src="js/helper.js"></script>


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
    </body>
</html>
