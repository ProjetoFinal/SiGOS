<?php
include_once("topo.php");
require_once("../function/formataData.php");
if( $_GET ){
	$key = $_GET['key'];
}
?>
<br /><br /><br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Ordem de Serviço Aprovada
</span>

<div id='retornoErro'></div>
<div id="listaOS" style="border:0px solid red;
						 height:auto;
						 overflow:hidden;
						 background: #fff;">
	<?php
		$sql = new Conexao();
		$sql->conecta();

		$bomba = explode(":",$key);

		$word = array( $bomba[0] => ltrim($bomba[1]) );

		$qtd = $sql->consulta( OS::listarOsAprovadas( $word, $_SESSION['idusuario'] ) );
		$numRows = mysql_num_rows($qtd);

		if( $numRows >=1 ){

			echo "<table id='test' style='display:none'>
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
	
<script src='/SiGOS/template/js/jquery.dataTables.js'> </script>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
<script type="text/javascript" >
	$(document).ready( function(){
		$('#test').dataTable();
		$("#retornoErro").fadeIn(200);
		$("#retornoErro").text("Carregando...");
		$("#retornoErro").fadeOut(3000);
		$("#listaOS table").delay(1000).fadeIn(200);
		//$('#listaOS table tbody tr:odd').css('background','#bbd5e2');
		//$('#listaOS table tbody tr:even').css('background','#EBF3EB');

		$("#buscar").click( function(){
			var key = $('#key').val();
			$(window.document.location).attr('href','aprovadas.php?key='+key);
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

	function assumirOS( idos ){
		if( confirm('Deseja colocar a Ordem de Servico de nr. '+idos+' em manutencao?') ){
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