<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("../function/formataData.php");

$sql = new Conexao();
$sql->conecta();
$sql->consulta( OS::cupom( $_GET['idos'] ) );
$l = $sql->resultado();

extract( $l );

$txt = "------------------------------------------------";
$txt .= "\n               CUPOM NAO FISCAL                 ";
$txt .= "\n------------------------------------------------";
$txt .= "\n------------------------------------------------";
$txt .= "\n   Eletronica Lider de Padre Miguel Ltda. ME";
$txt .= "\nFone: 0xx21 3331-9673 / 0xx21 3332-1750";
$txt .= "\nCNPJ: 32.212.177/0001-48";
$txt .= "\n------------------------------------------------";
$txt .= "\n------------------------------------------------";
$txt .= "\nOrdem de Servico Nr. $idordemdeservico";
$txt .= "\n ";
$txt .= "\nEmissao: ".data_dmy($entrada)."";
$txt .= "\nAtend: Balcao";
$txt .= "\n--------------------Cliente---------------------";
$txt .= "\nCliente: $nome";
$txt .= "\nCPF: $cpf";
$txt .= "\nFone: $telefone";
$txt .= "\n------------------Equipamento-------------------";
$txt .= "\nEquip:"; 
$txt .= "$tipoequip - $marcaequip - $modeloequip";
$txt .= "\n------------------------------------------------";
$txt .= "\nDefeito:";
$txt .= "\n$defeito";
$txt .= "\n------------------------------------------------";
$txt .= "\n                            Total: R$ $totalserv";
if( $tipopag == 3){
	$txt .= "\n                     Tipo de Pagamento: DINHEIRO";
	$txt .= "\n                       Valor Pago: R$ $valorpago";
	$txt .= "\n                          Desconto: R$ $desconto";
	$txt .= "\n                                Troco: R$ $troco";
}else{
	$txt .= "\n                     Valor Pago: R$ $totalserv";
}
$txt .= "\n------------------------------------------------";
$txt .= "\n    Retirada do equipamento efetuada com a";
$txt .= "\n   a apresentação do documento de identidade.";
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

$arquivo = "impressao/cupom_".$_GET['idos']."_".time().".txt";
$fopen = fopen( $arquivo , "a" );
fwrite( $fopen, $txt );
fclose( $fopen );

//$attCaminho = $sql->consulta( OS::attCaminhoImp( $idordemdeservico, $arquivo ) );

//exec("copy " . $arquivo . " com3:");

$fopen2 = fopen($arquivo, "r");

while (!feof ($fopen2)) {
  $linha = fgets($fopen2, 4096);
  echo $linha."<br>";
}
fclose ($fopen2);