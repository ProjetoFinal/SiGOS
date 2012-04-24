<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$res = $sql->consulta( Compra::novo( $idpeca ) );

if($res)
	echo "Peça adicionada à lista de Compras <script>$('#retornoErro').fadeOut(5000); window.location='pecasolicitada.php';</script>";
else
	echo "Erro ao adicioar Peça à lista de Compras <script>$('#retornoErro').fadeOut(5000);</script>";

sleep(1);
