<?php 

function __autoload($class){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$res = $sql->consulta( OS::attAcompanhamento( $idos, $acompanhamento ) ) or die(mysql_error());

if( $res ){
	$success = TRUE;
	echo 1;
}else{
	$success = FALSE;
	echo 0;
}
