<?php
function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );



$sql = new Conexao();
$sql->conecta();

$tp = new TipoEquipamento( $_GET );

$ok = $sql->consulta( $tp->editar( $idtiposequipamentos ) );

		if($ok){
		echo "Editado com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$(window.document.location).attr('href','maodeobra.php');
					</script>";
		}else{
			echo "Erro ao Editar Tipo de Equipamento
				<script>$('#retornoErro').fadeOut(5000);</script>";	
		}


sleep(1);