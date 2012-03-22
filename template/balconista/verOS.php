<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("../function/formataData.php");

$sql = new Conexao();
$sql->conecta();

$sql->consulta( OS::arquivoImp( $_GET['idos'] ) );

$l = $sql->resultado();

$fopen2 = fopen( $l['caminhoimpressao'], "r" );

while (!feof ($fopen2)) {
  $linha = fgets($fopen2, 4096);
  echo $linha."<br>";
}
fclose ($fopen2);