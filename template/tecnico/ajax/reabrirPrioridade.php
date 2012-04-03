<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta( OS::reabrirPrioridade( $_SESSION['idusuario'], $idos ) );
if($ok){
	echo "OS nr. ".$idos." reaberta.
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>
				<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=assumidas.php'>";
}else{
	echo "Erro ao tentar reabrir OS de nr. ".$idos."
		<script>$('#retornoErro').fadeOut(5000);</script>";	
}

sleep(1);