<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}
include_once("../../function/formataData.php");

extract( $_GET );

	$sql = new Conexao();
	$sql->conecta();
	$res = $sql->consulta( OS::listarOS( $key ) );
	$cont = mysql_num_rows( $res );

	if( $cont >=1 ){

		echo "
			<script src='/SiGOS/template/js/jquery.dataTables.js'> </script>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/jquery.dataTables.css\" />
        <table id='test'>
				<thead>
					<tr id='trTitulo'>
						<td>//</td>
						<td>OS N.</td>
						<td>Entrada</td>
						<td>Equipamento</td>
						<td>CLiente</td>
						<td>Status OS</td>
					</tr>
				</thead>
				<tbody>";
		while( $l = $sql->resultado() ){
			if( $l['idstatus'] <= 7 or $l['idstatus'] == 9 or $l['idstatus'] == 10 && $l['idstatus'] != 3 )
				$link = "<a href='os.php?acao=ver&idos=".$l['idordemdeservico']."'>VER</a>";
			if( $l['idstatus'] == 3 )
				$link = "<a href='#' onclick='apRp(".$l['idordemdeservico'].")'>APROVAR</a>";	
			if( $l['idstatus'] == 8 )
				$link = "<a href='#' onclick='prontaEntrega(".$l['idordemdeservico'].")'>ENTREGAR</a>";
			if( $l['idstatus'] == 6 )
				$link = "<a href='#' onclick='emManutencao(".$l['idordemdeservico'].")'>ACOMPANHAR</a>";
				
		echo "

				<tr>
					<td class='um'>
						".$link."
					</td>
					<td>".$l['idordemdeservico']."</td>
					<td class='um'>".data_dmy($l['entrada'])."</td>
					<td class='dois'>".strtoupper($l['tipoequip'])." - ".strtoupper($l['marcaequip'])." - ".strtoupper($l['modeloequip'])."</td>
					<td class='tres'>".strtoupper($l['nome'])." - ".$l['telefone']."</td>
					<td class='quatro'>".$l['status']."</td>
				</tr>
				";
		}

		echo "</tbody>
			</table>";

	}else{
		echo "Sem Registros";
	}
?>

<script>
	//$('#listaOS table tbody tr:odd').css('background','#bbd5e2');
	//$('#listaOS table tbody tr:even').css('background','#EBF3EB');
	$('#test').dataTable();

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

	function emManutencao( idos ){
		abrir('emManutencao.php?idos='+idos,'550','700'); 
	}

	function prontaEntrega( idos ){
		abrir('prontaEntrega.php?idos='+idos,'550','700'); 
	}

	function apRp( idos ){
		abrir('apRp.php?idos='+idos,'550','700'); 
	}

	function verOS( id ){
		window.open('verOS.php?idos='+id,'Janela','width=550,height=700');
	}
</script>

<?php sleep(1); ?>
