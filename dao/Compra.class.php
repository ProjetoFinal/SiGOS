<?php

class Compra{

	static function consulta(){
		$query = "select *, count(1) as qtdpeca from comprapeca group by datapedido";
		return $query;
	}

	static function verificarOS( $id ){
		$query = "select cp.datapedido, cp.idpeca, ps.idos from comprapeca cp
 					left join pecasolicitada ps on ps.idpeca = cp.idpeca 
   						where cp.idcomprapeca=$id";
  		return $query;
	}

	static function verificaPeca( $id ){
		$query = "select * from comprapeca where idpeca=$id";
		return $query;
	}

	static function novo( $idpeca ){
		$query = "insert into comprapeca values (null,$idpeca,'aaa',now())";
		return $query;
	}
	
}
