<?php

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract($_GET);

$sql = new Conexao();
$sql->conecta();

$res = $sql->consulta( OS::reabrirOs( $idos ) ) or die(mysql_error());

if( $res ){
	$success = TRUE;
	echo 1;
}else{
	$success = FALSE;
	echo 0;
}