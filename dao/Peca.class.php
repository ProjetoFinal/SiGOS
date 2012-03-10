<?php

class Peca{

	var $codigoPeca;
	var $nomePeca;
	var $marcaPeca;
	var $modeloPeca;
	var $quantidade;
	var $precoUnidade;
	var $dataEntrada;

	function __construct( $p ){
		$this->codigoPeca = $p['codigoPeca'];
		$this->nomePeca = $p['nomePeca'];
		$this->marcaPeca = $p['marcaPeca'];
		$this->modeloPeca = $p['modeloPeca'];
		$this->quantidade = $p['quantidade'];
		$this->precoUnidade = $p['precoUnidade'];
		$this->dataEntrada = $p['dataEntrada'];

	}

	function consultaCodigo(){
		$query = "select * from peca where codigoPeca='$codigoPeca'";
	}

	function novaPeca(){
		$query = "insert into peca values (null, '$this->codigoPeca', '$this->nomePeca', '$this->marcaPeca', '$this->modeloPeca', '$this->quantidade', '$this->precoUnidade','$this->dataEntrada')";
		echo "$query";
		return $query;
	}


}


?>