<?php
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$count = 0;

if( empty( $marca ) ){
	$msgNome = "*Preencha com a Marca do Equipamento<br />
						<script>
							$('#marca').css('background','#FBE3E4');
							$('#marca').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $modelo ) ){
	$msgIdentidade = "*Preencha com o Modelo do Equipamento<br />
						<script>
							$('#modelo').css('background','#FBE3E4');
							$('#modelo').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $tipo ) ){
	$msgOrgaoexpedidor = "*Selecione o Tipo do Equipamento<br />
						<script>
							$('#tipo').css('background','#FBE3E4');
							$('#tipo').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $serie ) ){
	$msgCpf = "*Preencha com o Numero de Serie do Equipamento. Se não possuir preencher com zeros (0).<br />
						<script>
							$('#serie').css('background','#FBE3E4');
							$('#serie').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}


if( $count >= 1){
print <<<ERRO
$msgNome
$msgIdentidade
$msgOrgaoexpedidor
$msgCpf
ERRO;
}else{
	
$sql = new Conexao();
$sql->conecta();

$equip = new Equipamento( $_GET );

	$ok = $sql->consulta ( $equip->novo( $idcliente ) );

	if($ok){
		echo "Cadastrado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$('select').val('');
						$(window.document.location).attr('href','equipamentos.php?editar=1&idcliente=".$idcliente."');
					</script>";
	}else{
		echo "Erro ao cadastrar Novo Equiamento
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}
	
}
sleep(1);