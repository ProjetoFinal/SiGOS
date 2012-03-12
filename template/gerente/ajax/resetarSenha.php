<?php
session_start();

function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta( Usuario::resetarSenhaUsuario( $idUsuario ) );

if($ok){
		echo "*Senha resetada com sucesso
			<script>
				alert('Senha padrão: PP@ssword12. Favor alterar no primeiro logon!');
				$(window.document.location).attr('href','usuario.php');
			</script>";
	}else{
		echo "Erro ao resetar a senha do usuário
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}

sleep(1);