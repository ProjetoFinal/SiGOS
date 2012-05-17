<?php 
include_once("../../dao/Conexao.class.php"); 
include_once("../../dao/OS.class.php"); 
?>
<div id="menu">
	<ul>
		<li><a href="index.php">Atender Peças ( <?=OS::contadorOSAll(7)?> )</a></li>
		<li> | </li>
		<li><a href="fornecedor.php">Fornecedores</a></li>
		<li> | </li>
		<li><a href="peca.php">Peças</a></li>
		<li> | </li>
		<li><a href="solicitacaopeca.php">Solicitacao de Peças</a></li>
		<li> | </li>
		<li><a href="pecasolicitada.php">Peças Solicitadas</a></li>
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
