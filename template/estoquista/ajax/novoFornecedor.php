<?php
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$count = 0;

$msCnpj = '';
$msgInscEst = '';
$msgCep = '';
$msgLogradouro = '';
$msgNumero = '';
$msgBairro = '';
$msgCidade = '';
$msgUf = '';

if( empty( $razaosocial ) ){
	$razaoSocial = "*Preencha a Razão Social do Fornecedor<br />
						<script>
							$('#razaosocial').css('background','#FBE3E4');
							$('#razaosocial').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cnpj ) ){
	$msCnpj = "*Preencha o CNPJ do Fornecedor<br />
						<script>
							$('#cnpj').css('background','#FBE3E4');
							$('#cnpj').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $inscest ) ){
	$msgInscEst = "*Preencha a Inscrição Estadual do Fornecedor<br />
						<script>
							$('#inscest').css('background','#FBE3E4');
							$('#inscest').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cep ) ){
	$msgCep = "*Preencha o CEP do Fornecedor<br />
						<script>
							$('#cep').css('background','#FBE3E4');
							$('#cep').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $logradouro ) ){
	$msgLogradouro = "*Preencha o Logradouro do Fornecedor. <br />
						<script>
							$('#logradouro').css('background','#FBE3E4');
							$('#logradouro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $numero ) ){
	$msgNumero = "*Preencha o Numero do Logradouro do Fornecedor. <br />
						<script>
							$('#numero').css('background','#FBE3E4');
							$('#numero').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $bairro ) ){
	$msgBairro = "*Preencha o Bairro do Logradouro do Fornecedor. <br />
						<script>
							$('#bairro').css('background','#FBE3E4');
							$('#bairro').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $cidade ) ){
	$msgCidade = "*Preencha a Cidade do Logradouro do Fornecedor. <br />
						<script>
							$('#cidade').css('background','#FBE3E4');
							$('#cidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $uf ) ){
	$msgUf = "*Preencha a UF do Logradouro do Fornecedor. <br />
						<script>
							$('#uf').css('background','#FBE3E4');
							$('#uf').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( $count >= 1){
print <<<ERRO
$razaoSocial
$msCnpj
$msgInscEst
$msgCep
$msgLogradouro
$msgNumero
$msgBairro
$msgCidade
$msgUf
ERRO;
}else{
	
$sql = new Conexao();
$sql->conecta();

$fornecedor = new Fornecedor( $_GET );


	$ok = $sql->consulta ( $fornecedor->novo() );
	//	echo $fornecedor->novo();
	if($ok){
	echo "Fornecedor Cadastrado com sucesso
				<script>
					$('#retornoErro').fadeOut(5000);
					$('input[type=text]').val('');
					$('select').val('');
					//$(window.document.location).attr('href','fornecedor.php?editar=1&id=".$idfornecedor."');
				</script>";
	}else{
		echo "Erro ao cadastrar Novo Fornecedor
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}
	


}

sleep(1);
