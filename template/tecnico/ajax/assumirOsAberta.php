<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta( OS::assumirOs( $_SESSION['idusuario'], $idos, $idstatus ) );
if($ok){
	echo "OS nr. ".$idos." assumida pelo usuario ".$_SESSION['nome'].".
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>";
				if( $idstatus == 2 )
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=analTec.php'>";
				else
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=manut.php'>";
}else{
	echo "Erro ao tentar assumir OS de nr. ".$idos."
		<script>$('#retornoErro').fadeOut(5000);</script>";	
}

sleep(1);