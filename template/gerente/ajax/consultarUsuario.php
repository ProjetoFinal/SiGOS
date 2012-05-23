<?php
function __autoload( $class ){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

/*

if( !empty( $nome ) ) $key = $nome;
elseif( !empty( $login ) ) $key = $login;
elseif( !empty( $senha ) ) $key = $senha;
elseif( !empty( $nivel ) ) $key = $nivel;
elseif( !empty( $status ) ) $key = $status;

*/

$arr = array(
			 "nome" => $nome,
			 "login" => $login,
			 "nivel" => $nivel,
			 "status" => $status);

$sql = new Conexao();
$sql->conecta();

if( !empty( $arr ) ){
	$ok = $sql->consulta ( Usuario::consultaKey( $arr ) );
} else {
	$ok = $sql->consulta ( Usuario::consultaTodosUsuarios() );
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
		$('table.resultado tbody tr:odd').css('background','#bbd5e2');
		$('table.resultado tbody tr:even').css('background','#EBF3EB');
		$('table.resultado tbody tr a').css('color','blue');
		function editar( id ){
			$(window.document.location).attr('href','usuario.php?editar=1&idUsuario='+id);
		}
	</script>
	<table id="test">
		<thead>
			<tr id="trTitulo">
				<td>Nome</td>
				<td>Login</td>
				<td>Nivel</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
		<?php while( $l = $sql->resultado() ){ ?>
			<tr>
				<td><a href="#" onclick="editar(<?=$l['idUsuario']?>)"><?=strtoupper($l['nome'])?></a></td>
				<td><?=strtoupper($l['login'])?></td>
				<td><?=strtoupper($l['nivel'])?></td>
				<td><?=strtoupper($l['statusUsuario'])?></td>
			</tr>
		<?php } ?>	
		</tbody>
	</table>

	<?php
	}else{
		echo "<script>$('#retorno').text('Sem registros');</script>";
	}
}else{
	echo "<script>$('#retornoErro').text('Erro ao consultar Usuário');</script>";
}

sleep(1);