<?php
session_start();

function __autoload( $class ) {
	include_once("../../../dao/$class.class.php");
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

if( $codigopeca != '' || $nomepeca != '' || $marcapeca != '' || $modelopeca != '' ){
	$ok = $sql->consulta ( Peca::consultaKey( $arr ) );
} else {
	$ok = $sql->consulta ( Peca::consultaTodasPecas() );
}


if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1 ){
		
	?>
		<script src='/SiGOS/template/js/jquery.dataTables.js'> </script>
        <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
        <script type="text/javascript" >
        $('#test').dataTable();
		$('#retorno').fadeIn(200);
		$('#retorno').css('margin-top','250px');
		//$('table.resultado tbody tr:odd').css('background','#bdd5e2');
		//$('table.resultado tbody tr:even').css('background','#EBF3EB');
		$('table.resultado tbody tr a').css('color','blue');
		function editar( id ){
			$(window.document.location).attr('href','peca.php?editar=1&idpeca='+id);
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
				<td>Preco Unit.</td>
			</tr>
		</thead>
		<tbody>
		<?php while( $l = $sql->resultado() ){ ?>
			<tr>
				<td><a href="#" onclick="editar(<?=$l['idpeca']?>)"><?=$l['codigopeca']?></a></td>
				<td><?=$l['nomepeca']?></td>
				<td><?=ucfirst($l['marcapeca'])?></td>
				<td><?=ucfirst($l['modelopeca'])?></td>
				<td>
					<?php
						if( $l['quantidade'] > 0 )
							echo  $l['quantidade'];
						else
							echo  "<a href='solicitacaopeca.php' style='color:red !important'>".$l['quantidade']."</a>";
					?>
				</td>
				<td><?=ucfirst($l['precounidade'])?></td>
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


sleep(1);

