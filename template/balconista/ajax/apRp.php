<?php

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract($_GET);

$sql = new Conexao();
$sql->conecta();

$temPeca = mysql_num_rows( $sql->consulta( "select * from pecasolicitada where idos=$idos" ) );

if( $temPeca >= 1 )
	$res = $sql->consulta( OS::apRp( $idos, 7 ) ) or die(mysql_error());
else
	$res = $sql->consulta( OS::apRp( $idos, 4 ) ) or die(mysql_error());

if( $res ){
	$success = TRUE;
	echo 1;
}else{
	$success = FALSE;
	echo 0;
}