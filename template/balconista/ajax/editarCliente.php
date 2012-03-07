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
	$msgNome = "*Preencha com o nome do Cliente<br />
						<script>
							$('#nome').css('background','#FBE3E4');
							$('#nome').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $identidade ) ){
	$msgIdentidade = "*Preencha com o numero de identidade do Cliente<br />
						<script>
							$('#identidade').css('background','#FBE3E4');
							$('#identidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $orgaoexpedidor ) ){
	$msgOrgaoexpedidor = "*Preencha com o Orgao Expedidor<br />
						<script>
							$('#orgaoexpedidor').css('background','#FBE3E4');
							$('#orgaoexpedidor').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cpf ) ){
	$msgCpf = "*Preencha com o numero de CPF do Cliente<br />
						<script>
							$('#cpf').css('background','#FBE3E4');
							$('#cpf').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $nascimento ) ){
	$msgNascimento = "*Preencha com a data de Nascimento do Cliente<br />
						<script>
							$('#nascimento').css('background','#FBE3E4');
							$('#nascimento').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $telefone ) ){
	$msgTelefone = "*Preencha com o numero de Telefone do Cliente<br />
						<script>
							$('#telefone').css('background','#FBE3E4');
							$('#telefone').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cep ) ){
	$msgCep = "*Preencha com o CEP do Cliente<br />
						<script>
							$('#cep').css('background','#FBE3E4');
							$('#cep').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $logradouro ) ){
	$msgLogradouro = "*Preencha com o Logradouro do Cliente<br />
						<script>
							$('#logradouro').css('background','#FBE3E4');
							$('#logradouro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $numero ) ){
	$msgNumero = "*Preencha com o Numero do Logradouro do Cliente<br />
						<script>
							$('#numero').css('background','#FBE3E4');
							$('#numero').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $bairro ) ){
	$msgBairro = "*Preencha com o Bairro do Cliente<br />
						<script>
							$('#bairro').css('background','#FBE3E4');
							$('#bairro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cidade ) ){
	$msgCidade = "*Preencha com a Cidade do Cliente<br />
						<script>
							$('#cidade').css('background','#FBE3E4');
							$('#cidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $uf ) ){
	$msgEstado = "*Preencha com o Estado do Cliente<br />
						<script>
							$('#uf').css('background','#FBE3E4');
							$('#uf').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}


if( $count >= 1){
print <<<ERRO
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

//echo $cliente->novoCliente();


if( validaCPF( $cpf ) == true ){
	
		$ok = $sql->consulta ( $cliente->editar( $idcliente ) );

		/*
		echo "<pre>";
		var_dump( $_GET );
		echo "</pre>";
		*/

		if($ok){ 
			
		echo "Editado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$('select').val('');
						$(window.document.location).attr('href','cliente.php');
					</script>";

		}else{
			echo "Erro ao editar Cliente
					<script>$('#retornoErro').fadeOut(5000);</script>";
		}
}else{
	echo "CPF inválido
					<script>$('#retornoErro').fadeOut(5000);</script>";
}

}


sleep(1);