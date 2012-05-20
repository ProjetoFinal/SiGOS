<?php 
include_once("../../dao/Conexao.class.php"); 
include_once("../../dao/OS.class.php"); 
?>
<div id="menu">
	<ul>
		<li><a href="index.php">ATENDER PEÇAS ( <?=OS::contadorOSAll(7)?> )</a></li>
		<li> | </li>
		<li><a href="fornecedor.php">FORNECEDORES</a></li>
		<li> | </li>
		<li><a href="peca.php">PEÇAS</a></li>
		<li> | </li>
		<li><a href="solicitacaopeca.php">SOLICITAÇÃO DE PEÇAS</a></li>
		<li> | </li>
		<li><a href="pecasolicitada.php">PEÇAS SOLICITADAS</a></li>
		<li> | </li>
		<!--
		<?php for($i=1; $i <= 5; $i++){ ?>
			<li class="menu1"><a href="#">Cadastro <?=$i?></a></li>
			<li> | </li>
		<?php } ?>
		-->
		<li style="float:right;">
			<a href="/SiGOS/template/function/logout.php" 
				style=" color:red;
					    font-weight: bold">
				Sair
			</a>
		</li> 
		<li style="float:right"> | </li> 
		<!--<li style="float:right">
			<a href="configuracoes.php">Configurações</a>
		</li>-->
	</ul>
</div>
