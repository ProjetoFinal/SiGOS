<?php 

function __autoload($class){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

if( $sql->consulta( Orcamento::attComentarios( $idor, $comentarios ) ) ){
	$success = TRUE;
	echo 1;
}else{
	$success = FALSE;
	echo 0;
}