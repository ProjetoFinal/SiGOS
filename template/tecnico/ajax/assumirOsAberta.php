<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta( OS::assumirOsAberta( $_SESSION['idusuario'], $idos ) );
if($ok){
	echo "OS nr. ".$idos." assumida pelo usuario ".$_SESSION['nome'].".
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>
				<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=abertas.php'>";
}else{
	echo "Erro ao tentar assumir OS de nr. ".$idos."
		<script>$('#retornoErro').fadeOut(5000);</script>";	
}

sleep(1);