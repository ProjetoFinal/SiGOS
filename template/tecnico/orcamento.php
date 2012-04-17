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

		$qtd = $sql->consulta( OS::listarOsOrcadas( $word, $_SESSION['idusuario'] ) );
		$numRows = mysql_num_rows($qtd);

		if( $numRows >=1 ){
			
			echo "<table style='display:none'><tbody>";
			while( $l = $sql->resultado() ){
			echo"
				<tr>
					<td class='um'>
						<a href='#' onclick='verOs(".$l['idordemdeservico'].")'>".$l['idordemdeservico']."</a>
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
			$(window.document.location).attr('href','orcamento.php?key='+key);
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

	function verOs( idos ){
		abrir('verOs.php?idos='+idos,'520','600'); 
	}
</script>

<?php
include_once("rodape.php");