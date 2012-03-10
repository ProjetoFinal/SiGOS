<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );


$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta ( Equipamento::removerId( $idequipamento ) );


if($ok){
	echo "*Removido com sucesso
		<script>
			$(window.document.location).attr('href','selecionarEquip.php?editar=1&idcliente=".$idcliente."');
		</script>";
}else{
	echo "Erro ao remover Equipamento
			<script>
				$('#retornoErro').fadeOut(5000);
				$('#editEquip').fadeOut(200);
			</script>";
}

sleep(1);
