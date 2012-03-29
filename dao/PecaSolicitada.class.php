<?php

class PecaSolicitada{

	var $idpecasolicitada;
	var $idordemdeservico;
	var $idpeca;
	var $qtdsolicitada;
	var $posicao;

	function __construct( $p ){
		$this->idpecasolicitada = $p['idpecasolicitada'];
		$this->idordemdeservico = $p['idos'];
		$this->idpeca           = $p['idpeca'];
		$this->qtdsolicitada    = 1; //$p['qtdsolicitada'];
		//$this->posicao          = $p['posicao'];
	}
	
	static function consultaPorId( $idpecasolicitada ){
		$query = "select * from pecasolicitada where idpecasolicitada = $idpecasolicitada";

		return $query;
	}
	
	static function consultaPorOS($idordemservico){
		$query = "select ps.*, p.* from pecasolicitada ps 
					inner join peca p on p.idpeca = ps.idpeca
						where ps.idos=$idordemservico";
		
		return $query;
	}

	static function consultarPorOsPeca( $idos, $idpeca ){
		$query = "select * from pecasolicitada where idos=$idos and idpeca=$idpeca";
		return $query;
	}

	static function novaPecaSolicitada( $idos, $idpeca ){
		$query = "insert into pecasolicitada values ( null, $idos, $idpeca, 1)";
		return $query;
	}

	function editarPecaSolicitada( $idpecasolicitada ){
		$query = "update pecasolicitada 
                          set idos = $this->idordemdeservico,
			      			idpeca = $this->idpeca,
			      				qtdsolicitada = $this->qtdsolicitada
			 							 where idpecasolicitada = $idpecasolicitada";
		return $query;
	}
		
	static function removerPecaSolicitada( $idpecasolicitada ){
		$query = "delete from pecasolicitada
                          where idpecasolicitada = $idpecasolicitada";

		return $query;
	}

	static function addMaisUm( $idpecasolicitada, $qtd ){
		$query = "update pecasolicitada set qtdsolicitada=$qtd where idpecasolicitada=$idpecasolicitada";
		return $query;
	}

	static function menosUm( $id ){
		$query = "delete from pecasolicitada where idpecasolicitada=$id";
		return $query;
	}

}

