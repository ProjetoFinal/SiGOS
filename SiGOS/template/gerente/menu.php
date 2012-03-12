<div id="menu">
	<ul>
		<?php for($i=1; $i <= 5; $i++){ ?>
			<li class="menu1"><a href="#">Cadastro <?=$i?></a></li>
			<li> | </li>
		<?php } ?>
		<li style="float:right;">
			<a href="/SiGOS/template/function/logout.php" 
				style=" color:red;
					    font-weight: bold">
				Sair
			</a>
		</li> 
		<li style="float:right"> | </li> 
		<li style="float:right">
			<a href="configuracoes.php">Configurações</a>
		</li>
	</ul>
</div>
