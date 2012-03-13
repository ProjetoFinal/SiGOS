<?php
session_start();

function __autoload( $classe ) {
	include_once("../../../dao/$classe.class.php");
}

require_once("../../function/formataData.php");
require_once("../../function/validaCPF.php");

extract( $_GET );

$count = 0;

if( empty( $codigopeca ) ){
	$msgCodigoPeca = "*Preencha com o código da Peça<br />
					<script>
						$('#codigoPeca').css('background','#FBE3E4');
						$('#codigoPeca').css('border','1px solid #FBC2C4');
					</script>";
	$count++;
}
if( empty( $nomepeca ) ){
	$msgNomePeca = "*Preencha com o nome da Peça<br />
					<script>
						$('#nomePeca').css('background','#FBE3E4');
						$('#nomePeca').css('border','1px solid #FBC2C4');
					</script>";
	$count++;
}
if( empty( $marcapeca ) ){
	$msgMarcaPeca = "*Preencha com a marca da Peça<br />
						<script>
							$('#marcaPeca').css('background','#FBE3E4');
							$('#marcaPeca').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $modelopeca ) ){
	$msgModeloPeca = "*Preencha com a modelo da Peça<br />
						<script>
							$('#modeloPeca').css('background','#FBE3E4');
							$('#modeloPeca').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $quantidade ) ){
	$msgQuantidade = "*Preencha com a quantidade<br />
						<script>
							$('#quantidade').css('background','#FBE3E4');
							$('#quantidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $precounidade ) ){
	$msgPrecoUnidade = "*Preencha com o preço unitário<br />
						<script>
							$('#precoUnidade').css('background','#FBE3E4');
							$('#precoUnidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $dataentrada ) ){
	$msgDataEntrada = "*Preencha com a data de saída da nota<br />
						<script>
							$('#dataEntrada').css('background','#FBE3E4');
							$('#dataEntrada').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( $count >= 1){
print <<<ERRO
$msgCodigoPeca
$msgNomePeca
$msgMarcaPeca
$msgModeloPeca
$msgQuantidade
$msgPrecoUnidade
$msgDataEntrada
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();

$peca = new Peca( $_GET );

	
	$verifica = $sql->consulta( $peca->consultaCodigo( $codigoPeca ) );

	$cont = mysql_num_rows( $verifica );

	if( $cont >= 1 ){
		echo "Peça já cadastrada!
				<script>$('#retornoErro').fadeOut(15000);</script>";
	} else { // tinha um */ aqui q vc provavelmente esqueceu de tirar!
		$ok = $sql->consulta ( $peca->novaPeca() );
		//echo $peca->novaPeca();
		if($ok){
			echo "Cadastrado com sucesso
						<script>
							$('#retornoErro').fadeOut(5000);
							$('input[type=text]').val('');
							$('select').val('');
						</script>";
		}else{
			echo "Erro ao cadastrar Nova Peça!
					<script>$('#retornoErro').fadeOut(15000);</script>";
		}
	
	}
}
	sleep(1);



