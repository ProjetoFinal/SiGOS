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
		$qtd = $sql->consulta( Peca::semEstoque() );
		$numRows = mysql_num_rows($qtd);

		$sql2 = new Conexao();
		$sql2->conecta();

		if( $numRows >=1 ){
			
			echo "<table><tbody>";
			
			while( $l = $sql->resultado() ){
				
				$cont = mysql_num_rows ( $sql2->consulta( Compra::verificaPeca( $l['idpeca'] ) ) );

				if( $cont >= 1 ){
				
				}else{
					($l['quantidade'] == 0) ? $color = "style='color:red'" : $color = '';
					echo"
						<tr ".$color.">
							<td class='um'>
								<a ".$color." href='#' onclick='solicitarPeca(".$l['idpeca'].")'>".$l['idpeca']."</a>
								<input type='hidden' id='nomepeca' value='".$l['nomepeca']."' />
							</td>
							<td class='um'>".$l['codigopeca']."</td>
							<td class='dois'>".$l['nomepeca']." - ".$l['modelopeca']."</td>
							<td class='um'>".$l['quantidade']."</td>
						</tr>";
					}
					
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

	function solicitarPeca( idpeca ){
		var nomepeca = $('#nomepeca').val();
		if( confirm('Deseja Solicitar Compra da Peça '+nomepeca) ){
			$.ajax({
				type: "GET",
				url: "ajax/solicitarPeca.php",
				data: "idpeca="+idpeca,
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
