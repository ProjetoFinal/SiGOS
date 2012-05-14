<?php

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract($_GET);

$sql = new Conexao();
$sql->conecta();

$cont = 0;
$qtd = $sql->consulta("select * from comprapeca where datapedido='$datapedido'");
while( $r = $sql->resultado() ){
	if( $r['qtd'] == 0 ){
		$cont++;
	}
}

if( $cont == 0 ){

	$res = $sql->consulta( Compra::finalizar( $datapedido ) );

	if( $res ){
		$success = TRUE;
		echo 1;
	}else{
		$success = FALSE;
		echo 2;	
	}

}else{
	$success = FALSE;
	echo 3;	
}
