<?php 

function __autoload($class){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

if( empty($solucao) ){
	echo 2;
	
}else{
	
	$sql = new Conexao();
	$sql->conecta();

	if( $sql->consulta( OS::finalizarManutencao( $idos, $solucao ) ) ){
		$success = TRUE;
		echo 1;
	}else{
		$success = FALSE;
		echo 0;
	}

}