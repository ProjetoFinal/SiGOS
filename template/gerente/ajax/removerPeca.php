<?php
session_start();

function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$verificaEstoquePeca = $sql->consulta( Peca::verificaEstoquePeca( $idpeca ) );
$verPeca = mysql_num_rows( $verificaEstoquePeca );

if( $verPeca >= 1 ){
	echo "Peça com quantidade em estoque.
				<script>$('#retornoErro').fadeOut(5000);</script>";
}

/*
 * 
 * Implementar métodos de consultar peça em orçamento e peça solicitada
	
	
	*
*/ 

else {
	$ok = $sql->consulta ( Peca::removerPeca( $idpeca ) );

	if($ok){
		echo "*Cadastro removido com sucesso
			<script>
				$(window.document.location).attr('href','usuario.php');
			</script>";
	}else{
		echo "Erro ao remover cadastro
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}
}

sleep(1);