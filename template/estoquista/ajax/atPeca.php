<?php

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract($_GET);

$sql = new Conexao();
$sql->conecta();

$sql->consulta( "select * from pecasolicitada where idos=$idos" );

while( $l = $sql->resultado() ){

	$idpeca = $l['idpeca'];
	$qtdsolicitada = $l['qtdsolicitada'];

	$r = mysql_fetch_array( mysql_query( "select * from peca where idpeca=$idpeca" ) );

	if( $qtdsolicitada > $r['quantidade'] ){
		$nome[] = $r['nomepeca'];
	}else{
		$idp[] = $idpeca;
		$qtdS[] = $qtdsolicitada;
		$qtdA[] = $r['quantidade'];
	}

}

if( empty($nome) ){
	
	for($i=0;$i<sizeof($idp);$i++){
		$qtdFinal = $qtdA[$i] - $qtdS[$i];
		$id = $idp[$i];
		$decrementar = $sql->consulta( "update peca set quantidade=$qtdFinal where idpeca=$id" );
	}

	if( $decrementar ){
		$sql->consulta( "update ordemdeservico set idstatus=4 where idordemdeservico=$idos" );
		$success = TRUE;
		echo 1;
	}else{
		$success = FALSE;
		echo 2;	
	}
}else{
	$success = FALSE;
	for($i=0;$i<sizeof($nome);$i++){
		if( sizeof($nome) == 1 )
			echo $nome[$i];
		else
			echo $nome[$i].", ";
	}
}
