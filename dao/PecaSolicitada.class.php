<?php

class PecaSolicitada{

	var $idpecasolicitada;
	var $idordemdeservico;
	var $idpeca;
	var $qtdsolicitada;
	var $posicao;

	function __construct( $p ){
		$this->idpecasolicitada = $p['idpecasolicitada'];
		$this->idordemdeservico = $p['idordemdeservico'];
		$this->idpeca           = $p['idpeca'];
		$this->qtdsolicitada    = $p['qtdsolicitada'];
		$this->posicao          = $p['posicao'];
	}
	
	static function consultaPorId( $idpecasolicitada ){
		$query = "select * from pecasolicitada where idpecasolicitada = $idpecasolicitada";

		return $query;
	}
	
	static function consultaPorOS($idordemservico){
		$query = "select * from pecasolicitada where idordemservico = $idordemservico";
		
		return $query;
	}

	function novaPecaSolicitada(){
		$query = "insert into pecasolicitada values (	null,							
								$this->idordemdeservico,
								$this->idpeca,
								$this->qtdsolicitada,
								$this->posicao')";
		
		return $query;
	}

	
	
	function editarPecaSolicitada( $idpecasolicitada ){
		$query = "update pecasolicitada 
                          set idordemservico = $this->idordemdeservico,
			      idpeca         = $this->idpeca,
			      qtdsolicitada  = $this->qtdsolicitada,
			      posicao        = $this->posicao
			  where idpecasolicitada = $idpecasolicitada";
		return $query;
	}
	
	
	
	static function removerPecaSolicitada( $idpecasolicitada ){
		$query = "delete from pecasolicitada
                          where idpecasolicitada = $idpecasolicitada";

		return $query;
	}
	
}
?>
