<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("../function/formataData.php");

$sql = new Conexao();
$sql->conecta();
$sql->consulta( OS::impOS( $_GET['idos'] ) );
$l = $sql->resultado();

extract( $l );

$txt = "------------------------------------------------";
$txt .= "\n------------------------------------------------";
$txt .= "\n   Eletronica Lider de Padre Miguel Ltda. ME";
$txt .= "\nFone: 0xx21 3331-9673 / 0xx21 3332-1750";
$txt .= "\nCNPJ: 32.212.177/0001-48";
$txt .= "\n------------------------------------------------";
$txt .= "\n------------------------------------------------";
$txt .= "\nOrdem de Servico Nr. $idordemdeservico";
$txt .= "\n ";
$txt .= "\nEmissao: ".data_dmy($entrada)."";
$txt .= "\nOrc:   - Atend: $idfuncionario - Tipo: Balcao";
$txt .= "\n--------------------Cliente---------------------";
$txt .= "\nCliente: $nome";
$txt .= "\nCPF: $cpf";
$txt .= "\nFone: $telefone";
$txt .= "\n------------------Equipamento-------------------";
$txt .= "\nEquip: $tipoequip - $marcaequip - $modeloequip";
if( $garantiadeservico == '' or $garantiadeservico == 0){
	$txt .= "\nGarantia de Servico: Nao";
}else{
	$txt .= "\nGarantia de Servico: Sim";
}
$txt .= "\n---------------------Defeito--------------------";
$txt .= "\n$defeito";
$txt .= "\n";
$txt .= "\n------------------------------------------------";
$txt .= "\n";
$txt .= "\nAssinatura:";
$txt .= "\n";
$txt .= "\n------------------------------------------------";
$txt .= "\n Mercadorias nao retiradas no prazo de 90 dias";
$txt .= "\n    da data de entrega, serao vendidas para";
$txt .= "\n    ressarcimento das despesas com concerto";
$txt .= "\n        TRAZER DOCUMENTO DE IDENTIDADE";
$txt .= "\n------------------------------------------------";
// espaco apos impressao
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";
$txt .= "\n";

$arquivo = "impressao/os".time().".txt";
$fopen = fopen( $arquivo , "a" );
fwrite( $fopen, $txt );
fclose( $fopen );

$attCaminho = $sql->consulta( OS::attCaminhoImp( $idordemdeservico, $arquivo ) );

//exec("copy " . $arquivo . " com3:");

$fopen2 = fopen($arquivo, "r");

while (!feof ($fopen2)) {
  $linha = fgets($fopen2, 4096);
  echo $linha."<br>";
}
fclose ($fopen2);