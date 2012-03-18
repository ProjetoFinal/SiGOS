<?php
session_start();

function __autoload( $classes ) {
	include_once("../../dao/$classes.class.php");
}

extract( $_GET );
/*
if(! !empty( $codigopeca ) ) $key = $codigopeca;
elseif( !empty( $nomepeca ) ) $key = $nomepeca ;
elseif( !empty( $marcapeca ) ) $key = $marcapeca ;
elseif( !empty( $modelopeca ) ) $key = $modelopeca ;
*/

$arr = array(
			 "codigopeca" => $codigopeca,
			 "nomepeca" => $nomepeca,
			 "marcapeca" => $marcapeca,
			 "modelopeca" => $modelopeca);

$sql = new Conexao();
$sql->conecta();

if( !empty( $arr ) ){
	$ok = $sql->consulta ( Peca::consultaKey( $arr ) );
} else {
	$ok = $sql->consulta ( Peca::consultaTodasPecas() );
}


if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1 ){
		
	?>
        <script type="text/javascript" >
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
		<?php while( $l = $sql->resultado() ){ ?>
			<tr>
				<td><a href="#" onclick="editar(<?=$l['idpeca']?>)"><?=$l['codigopeca']?></a></td>
				<td><?=$l['nomepeca']?></td>
				<td><?=ucfirst($l['marcapeca'])?></td>
				<td><?=ucfirst($l['modelopeca'])?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

<?php
	}else{
		echo "<script>$('#retorno').text('Cadastro não encontrado!');</script>";
	}
}else{
	echo "<script>$('#retornoErro').text('Erro ao consultar Peça');</script>";
} ?>

sleep(1);
