<?php

class Equipamento{

	var $marcaequip;
	var $modeloequip;
	var $tipoequip;
	var $numserie;

	function __construct( $p ){
		$this->marcaequip = $p['marca'];
		$this->modeloequip = $p['modelo'];
		$this->tipoequip = $p['tipo'];
		$this->numserie = $p['serie'];
	}
	
	static function exibirEquipamentos( $key ){
		$query = "select e.*, c.*, count(e.idcliente) as qtd from equipamento e
					right join cliente c on c.idcliente = e.idcliente
						where c.nome like '%$key%' or c.cpf like '%$key%' or c.telefone like '%$key%' or e.marcaequip like '%$key%' or e.modeloequip like '%$key%' or numserie like '%$key%'
							group by e.idcliente
								order by c.nome asc";
		return $query;
	}

	static function consultaCliente( $id ){
		$query = "select * from equipamento where idcliente=$id";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select * from equipamento where idequipamento=$id";
		return $query;
	}

	function novo( $idcliente ){
		$query = "insert into equipamento values (null, $idcliente, '$this->marcaequip', '$this->modeloequip', '$this->tipoequip', '$this->numserie')";
		return $query;
	}

	function editar( $id ){
		$query = "update equipamento set 
					marcaequip='$this->marcaequip',
					modeloequip='$this->modeloequip',
					tipoequip='$this->tipoequip',
					numserie='$this->numserie'
						where idequipamento=$id";
		return $query;
	}

	static function removerId( $id ){
		$query = "delete from equipamento where idequipamento=$id";
		return $query;
	}

	static function verificarEquipamento( $id ){
		$query = "select * from equipamento where idcliente=$id";
		return $query;
	}
}