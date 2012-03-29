<?php

class Orcamento{

	static function novo( $idos, $maodeobra ){
		$query = "insert into orcamento values (null, $idos, '$maodeobra', '0.00')";
		return $query;
	}

	static function updateValorPecasUsadas( $idor, $valor ){
		$query = "update orcamento set valorpecasusadas=$valor where idorcamento=$idor";
		return $query;
	}

	static function valorPecaUsada( $id ){
		$query = "select * from orcamento where idorcamento=$id";
		return $query;
	}
	
}