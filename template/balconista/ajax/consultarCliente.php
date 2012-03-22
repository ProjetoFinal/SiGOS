<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );


if( !empty( $nome ) ) $key = $nome;
elseif( !empty( $cpf ) ) $key = $cpf;
elseif( !empty( $telefone ) ) $key = $telefone;
elseif( !empty( $celular ) ) $key = $celular;
elseif( !empty( $email ) ) $key = $email;



$sql = new Conexao();
$sql->conecta();

$ok = $sql->consulta ( Cliente::consultaKey( $key ) );


/*
echo "<pre>";
var_dump( $_GET );
echo "</pre>";
*/
if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1 ){
		while( $l = $sql->resultado() ){
	?>
	<script>
		$('#retorno').fadeIn(200);
		$('table.resultado tbody tr:odd').css('background','#bbd5e2');
		$('table.resultado tbody tr:even').css('background','#EBF3EB');
		$('table.resultado tbody tr a').css('color','blue');
		function editar( id ){
			$(window.document.location).attr('href','cliente.php?editar=1&id='+id);
		}
	</script>
	<table class="resultado">
		<tbody>
			<tr>
				<td class="um"><a href="#" onclick="editar(<?=$l['idcliente']?>)"><?=$l['nome']?></a></td>
				<td class="dois"><?=$l['cpf']?></td>
				<td class="tres"><?=$l['telefone']?></td>
				<td class="quatro">
					<?php 
						if( $l['email'] != "" )
							echo $l['email'];
						else
							echo "//";
					?>
				</td>
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
			<script>$('#retornoErro').fadeOut(5000);</script>";
}

sleep(1);