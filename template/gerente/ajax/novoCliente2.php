<?php
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

require_once("../../function/formataData.php");
require_once("../../function/validaCPF.php");

extract( $_GET );

$count = 0;

if( empty( $nome ) ){
	$msgNome = "
						<script>
							$('#nome').css('background','#FBE3E4');
							$('#nome').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $identidade ) ){
	$msgIdentidade = "
						<script>
							$('#identidade').css('background','#FBE3E4');
							$('#identidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $orgaoexpedidor ) ){
	$msgOrgaoexpedidor = "
						<script>
							$('#orgaoexpedidor').css('background','#FBE3E4');
							$('#orgaoexpedidor').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cpf ) ){
	$msgCpf = "
						<script>
							$('#cpf').css('background','#FBE3E4');
							$('#cpf').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $nascimento ) ){
	$msgNascimento = "
						<script>
							$('#nascimento').css('background','#FBE3E4');
							$('#nascimento').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $telefone ) ){
	$msgTelefone = "
						<script>
							$('#telefone').css('background','#FBE3E4');
							$('#telefone').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cep ) ){
	$msgCep = "
						<script>
							$('#cep').css('background','#FBE3E4');
							$('#cep').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $logradouro ) ){
	$msgLogradouro = "
						<script>
							$('#logradouro').css('background','#FBE3E4');
							$('#logradouro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $numero ) ){
	$msgNumero = "
						<script>
							$('#numero').css('background','#FBE3E4');
							$('#numero').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $bairro ) ){
	$msgBairro = "
						<script>
							$('#bairro').css('background','#FBE3E4');
							$('#bairro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cidade ) ){
	$msgCidade = "
						<script>
							$('#cidade').css('background','#FBE3E4');
							$('#cidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $uf ) ){
	$msgEstado = "
						<script>
							$('#uf').css('background','#FBE3E4');
							$('#uf').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}


if( $count >= 1){
print <<<ERRO
"Atenção aos Campos Obrigatórios"
$msgNome
$msgIdentidade
$msgOrgaoexpedidor
$msgCpf
$msgNascimento
$msgTelefone
$msgCep
$msgLogradouro
$msgNumero
$msgBairro
$msgCidade
$msgEstado
ERRO;
}else{
	
$sql = new Conexao();
$sql->conecta();

$cliente = new Cliente( $_GET );

if( validaCPF( $cpf ) == true ){
	//echo $cliente->novoCliente();
	$verifica = $sql->consulta( Cliente::verificaCPF( $cpf ) );
	$cont = mysql_num_rows( $verifica );

	if( $cont >= 1 ){
		echo "CPF encontrado. Verifique se o cliente ja foi cadastrado.
					<script>$('#retornoErro').fadeOut(5000);</script>";
	}else{
		$ok = $sql->consulta ( $cliente->novoCliente() );

		/*
		echo "<pre>";
		var_dump( $_GET );
		echo "</pre>";
		*/

		if($ok){
		echo "Cadastrado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$('select').val('');
						$(window).delay( 1000 ).queue( function(){
	                		history.back(2);
	                	});
					</script>";
		
		}else{
			echo "Erro ao cadastrar Novo Cliente
					<script>$('#retornoErro').fadeOut(5000);</script>";
		}
	}
}else{
	echo "CPF inválido
					<script>$('#retornoErro').fadeOut(5000);</script>";
}

}

sleep(1);
