<?php
include_once("topo.php");
require_once("../function/formataData.php");
if( $_GET ){
	$key = $_GET['key'];
}
?>

<div id="busca">
	<input type="text" id="key" />
	<input type="button" id="buscar" value="Buscar" />
</div>

<div id='retornoErro'></div>
<div id="listaOS">
	<?php
		$sql = new Conexao();
		$sql->conecta();
		$qtd = $sql->consulta( OS::listarOsAprovadas( $key, $_SESSION['idusuario'] ) );
		$numRows = mysql_num_rows($qtd);

		if( $numRows >=1 ){

			echo "<table style='display:none'><tbody>";
			while( $l = $sql->resultado() ){
			echo"
				<tr>
					<td class='um'>
						<a href='#' onclick='assumirOS(".$l['idordemdeservico'].")'>".$l['idordemdeservico']."</a>
					</td>
					<td class='um'>".data_dmy($l['entrada'])."</td>
					<td class='dois'>".$l['tipoequip']." - ".$l['marcaequip']." - ".$l['modeloequip']."</td>
					<td class='tres'>".$l['defeito']."</td>
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
			$(window.document.location).attr('href','aprovadas.php?key='+key);
		})
	});

	function assumirOS( idos ){
		if( confirm('A OS de nr. '+idos+' entrara em manutencao.') ){
			$.ajax({
				type: "GET",
				url: "ajax/assumirOsAberta.php",
				data: "idos="+idos+
					  "&idstatus=6"	,
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