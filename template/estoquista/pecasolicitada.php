<?php
function __autoload($class){
    include_once("../../dao/$class.class.php");
}
include_once("topo.php");
require_once("../function/formataData.php");

if( $_GET ){
	$key = $_GET['key'];
}

?>

<div id='retornoErro'>
</div>

<div id="listaOS">
	<?php
		$sql = new Conexao();
		$sql->conecta();
		$qtd = $sql->consulta( Compra::consulta() );
		$numRows = mysql_num_rows($qtd);

		$sql2 = new Conexao();
		$sql2->conecta();

		if( $numRows >=1 ){

			echo "<table><tbody>";

			while( $l = $sql->resultado() ){
				$sql2->consulta( Compra::verificarOS( $l['idcomprapeca'] ) );
				$trcor = $sql2->resultado();
					
				if($trcor['idos'] != ''){
					$style = "style='color:red !important'";
				}else{
					$style = "";
				}

			echo "<tr>
					<td class='um'>
						<a href='#' ".$style." onclick='ver(".$l['idcomprapeca'].")'>".$l['idcomprapeca']."</a>
					</td>
					<td class='um'>".data_dmy($l['datapedido'])."</td>
					<td class='dois'>".$l['qtdpeca']." peça(s)</td>
				</tr>";
			}
			echo "</tbody></table>";

		}else{
			echo "Sem registros";
		}
	?>
</div>
	
<script>
	$(document).ready( function(){
		$("#retornoErro").fadeIn(200);
		$("#retornoErro").text("Carregando...");
		$("#retornoErro").fadeOut(3000);
		$("#listaOS table").delay(1000).fadeIn(200);
		$('#listaOS table tbody tr:odd').css('background','#bbd5e2');
		$('#listaOS table tbody tr:even').css('background','#EBF3EB');

		$("#buscar").click( function(){
			var key = $('#key').val();
			$(window.document.location).attr('href','solicitacaopeca.php');
		})
	});

</script>

<?php
include_once("rodape.php");
