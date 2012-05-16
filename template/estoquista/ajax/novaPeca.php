<?php
session_start();

function __autoload( $classe ) {
	include_once("../../../dao/$classe.class.php");
}

require_once("../../function/formataData.php");

extract( $_GET );

$count = 0;

if( empty( $codigopeca ) ){
	$msgCodigoPeca = "*Preencha com o código da Peça<br />
					<script>
						$('#codigopeca').css('background','#FBE3E4');
						$('#codigopeca').css('border','1px solid #FBC2C4');
					</script>";
	$count++;
}
if( empty( $nomepeca ) ){
	$msgNomePeca = "*Preencha com o nome da Peça<br />
					<script>
						$('#nomepeca').css('background','#FBE3E4');
						$('#nomepeca').css('border','1px solid #FBC2C4');
					</script>";
	$count++;
}
if( empty( $marcapeca ) ){
	$msgMarcaPeca = "*Preencha com a marca da Peça<br />
						<script>
							$('#marcapeca').css('background','#FBE3E4');
							$('#marcapeca').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $modelopeca ) ){
	$msgModeloPeca = "*Preencha com a modelo da Peça<br />
						<script>
							$('#modelopeca').css('background','#FBE3E4');
							$('#modelopeca').css('border','1px solid #FBC2C4');
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
							$('#precounidade').css('background','#FBE3E4');
							$('#precounidade').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( empty( $idfornecedor ) ){
	$msgFabricante = "*Selecione um Fabricante<br />
						<script>
							$('#idfornecedor').css('background','#FBE3E4');
							$('#idfornecedor').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( empty( $dataentrada ) ){
	$msgDataEntrada = "*Preencha com a data de saída da nota<br />
						<script>
							$('#dataentrada').css('background','#FBE3E4');
							$('#dataentrada').css('border','1px solid #FBC2C4');
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
$msgFabricante
$msgDataEntrada
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();

$peca = new Peca( $_GET );

	
	$verifica = $sql->consulta( Peca::consultaCodigo( $codigopeca ) );

	$cont = mysql_num_rows( $verifica );

	if( $cont >= 1 ){
		echo "Peça já cadastrada!
				<script>$('#retornoErro').fadeOut(15000);</script>";
	} else { 
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



