<?php

class Compra{

	static function consulta(){
		$query = "select *, count(1) as qtdpeca from comprapeca group by datapedido order by status asc, datapedido asc";
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
		$query = "insert into comprapeca values (null,$idpeca,0,'aberta',now())";
		return $query;
	}

	static function consultaData( $data ){
		$query = "select * from comprapeca where datapedido='$data'";
		return $query;
	}

	static function verPeca( $data ){
		$query = "select cp.*, p.nomepeca from comprapeca cp 
					inner join peca p on p.idpeca = cp.idpeca
						where cp.datapedido='$data'";
		return $query;
	}

	static function finalizar( $datapedido ){
		$query = "update comprapeca set status='fechada' where datapedido='$datapedido'";
		return $query;
	}
	
	static function cancelar( $datapedido ){
		$query = "delete from comprapeca where datapedido='$datapedido'";
		return $query;
	}
}
