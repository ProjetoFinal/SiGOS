<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );


$sql = new Conexao();
$sql->conecta();

$equip = $sql->consulta( Equipamento::verificarEquipamento( $idcliente ) );
$verEquip = mysql_num_rows( $equip );

if( $verEquip >= 1){

	echo "Existem equipamentos associados ao cliente o mesmo não poderá ser removido.
				<script>$('#retornoErro').fadeOut(5000);</script>";
		
}else{
	
	$ok = $sql->consulta ( Cliente::removerId( $idcliente ) );

	if($ok){
		echo "*Removido com sucesso
			<script>
				$(window.document.location).attr('href','cliente.php');
			</script>";
	}else{
		echo "Erro ao remover Cliente
				<script>$('#retornoErro').fadeOut(5000);</script>";
	}

}

sleep(1);