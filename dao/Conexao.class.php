<?php

class Conexao{
	
	var $host 		= "localhost";
	var $usuario 	= "root";
	var $senha 		= "";
	var $banco 		= "sigos";

	var $conexao    = null;
    var $query      = null;

	function conecta() {
        $this->conexao = mysql_connect($this->host, $this->usuario, $this->senha);
        $status = mysql_select_db($this->banco, $this->conexao);
        mysql_set_charset('utf8');
        return $status;
    }
 
    function consulta($param) {
        $this->query = mysql_query($param);
        return $this->query;
    }
 
    function resultado() {
        return mysql_fetch_assoc($this->query);
    }


}

/*
$testar = new Conexao();
( $testar->conecta() ) ? $msg = "conectado" : $msg = "não conectado";
echo $msg,"<br />";

$busca = "select * from dados_empresa";
$testar->consulta($busca);

while( $dados = $testar->resultado() )
	echo $dados['razaosocial'];
*/
