<div class="menu">
	<?php
	if (!isset($_SESSION['MINHACIDADE_codigo'])) {
	?>
		<ul>
		<li> <a href="../idioma.php" class="linkUser">Idioma</a></li>
		<li><a href="../usuarios/" class="linkUser">Identificar me (entrar)</a> </li><li> <a href="../usuarios/cadastro.php" class="linkUser">Sou novo aqui (cadastrar)</a></li> <li> <a href="../usuarios/esqueci.php" class="linkUser">Esqueci minha senha</a></li>
		<li> <a href="../sobre.php" class="linkUser">Sobre</a></li>
		</ul>
	<?php
	} else {
	?>		
		<ul>
		
		<li><a href="../usuarios/dados.php" class="linkUser">Meus dados</a></li> 
		<li><a href="../usuarios/avaliacoes.php" class="linkUser">Minhas avaliações</a></li>
		<li><a href="../usuarios/fotos.php" class="linkUser">Minhas fotos</a></li>	
		<li><a href="../sobre.php" class="linkUser">Sobre</a></li>
		<li><a href="../usuarios/sair.php" class="linkUser">Sair</a> </li>
		</ul> 
	<?php
	}
	?>	
 </div>
