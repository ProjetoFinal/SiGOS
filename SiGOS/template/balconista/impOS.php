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

$txt .= "---------------------------------------------\n";
$txt .= "---------------------------------------------\n";
$txt .= "  Eletronica Lider de Padre Miguel Ltda. ME\n";
$txt .= "Fone: 0xx21 XXXX-XXXX - Fax: 0xx21 XXXX-XXXX\n";
$txt .= "CNPJ: 00.000.000/0000-00\n";
$txt .= "---------------------------------------------\n";
$txt .= "---------------------------------------------\n";
$txt .= "Ordem de Servico Nr. $idordemdeservico\n";
$txt .= " \n";
$txt .= "Emissao: ".data_dmy($entrada)."\n";
$txt .= "Orc:   - Atend: $idfuncionario - Tipo: Balcao\n";
$txt .= "-----------------Cliente---------------------\n";
$txt .= "Cliente: $nome\n";
$txt .= "CPF: $cpf\n";
$txt .= "Fone: $telefone\n";
$txt .= "-----------------Equipamento-----------------\n";
$txt .= "Equip: $tipoequip - $marcaequip - $modeloequip\n";
$txt .= "Garantia: Nao\n";
$txt .= "-----------------Defeito---------------------\n";
$txt .= "$defeito\n";
$txt .= " \n";
$txt .= "---------------------------------------------\n";
$txt .= "\n";
$txt .= "Assinatura:\n";
$txt .= " \n";
$txt .= " \n";
$txt .= "---------------------------------------------\n";
$txt .= "Mercadorias nao retiradas no prazo de 90 dias\n";
$txt .= "   da data de entrega, serao vendidas para\n";
$txt .= "   ressarcimento das despesas com concerto\n";
$txt .= "       TRAZER DOCUMENTO DE IDENTIDADE\n";
$txt .= "---------------------------------------------\n";

//echo $txt;

$arquivo = "impressao/os".time().".txt";
$fopen = fopen( $arquivo , "a" );
fwrite( $fopen, $txt );
fclose( $fopen );

$attCaminho = $sql->consulta( OS::attCaminhoImp( $idordemdeservico, $arquivo ) );

$fopen2 = fopen($arquivo, "r");

while (!feof ($fopen2)) {
  $linha = fgets($fopen2, 4096);
  echo $linha."<br>";
}
fclose ($fopen2);

