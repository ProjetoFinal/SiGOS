<?php

function __autoload( $class )
{
	include_once("../../../dao/$class.class.php");
}

extract( $_POST );

$sql = new Conexao();
$sql->conecta();

$sql->consulta( Pagamento::pagar( $_POST ) )  or die(mysql_error());

$res = $sql->consulta( OS::apRp( $idos, 10 ) ) or die(mysql_error());

if( $res ){
	echo "
		<script>
		window.open('../cupom.php?idos=".$idos."','Janela','width=520, height=600');
		window.opener.document.location.reload();
		window.close();
		</script>
	";
}else{
	$success = FALSE;
	echo 0;
}