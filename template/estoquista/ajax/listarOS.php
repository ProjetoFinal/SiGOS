<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}
include_once("../../function/formataData.php");

extract( $_GET );

	$sql = new Conexao();
	$sql->conecta();
	$res = $sql->consulta( OS::listarOSEstoque( $key ) );
	$cont = mysql_num_rows( $res );

	if( $cont >=1 ){
		while( $l = $sql->resultado() ){
			$link = "<a href='#' onclick='verOS(".$l['idordemdeservico'].")'>".$l['idordemdeservico']."</a>";
				
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

	function abrir(pagina,largura,altura) {

		//pega a resolução do visitante
		w = screen.width;
		h = screen.height;

		//divide a resolução por 2, obtendo o centro do monitor
		meio_w = w/2;
		meio_h = h/2;

		//diminui o valor da metade da resolução pelo tamanho da janela, fazendo com q ela fique centralizada
		altura2 = altura/2;
		largura2 = largura/2;
		meio1 = meio_h-altura2;
		meio2 = meio_w-largura2;

		//abre a nova janela, já com a sua devida posição
		window.open(pagina,'','height='+altura+',width='+largura+',top='+meio1+',left='+meio2+',scrollbars=no, toolbar=no'); 
	}

	function emManutencao( idos ){
		abrir('emManutencao.php?idos='+idos,'520','600'); 
	}

	function prontaEntrega( idos ){
		abrir('prontaEntrega.php?idos='+idos,'520','600'); 
	}

	function apRp( idos ){
		abrir('apRp.php?idos='+idos,'520','600'); 
	}

	function verOS( id ){
		window.open('verOs.php?idos='+id,'Janela','width=520,height=600');
	}
</script>

<?php sleep(1); ?>
