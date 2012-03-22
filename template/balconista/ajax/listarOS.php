<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}
include_once("../../function/formataData.php");

extract( $_GET );

	$sql = new Conexao();
	$sql->conecta();
	$res = $sql->consulta( OS::listarOS( $key ) );
	$cont = mysql_num_rows( $res );

	if( $cont >=1 ){
		while( $l = $sql->resultado() ){
			if( $l['idstatus'] <= 7 or $l['idstatus'] == 9 or $l['idstatus'] == 10 && $l['idstatus'] != 3 )
				$link = "<a href='os.php?acao=ver&idos=".$l['idordemdeservico']."'>".$l['idordemdeservico']."</a>";
			if( $l['idstatus'] == 3 )
				$link = "<a href='b'>".$l['idordemdeservico']."</a>";	
			if( $l['idstatus'] == 8 )
				$link = "<a href='c'>".$l['idordemdeservico']."</a>";
				
		echo "
			<table>
				<tbody>
				<tr>
					<td class='um'>
						".$link."
					</td>
					<td class='um'>".data_dmy($l['entrada'])."</td>
					<td class='dois'>".$l['tipoequip']." - ".$l['marcaequip']." - ".$l['modeloequip']."</td>
					<td class='tres'>".$l['nome']." - ".$l['telefone']."</td>
					<td class='quatro'>".$l['status']."</td>
				</tr>
				</tbody>
			</table>";
		}

	}else{
		echo "Sem Registros";
	}
?>

<script>
	$('#listaOS table tbody tr:odd').css('background','#bbd5e2');
	$('#listaOS table tbody tr:even').css('background','#EBF3EB');
	function verOS( id ){
		window.open('verOS.php?idos='+id,'Janela','width=400,height=400');
	}
</script>

<?php sleep(1); ?>
