<?php
session_start();

function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$verificaUsuarioEmOs = $sql->consulta( Usuario::verificaUsuarioEmOs( $idUsuario ) );
$verUsuario = mysql_num_rows( $verificaUsuarioEmOs );

if( $verUsuario >= 1 ){
	echo "Existem Ordens de Serviço associadas ao cliente o mesmo não poderá ser removido.
				<script>$('#retornoErro').fadeOut(5000);</script>";
} else {
	$ok = $sql->consulta ( Usuario::removerUsuario( $idUsuario ) );

	if($ok){
		echo "*Removido com sucesso
			<script>
				$(window.document.location).attr('href','usuario.php');
			</script>";
	}else{
		echo "Erro ao remover Usuario
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}
}

sleep(1);