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

<br /><br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Peças Solicitadas
</span>


<div id='retornoErro'>
</div>

<div id="listaOS" style="margin-top:-25px !important;
						 height:auto;
						 overflow:hidden;
						 background: #fff;">
	<?php
		$sql = new Conexao();
		$sql->conecta();
		$qtd = $sql->consulta( Compra::consulta() );
		$numRows = mysql_num_rows($qtd);

		$sql2 = new Conexao();
		$sql2->conecta();

		if( $numRows >=1 ){

			echo "<table id='test'>
					<thead>
						<tr id='trTitulo'>
							<td>//</td>
							<td>Data Pedido</td>
							<td>Quantidade de Peças</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>";

			while( $l = $sql->resultado() ){
				$sql2->consulta( Compra::verificarOS( $l['idcomprapeca'] ) );
				$trcor = $sql2->resultado();
					
				if($trcor['idos'] != ''){
					$style = "style='color:red !important'";
				}else{
					$style = "";
				}

			echo "<tr>
					<td class='um'>"; ?>
						<a href='#' <?=$style?> onclick="verCompra('<?=$l['datapedido']?>')">VER</a>
						<?php echo "
					</td>
					<td class='um'>".data_dmy($l['datapedido'])."</td>
					<td class='dois'>".$l['qtdpeca']." peça(s)</td>
					<td class='dois' style='text-transform:uppercase'>".$l['status']."</td>
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
			$(window.document.location).attr('href','solicitacaopeca.php');
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

	function verCompra( datapedido ){
		abrir('verCompra.php?datapedido='+datapedido,'520','600'); 
	}

</script>

<?php
include_once("rodape.php");
