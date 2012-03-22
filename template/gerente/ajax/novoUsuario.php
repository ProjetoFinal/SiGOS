<?php
function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$count = 0;

if( empty( $nome ) ){
	$msgNome = "*Preencha com o nome do Usuário<br />
						<script>
							$('#nome').css('background','#FBE3E4');
							$('#nome').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $login ) ){
	$msgLogin = "*Preencha com o login do Usuário<br />
						<script>
							$('#login').css('background','#FBE3E4');
							$('#login').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $senha ) ){
	$msgSenha = "*Preencha com a senha do Usuário<br />
						<script>
							$('#senha').css('background','#FBE3E4');
							$('#senha').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( empty( $nivel ) ){
	$msgNivel = "*Selecione o nível do Usuário<br />
						<script>
							$('#nivel').css('background','#FBE3E4');
							$('#nivel').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( empty( $status ) ){
	$msgStatus = "*Selecione o Status inicial do Usuário<br />
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
$msgSenha
$msgNivel
$msgStatus
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();

$verificaLogin = $sql->consulta ( Usuario::consultaLogin( $login ) );
$rows = mysql_num_rows($verificaLogin);

if ( $rows >= 1 ){
	echo "Login já existente: ".$login.". Favor escolher outro login.
					<script>
						$('#form1 #login').val('');
						$('#form1 #login').focus();
						$('#form1 #login').css('background','#FBE3E4');
						$('#form1 #login').css('border','1px solid #FBC2C4');
					</script>";
					
} else {

$usuario = new Usuario( $_GET );

$ok = $sql->consulta( $usuario->novoUsuario() );

		if($ok){
		echo "Cadastrado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$('input[type=password]').val('');
						$('select').val('');
					</script>";
		}else{
			echo "Erro ao cadastrar Novo Usuario
				<script>$('#retornoErro').fadeOut(5000);</script>";	
		}

}

}

sleep(1);