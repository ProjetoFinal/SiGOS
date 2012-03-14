<?php
session_start();

function __autoload( $classes ) {
	include_once("../../dao/$classes.class.php");
}

extract( $_GET );

if(! !empty( $codigopeca ) ) $key = $codigopeca;
elseif( !empty( $nomepeca ) ) $key = $nomepeca ;
elseif( !empty( $marcapeca ) ) $key = $marcapeca ;
elseif( !empty( $modelopeca ) ) $key = $modelopeca ;


$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta ( Peca::consultaTodasPecas( $key ) ); 

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
			$(window.document.location).attr('href','peca.php?editar=1&idpeca='+id);
		}
	</script>
	<table class="resultado">
		<tbody>
			<tr>
				<td class="um"<a href="#" onclick="editar(<?=$l['idpeca']?>"><?=$l['nomepeca']?></a></td>
				<td class="dois"><?=$l['marcapeca']?></td>
				<td class="tres"><?=$l['modelopeca']?></td>
				<td class="quatro"><?=$l['quantidade']?></td>
				<?php 
					if( $l['qtd'] != 0 )
						echo $l['qtd']." Peça(s)";
					else
						echo "0 Equipamentos";
				?>
			</tr>
		</tbody>
	</table>

	<?php
		}
	}else{
		echo "<script>$('#retorno').text('Peça não cadastrada');</script>";
	}
}else{
	echo "Erro ao consultar Peca
			<script>$('#retornoErro').fadeOut(5000);</script>"
}

sleep(1);
