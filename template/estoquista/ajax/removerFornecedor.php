<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );


$sql = new Conexao();
$sql->conecta();

$compra = $sql->consulta( Compra::verificarCompraFornecedor( $idfornecedor ) );
$verCompra = mysql_num_rows( $compra );

if( $verCompra >= 1){

	echo "Existem Compras associadas ao Fornecedor. O Fornecedor não poderá ser removido.
				<script>$('#retornoErro').fadeOut(5000);</script>";
		
}else{
	
	$ok = $sql->consulta ( Fornecedor::removerId( $idfornecedor ) );

	if($ok){
		echo "*Fornecedor Removido com sucesso
			<script>
				$(window.document.location).attr('href','fornecedor.php');
			</script>";
	}else{
		echo "Erro ao remover Fornecedor
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}

}

sleep(1);