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
										   now())";
		return $query;
	}


}


?>