<?php

class Compra{

	var $idCompra;
	var $idFornecedor;
	var $idPeca;
	var $dataCompra;
	var $valorCompra;
	var $notaFiscal;

	function __construct( $p ){
		$this->idCompra = $p['idCompra'];
		$this->idFornecedor = $p['idFornecedor'];
		$this->idPeca = $p['idPeca'];
		$this->dataCompra = $p['dataCompra'];
		$this->valorCompra = $p['valorCompra'];
		$this->notaFiscal = $p['notaFiscal'];
	}
	
	static function exibirCompras( $key ){
		$query = "select c.* from compra order by c.dataCompra desc";
		return $query;
	}

	static function consultaCompra( $id ){
		$query = "select * from compra where idcompra=$id";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select * from compra where idcompra=$id";
		return $query;
	}

	function novo(){
		$query = "insert into compra values (null,
											$this->idFornecedor,
											$this->idPeca,
											$this->dataCompra,
											$this->valorCompra,
											$this->notaFiscal)";
		return $query;
	}

	function editar( $id ){
		$query = "update compra set idFornecedor         =  $this->idFornecedor, 
					                    idPeca           =  $this->idPeca, 
										dataCompra       =	$this->dataCompra,	
										valorCompra      =	$this->valorCompra,		
										notaFiscal		 =  $this->notaFiscal 
						where idcompra=$id";
		return $query;
	}

	static function removerId( $id ){
		$query = "delete from compra where idcompra=$id";
		return $query;
	}

	static function verificarCompra( $id ){
		$query = "select * from compra where idcompra=$id";
		return $query;
	}

	static function verificarCompraFornecedor( $id ){
		$query = "select * from compra where idfornecedor=$id";
		return $query;
	}
}
