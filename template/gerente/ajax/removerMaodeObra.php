<?php
function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );



$sql = new Conexao();
$sql->conecta();

$verificar = $sql->consulta( TipoEquipamento::verificarOS( $idtiposequipamentos ) );
$cont = mysql_num_rows($verificar);

if ( $cont == 0 ) {

$ok = $sql->consulta( TipoEquipamento::remover( $idtiposequipamentos ) );

		if($ok){
		echo "Removido com sucesso
					<script>
						$('#retornoErro').fadeOut(5000);
						$('input[type=text]').val('');
						$(window.document.location).attr('href','maodeobra.php');
					</script>";
		}else{
			echo "Erro ao Remover Tipo de Equipamento
				<script>$('#retornoErro').fadeOut(5000);</script>";	
		}
}else{
	echo "Tipo de Equipamento em uso e não poderá ser Removido
				<script>$('#retornoErro').fadeOut(5000);</script>";
}


sleep(1);