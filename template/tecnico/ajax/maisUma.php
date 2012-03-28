<?php 

function __autoload($class){
	include_once("../../../dao/$class.class.php");
}

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$verificar = $sql->consulta( PecaSolicitada::consultarPorOsPeca( $idos, $idpeca ) );
$contRow = mysql_num_rows($verificar);

if( $contRow >= 1 ){
	$l = $sql->resultado();
	$qtd = $l['qtdsolicitada'] + 1;
	$addMaisUm = $sql->consulta( PecaSolicitada::addMaisUm( $l['idpecasolicitada'], $qtd ) );
	if($addMaisUm){
		echo"
			<script>
				opener.location.reload();
				window.close();
			</script>";
	}else{
		echo "
		<script>
			if(confirm('Erro ao atualizar Quantidade')){
				opener.location.reload();
				window.close();
			}else{
				opener.location.reload();
				window.close();
			}
		</script>";
	}
}else{
	$novo = $sql->consulta( PecaSolicitada::novaPecaSolicitada( $idos, $idpeca ) );
	if($novo){
		$sql->consulta( Orcamento::updateValorPecasUsadas( $idor, $valor ) );
		echo"
			<script>
				opener.location.reload();
				window.close();
			</script>";
	}else{
		echo "
		<script>
			if(confirm('Erro ao Solicitar Peca')){
				opener.location.reload();
				window.close();
			}else{
				opener.location.reload();
				window.close();
			}
		</script>";
	}
}
