<?php


class Peca{

	var $codigopeca;
	var $nomepeca;
	var $marcapeca;
	var $modelopeca;
	var $quantidade;
	var $precounidade;
	var $dataentrada;

	function __construct( $p ){
		$this->codigopeca = $p['codigopeca'];
		$this->nomepeca = $p['nomepeca'];
		$this->marcapeca = $p['marcapeca'];
		$this->modelopeca = $p['modelopeca'];
		$this->quantidade = $p['quantidade'];
		$this->precounidade = $p['precounidade'];
		$this->dataentrada = $p['dataentrada'];

	}

	function consultaCodigo(){
		$query = "select codigopeca from peca where codigopeca=$codigopeca";
	}

	function novaPeca(){
		$query = "insert into peca values (null, 
										  '$this->codigopeca',
										  '$this->nomepeca',
										  '$this->marcapeca',
										  '$this->modelopeca',
										  '$this->quantidade',
										  '$this->precounidade',
										  '$this->dataentrada')";
		return $query;
	}


}

$testar = new Peca();
( $peca->novaPeca(1,'abc','tese','qwer',10,10,'15/02/2012') ) ? $msg = "conectado" : $msg = "não conectado";
echo $msg,"<br />";
/*
$busca = "select * from cliente";
$testar->consulta($busca);

while( $dados = $testar->resultado() )
echo $dados['nome']; */
?>
