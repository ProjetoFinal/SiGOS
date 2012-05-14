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

$ok = $sql->consulta ( Equipamento::exibirEquipamentos( $key ) );


/*
echo "<pre>";
var_dump( $_GET );
echo "</pre>";
*/
if($ok){
	$linhas = mysql_num_rows( $ok );
	if( $linhas >= 1 ){

		echo "
			<script>
				$('#retorno').fadeIn(200);
				$('table.resultado tbody tr:odd').css('background','#bbd5e2');
				$('table.resultado tbody tr:even').css('background','#EBF3EB');
				$('table.resultado tbody tr a').css('color','blue');
				function editar( id ){
					$(window.document.location).attr('href','selecionarEquip.php?editar=1&idcliente='+id);
				}
			</script>
			<table class='resultado'>
				<thead>
					<tr id='trTitulo'>
						<td>Cliente</td>
						<td>CPF</td>
						<td>Telefone</td>
						<td>E-Mail</td>
					</tr>
				</thead>
				
				<tbody>";


		while( $l = $sql->resultado() ){
	?>
	
			<tr>
				<td class="um"><a href="#" onclick="editar(<?=$l['idcliente']?>)"><?=$l['nome']?></a></td>
				<td class="dois"><?=$l['cpf']?></td>
				<td class="tres"><?=$l['telefone']?></td>
				<td class="quatro">
					<?php 
						if( $l['qtd'] != 0 )
							echo $l['qtd']." Equipamento(s)";
						else
							echo "0 Equipamentos";
					?>
				</td>
			</tr>
		

	<?php
		}
	}else{
		echo "Sem registros";
	}
		echo "</tbody>
				</table>";
				
}else{
	echo "Erro ao consultar Cliente
			<script>$('#retornoErro').fadeOut(5000);</script>";
}

sleep(1);