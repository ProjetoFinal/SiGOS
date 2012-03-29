<?php 

function __autoload($class){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$verificarQtd = $sql->consulta( PecaSolicitada::consultaPorId( $idpecasolicitada ) );
$p = $sql->resultado();

if( $p['qtdsolicitada'] > 1 ){

	$menosUm = $sql->consulta( PecaSolicitada::addMaisUm( $idpecasolicitada, $qtd ) );

	if($menosUm){
		$sql->consulta( Orcamento::valorPecaUsada( $idor ) );
		$v = $sql->resultado();

		$valorFinal = $v['valorpecasusadas'] - $valor;

		$sql->consulta( Orcamento::updateValorPecasUsadas( $idor, $valorFinal ) );

		$success = TRUE;
		echo 1;
	}else{
		$success = FALSE;
		echo 0;
	}
}else{
	$delete = $sql->consulta( PecaSolicitada::menosUm( $idpecasolicitada ) );

	if($delete){
		$sql->consulta( Orcamento::valorPecaUsada( $idor ) );
		$v = $sql->resultado();

		$valorFinal = $v['valorpecasusadas'] - $valor;

		$sql->consulta( Orcamento::updateValorPecasUsadas( $idor, $valorFinal ) );

		$success = TRUE;
		echo 1;
	}else{
		$success = FALSE;
		echo 0;
	}
}
