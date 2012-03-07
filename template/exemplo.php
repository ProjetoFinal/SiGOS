<?php
include_once('topo.php');

// Essa função serve para chamar todas as classes 
// que forem instanciadas
function __autoload( $classes ){
	include_once('../controler/$classes.class.php');
}

// Instanciando a classe Conexao
$sql = new Conexao();
$sql->conecta();

// Instanciando a classe Exemplo
$exemplo = new Exemplo( $_POST );

$inserir = $sql->consulta( $exemplo->inserirAlgumaCoisa() );

if ( $inserir) {
	echo "Inserido com sucesso.";
}else{
	echo "Erro ao inserir.";
}

$consultar = $sql->consulta( $exemplo->exibirAlgumaCoisa() );

while ( $r = $sql->resultado() ) {
	echo $r['exemploa']." - ".$r['exemplob'];
}

$editar = $sql->consulta( $exemplo->editarAlgumaCoisa() );
if ( $editar) {
	echo "Editado com sucesso.";
}else{
	echo "Erro ao Editar.";
}

$remover = $sql->consulta( $exemplo->removerAlgumaCoisa() );
if ( $remover) {
	echo "Removido com sucesso.";
}else{
	echo "Erro ao Remover.";
}


include_once('rodape.php');
?>