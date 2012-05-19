<?php
function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$count = 0;

if( empty( $tipo ) ){
	$msgNome = "*Preencha com o Tipo de Equipamento<br />
						<script>
							$('#tipoequip').css('background','#FBE3E4');
							$('#tipoequip').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $valor ) ){
	$msgLogin = "*Preencha com o valor da Mão de Obra<br />
						<script>
							$('#valor').css('background','#FBE3E4');
							$('#valor').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}


if( $count >= 1){
print <<<ERRO
$msgNome
$msgLogin
ERRO;
}else{

$sql = new Conexao();
$sql->conecta();



$tp = new TipoEquipamento( $_GET );

$ok = $sql->consulta( $tp->novo() );

		if($ok){
		echo "Cadastrado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
					</script>";
		}else{
			echo "Erro ao cadastrar Novo Tipo de Equipamento
				<script>$('#retornoErro').fadeOut(5000);</script>";	
		}

}

sleep(1);