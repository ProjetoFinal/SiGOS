<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$count = 0;
if( empty( $idequipamento ) ){
	$msgCliente = "*Escolha um Cliente<br />
						<script>
							$('#cliente').css('background','#FBE3E4');
							$('#cliente').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}
if( empty( $defeito ) ){
	$msgDefeito = "*Informe o Defeito para o Equipamento selecionado<br />
						<script>
							$('#defeito').css('background','#FBE3E4');
							$('#defeito').css('border','1px solid #FBC2C4');
						</script>";
	$count++;
}

if( $count >=1){
print <<<ERRO
$msgCliente
$msgDefeito
ERRO;
}else{

	$sql = new Conexao();
	$sql->conecta();

	$os = new OS( $_GET );

	$verOS = $sql->consulta( $os->verificarEquipOS() );
	$temOS = mysql_num_rows( $verOS );

	if( $temOS >=1 ){
		echo "Esse Equipamento já está associado à uma Ordem de Serviço";
	}else{
		
		$ok = $sql->consulta( $os->nova() );
		$ultimoId = mysql_insert_id();

		if( $ok ){

			$ok2 = $sql->consulta( Orcamento::novo( $ultimoId, $maodeobra) );

			if( $ok2){
				echo "Cadastrado com Sucesso
					  <script>
					  $(window.document.location).attr('href','os.php?editar=imp&idos=".$ultimoId."');
					  </script>";
			}else{
				echo "Erro ao Cadastrar Orcamento";
			}
		}else{
			echo "Erro ao Cadastrar OS";
		}

	}

}
sleep(1);
