<?php
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
		$qtd = $sql->consulta( OS::listarOsAguardandoPeca() );
		$numRows = mysql_num_rows($qtd);

		if( $numRows >=1 ){

			echo "<table style='display:none'><tbody>";
			while( $l = $sql->resultado() ){
			echo"
				<tr>
					<td class='um'>
						<a href='#' onclick='solicitarPeca(".$l['idordemdeservico'].")'>".$l['idordemdeservico']."</a>
					</td>
					<td class='um'>".data_dmy($l['entrada'])."</td>
					<td class='dois'>".$l['tipoequip']." - ".$l['marcaequip']." - ".$l['modeloequip']."</td>
					<td class='tres'>".$l['nome']." - ".$l['telefone']."</td>
					<td class='quatro'>".$l['status']."</td>
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
			$(window.document.location).attr('href','solicitacaopeca.php);
		})
	});

	function solicitarPeca( idos ){
		if( confirm('Deseja Solicitar Peça para a OS de nr. '+idos) ){
			$.ajax({
				type: "GET",
				url: "ajax/solicitarPeca.php",
				data: "idos="+idos,
				beforeSend: function(){
					$('#retornoErro').fadeIn(200);
		            $("#retornoErro").text('Carregando...');
				},
				success: function(html){
					$('#retornoErro').fadeIn(200);
					$("#retornoErro").html(html);
				}
			});
		}
	}
</script>

<?php
include_once("rodape.php");