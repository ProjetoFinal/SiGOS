<?php

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract($_GET);

$sql = new Conexao();
$sql->conecta();

$res = $sql->consulta( Compra::finalizar( $datapedido ) );

if( $res ){
	$success = TRUE;
	echo 1;
}else{
	$success = FALSE;
	echo 2;	
}
