<?php
session_start();

function __autoload( $class ) {
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$arr = array("codigopeca" => $codigopeca,
			 "nomepeca" => $nomepeca,
			 "marcapeca" => $marcapeca,
			 "modelopeca" => $modelopeca);


$a = new Conexao();
$a->conecta();

if( $codigopeca != '' || $nomepeca != '' || $marcapeca != '' || $modelopeca != '' ){
	$ok = $a->consulta( Peca::consultaKey( $arr ) );
} else {
	$ok = $a->consulta( Peca::consultaTodasPecas() );
}


if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1 ){
		
	?>
        <script src='/SiGOS/template/js/jquery.dataTables.js'> </script>
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
		<script type="text/javascript" >
			$(document).ready( function(){
			$('#test').dataTable();
			$('#retorno').fadeIn(200);
			$('#retorno').css('margin-top','250px');
			$('table.resultado tbody tr:odd').css('background','#bdd5e2');
			$('table.resultado tbody tr:even').css('background','#EBF3EB');
			$('table.resultado tbody tr a').css('color','blue');
			});

			function usar( idpeca, idos, idor, valor ){
				$(window.document.location).attr('href','ajax/maisUma.php?idpeca='+idpeca+'&idos='+idos+'&idor='+idor+'&valor='+valor);
			}
		</script>
	<table id='test'>

				<thead>
			<tr id="trTitulo">
				<td>Código</td>
				<td>Nome</td>
				<td>Marca</td>
				<td>Modelo</td>
				<td>Quantidade</td>
			</tr>
		</thead>
		<tbody>
		<?php while( $l = $a->resultado() ){ ?>
			<tr>
				<td><a href="#" 
					onclick="usar(<?=$l['idpeca']?>,<?=$idos?>,<?=$idor?>,<?=$l['precounidade']?>)"
					>
						<?=$l['codigopeca']?>
					</a>
				</td>
				<td><?=strtoupper($l['nomepeca'])?></td>
				<td><?=strtoupper($l['marcapeca'])?></td>
				<td><?=strtoupper($l['modelopeca'])?></td>
				<td><?=strtoupper($l['quantidade'])?></td>
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
}


//sleep(1);

