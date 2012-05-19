<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta( OS::cancelarOs( $idos ) );
if($ok){
	echo "Ordem de Servico de nr. ".$idos." cancelada.
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=os.php'>";
}else{
	echo "Erro ao tentar assumir OS de nr. ".$idos."
		<script>$('#retornoErro').fadeOut(5000);</script>";	
}

sleep(1);