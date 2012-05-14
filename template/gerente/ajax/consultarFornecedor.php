<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );


if( !empty( $nomefantasia ) ) $key = $nomefantasia;
elseif( !empty( $cnpj ) ) $key = $cnpj;
else $key ='';

$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta ( Fornecedor::consultaKey( $key ) );

if($ok){
	$linhas = mysql_num_rows( $ok );

	echo "
		<script>
			$('#retorno').fadeIn(200);
			$('table.resultado tbody tr:odd').css('background','#bbd5e2');
			$('table.resultado tbody tr:even').css('background','#EBF3EB');
			$('table.resultado tbody tr a').css('color','blue');
			function editar( id ){
				$(window.document.location).attr('href','fornecedor.php?editar=1&id='+id);
			}
		</script>
		<table class='resultado'>
			<thead>
				<tr id='trTitulo'>
					<td>Nome Fantasia</td>
					<td>CNPJ</td>
					<td>Telefone</td>
					<td>Contato</td>
				</tr>
			</thead>
			<tbody>


	";

	if( $linhas >= 1 ){
		while( $l = $sql->resultado() ){
	?>
	
			<tr>
				<td class="um"><a href="#" onclick="editar(<?=$l['idfornecedor']?>)"><?=$l['nomefantasia']?></a></td>
				<td class="dois"><?=$l['cnpj']?></td>
				<td class="tres"><?=$l['telefone']?></td>
				<td class="quatro"><?=$l['contato']?></td>
			</tr>
		</tbody>
	</table>

	<?php
		}
	}else{
		echo "Sem registros";
	}
}else{
	echo "Erro ao consultar Fornecedor
			<script>$('#retornoErro').fadeOut(5000);</script>";
}

sleep(1);
