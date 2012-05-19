<?php

class TipoEquipamento{

	var $tipo;
	var $maodeobra;

	function __construct( $p ){
		$this->tipo = $p['tipo'];
		$this->maodeobra = $p['valor'];
	}
	
	static function listar(){
		$query = "select * from tiposequipamentos order by tipo asc";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select * from tiposequipamentos where idtiposequipamentos=$id order by tipo asc";
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
						where idtiposequipamentos=$id";
		return $query;
	}

	static function remover( $id ){
		$query = "delete from tiposequipamentos where idtiposequipamentos=$id";
		return $query;
	}

	static function verificarOS( $id ){
		$query="select * from tiposequipamentos te
					inner join equipamento e on e.idtiposequipamentos = te.idtiposequipamentos
						where te.idtiposequipamentos=$id";
		return $query;
	}

}