<?php 
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

// Consulta as peças solicitadas
$res = $sql->consulta( PecaSolicitada::consultaPorOS( $idos ) );
$numRows = mysql_num_rows($res);
if( $numRows >=1 ){
	// Enquanto houver peça solicitada para a ordem de servico
	while( $pecasolicitada = $sql->resultado() ){
		// Verifica se a peça existe no catalogo de pecas
		$respeca = $sql->consulta( Peca::consultaID( $pecasolicitada['idpeca'] ) );
		$numRows = mysql_num_rows($respeca);
		if ($numRows <= 0) {
			echo "Peça Solicitada para a OS nr. ".$idos." não está cadastrada no Catálogo de Peças"."
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>
				<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=solicitarpeca.php'>";
		}
		else {
			// Verifica se existe quantidade disponivel para atendimento
			$peca = $sql->resultado();
			if ($peca['quantidade'] >= $pecasolicitada['qtdsolicitada']) {
			   // Se houver atualiza a quantidade disponivel
			   $ok = $sql->consulta(Peca::atualizaQuantidadeEstoquePeca( $pecasolicitada['idpeca'], 
									       $pecasolicitada['qtdsolicitada'] ) );
			}
			else {
			   // Senao existir quantidade disponivel em estoque entao solicita a compra da peca
				echo "O Estoque não possui a Peça ".$peca['codigopeca']." que foi solicitada para a OS nr. ".$idos.".
				<script>
					$('#retornoErro').fadeOut(5000);
				</script>
				<META HTTP-EQUIV='REFRESH' CONTENT='2; URL=solicitarpeca.php'>";
			}			
		}
	}
}

sleep(1);
