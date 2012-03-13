<?php
session_start();

function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

extract( $_GET );

$count = 0;

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

if( $count >= 1){
print <<<ERRO
$msgLogin
$msgSenha
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();

$consultaLogin = $sql->consulta ( Usuario::consultaLogin( $login ) );
$rowsConsulta = mysql_num_rows( $consultaLogin );

if( $rowsConsulta <= 0 ){
	echo "Login incorreto ou não existente...
					<script>
						$('#retornoLogin').fadeOut(5000);
						$('input[type=text]').val('');
						$('input[type=password]').val('');
					</script>";
} else {
	$usuario = new Usuario( $_GET );

	$validaLogin = $sql->consulta ( $usuario->validarUsuario( $login, $senha ) );
	$retornoValidacao = $sql->resultado();
	$rowsValidacao = mysql_num_rows($validaLogin);

		if( $rowsValidacao >= 1 ){
			if( $retornoValidacao['statusUsuario'] == "inativo" ){
				echo "Login inativo... Contate o administrador do sistema!
					<script>
						$('#retornoLogin').fadeOut(5000);
						$('input[type=text]').val('');
						$('input[type=password]').val('');
					</script>";	
			} else {
			
				$_SESSION['login'] = $retornoValidacao['login'];
				$_SESSION['senha'] = $retornoValidacao['senha'];
				$_SESSION['nome'] = $retornoValidacao['nome'];
				$_SESSION['idusuario'] = $retornoValidacao['idUsuario'];

				switch( $retornoValidacao['nivel'] ){
					case "balconista": 
							echo "<script>
									$(window.document.location).attr('href','/SiGOS/template/balconista');	
								  </script>";
					break;

					case "estoquista": 
							echo "<script>
									$(window.document.location).attr('href','/SiGOS/template/estoquista');	
								  </script>";
					break;

					case "gerente": 
							echo "<script>
									$(window.document.location).attr('href','/SiGOS/template/gerente');	
								  </script>";
					break;

					case "tecnico": 
							echo "<script>
									$(window.document.location).attr('href','/SiGOS/template/tecnico');	
								  </script>";
					break;

				}
			}

			} else {
				echo "Erro de login e/ou senha... Tente novamente!
								<script>
									$('#retornoLogin').fadeOut(5000);
									$('input[type=text]').val('');
									$('input[type=password]').val('');
								</script>";
			}

		}

}











