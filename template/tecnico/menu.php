<div id="menu">
	<ul>
		<!--
			Em Aberto
		-->
		<li><a href="abertas.php">ABERTAS ( <?=OS::contadorOS(1, $_SESSION['idusuario'])?> )</a></li>
		<li> | </li>
		<!--
			Orçamento Aprovado
		-->
		<li><a href="aprovadas.php">APROVADAS ( <?=OS::contadorOS(4, $_SESSION['idusuario'])?> )</a></li>
		<li> | </li>
		<!--
			Em Análise Técnica + Em Manutenção
		-->
		<li><a href="assumidas.php">ASSUMIDAS ( <?=OS::contadorOS(2, $_SESSION['idusuario']) + OS::contadorOS(6, $_SESSION['idusuario'])?> )</a></li>
		<li> | </li>
		<!--
			Aguardando Aprovação
		-->
		<li><a href="orcamento.php">ORÇAMENTO ( <?=OS::contadorOS(3, $_SESSION['idusuario'])?> )</a></li>
		<li> | </li>
		<!--
			Reabertas
		-->
		<?php if( OS::contadorOS(9, $_SESSION['idusuario']) > 0 ){	?>
			<style>span.prioridade{ color: red; }</style>
		<?php } ?>
		<li>
			<a href="prioridade.php">PRIORIDADE ( <span class="prioridade"><?=OS::contadorOS(9, $_SESSION['idusuario'])?></span> )</a>
		</li>

		<!--
			Configurações e Sair
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
