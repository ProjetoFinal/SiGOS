<?php
session_start();

function __autoload( $classes ) {
	include_once("../../dao/$classes.class.php");
}

extract( $_GET );

if(! !empty( $codigoPeca ) ) $key = $codigoPeca;
elseif( !empty( $nomePeca ) ) $key = $nomePeca ;
elseif( !empty( $marcaPeca ) ) $key = $marcaPeca ;
elseif( !empty( $modeloPeca ) ) $key = $modeloPeca ;
elseif( !empty( $quantidade ) ) $key = $quantidade ;
elseif( !empty( $precoUnidade ) ) $key = $precoUnidade ;
elseif( !empty( $dataEntrada ) ) $key = $dataEntrada ;

$sql = new Conexao();
$sql->conecta();

$okk = $sql->consulta ( Peca::consultaKey( $key ) );

/*
echo "<pre>";
var_dump( $_GET );
echo "</pre>";
*/

if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1){
		while( $l = $sql->resultado() ){
	?>
	<script>
		$('#retorno').fadeIn(200);
		$('table.resultado tbody tr:odd').css('background','#bdd5e2');
		$('table.resultado tbody tr:even').css('background','#EBF3EB');
		$('table.resultado tbody tr a').css('color','blue');
		function editar( id ){
			$(window.document.location).attr('href','peca.php?editar=1&id='+id);
		}
	</script>
	<table class="resultado">
		<tbody>
			<tr>
				<td class="um"<a href="#" onclick="editar(<?=$l['idpeca']?>"><?=$l['nomePeca']?></a></td>
				<td class="dois"><?=$l['marcaPeca']?></td>
				<td class="tres"><?=$l['modeloPeca']?></td>
				<td class="quatro"><?=$l['quantidade']?></td>
			</tr>
		</tbody>
	</table>

	<?php
		}
	}else{
		echo "Sem registros";
	}
}else{
	echo "Erro ao consultar Cliente
			<script>$('#retornoErro').fadeOut(5000);</script>"
}

sleep(1);
