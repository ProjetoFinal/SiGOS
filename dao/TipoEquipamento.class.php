<?php

class TipoEquipamento{

	var $tipo;
	var $maodeobra;

	function __construct( $p ){
		$this->tipo = $p['tipo'];
		$this->maodeobra = $p['maodeobra'];
	}
	
	static function listar(){
		$query = "select * from tiposequipamentos order by tipo asc";
		return $query;
	}

	function novo(){
		$query = "insert into tiposequipamentos values (null, '$this->tipo', '$this->maodeobra')";
		return $query;
	}

	function editar( $id ){
		$query = "update tiposequipamentos set 
					tipo='$this->tipo',
					maodeobra='$this->maodeobra'
						where id_tiposequipamentos=$id";
		return $query;
	}

}