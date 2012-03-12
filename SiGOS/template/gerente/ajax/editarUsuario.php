<?php
session_start();

function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$count = 0;

if( empty( $nome ) ){
	$msgNome = "*Preencha com o nome do usuário<br />
						<script>
							$('#nome').css('background','#FBE3E4');
							$('#nome').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $login ) ){
	$msgLogin = "*Preencha com o login do usuário<br />
						<script>
							$('#login').css('background','#FBE3E4');
							$('#login').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $nivel ) ){
	$msgNivel = "*Selecione o nível do usuário<br />
						<script>
							$('#nivel').css('background','#FBE3E4');
							$('#nivel').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $status ) ){
	$msgStatus = "*Selecione o status do usuário<br />
						<script>
							$('#status').css('background','#FBE3E4');
							$('#status').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}



if( $count >= 1){
print <<<ERRO
$msgNome
$msgLogin
$msgNivel
$msgStatus
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();

$usuario = new Usuario( $_GET );

$ok = $sql->consulta ( $usuario->editarUsuario( $idUsuario ) );

	if($ok){ 
				
			echo "Editado com sucesso
						<script>
							$('#retornoErro').fadeOut(5000);
							$('input[type=text]').val('');
							$('input[type=password]').val('');
							$('select').val('');
							$(window.document.location).attr('href','usuario.php');
						</script>";

			}else{
				echo "Erro ao editar Usuario
						<script>$('#retornoErro').fadeOut(5000);</script>";
			}

sleep(1);