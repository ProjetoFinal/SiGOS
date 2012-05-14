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
	<div id="filtro2">
		<div id="os" class="filtro">ordem de serviço</div>		
		<div id="fechar" class="fechar"><span id="txtFechar">FECHAR</span> X</div>
	</div>
</div>

<div id='retornoErro'></div>
<div id="listaOS">
	<?php
		$sql = new Conexao();
		$sql->conecta();

		$bomba = explode(":",$key);

		$word = array( $bomba[0] => ltrim($bomba[1]) );

		$qtd = $sql->consulta( OS::listarOsPrioridade( $word, $_SESSION['idusuario'] ) );
		$numRows = mysql_num_rows($qtd);

		if( $numRows >=1 ){
			
			echo "<table style='display:none'>
					<thead>
						<tr id='trTitulo'>
							<td>OS</td>
							<td>Entrada</td>
							<td>Equipamento</td>
							<td>Defeito</td>
							<td>Status</td>
						</tr>
					</thead>
				  	<tbody>";
			while( $l = $sql->resultado() ){
			echo"
				<tr>
					<td class='um'>
						<a href='#' onclick='reabrirOS(".$l['idordemdeservico'].")'>".$l['idordemdeservico']."</a>
					</td>
					<td class='um'>".data_dmy($l['entrada'])."</td>
					<td class='dois'>".$l['tipoequip']." - ".$l['marcaequip']." - ".$l['modeloequip']."</td>
					<td class='tres'>".$l['defeito']."</td>
					<td class='quatro'>".$l['status']."</td>
				</tr>";
			}
			echo "</tbody></table>";
		}else{
			echo "Sem Registros";
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
			$(window.document.location).attr('href','prioridade.php?key='+key);
		});

		$('#key').click( function(){
	    	if( $('#key').val() == ''){
	    		$('#filtro2').fadeIn(200);
	    		$('#buscar').focus();
	    	}
	    	$('#busca #key').css('border-bottom','1px solid transparent');
	    });

	    $('#areaOff').hover( function(){
	    	$('#filtro2').fadeOut(200);
	    });

	    $('#listaOS').hover( function(){
	    	$('#filtro2').fadeOut(200);
	    });

	    $('#filtro2 #os').click( function(){
	    	$('#key').val();
	    	$('#key').focus();
	    	$('#key').val("idos:");
	    	$('#filtro2').fadeOut(100);
	    });

	    $('#filtro2 #fechar').click( function(){
	    	$('#key').val();
	    	$('#key').focus();
	    	$('#filtro2').fadeOut(100);
	    });
	});

	function reabrirOS( idos ){
		if( confirm('A OS de nr. '+idos+' entrara em manutencao novamente.') ){
			$.ajax({
				type: "GET",
				url: "ajax/reabrirPrioridade.php",
				data: "idos="+idos+
					  "&idstatus=2",
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