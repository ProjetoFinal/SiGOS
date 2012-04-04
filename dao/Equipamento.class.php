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
		$query = "select e.*, c.*, te.tipo as tipoequip,count(e.idcliente) as qtd from cliente c 
					left join equipamento e on c.idcliente = e.idcliente 
						left join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
								where c.nome like '%$key%' or c.cpf like '%$key%' or c.telefone like '%$key%' or e.marcaequip like '%$key%' or e.modeloequip like '%$key%' or numserie like '%$key%' 
									group by c.idcliente 
										order by c.nome asc";
		return $query;
	}

	static function consultaCliente( $id ){
		$query = "select e.*, te.tipo as tipoequip, te.maodeobra from equipamento e
					inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos
						 where e.idcliente=$id";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select e.*, te.tipo as tipoequip from equipamento e
					inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
						where e.idequipamento=$id";
		return $query;
	}

	function novo( $idcliente ){
		$query = "insert into equipamento values (null, $idcliente, $this->tipoequip, '$this->marcaequip', '$this->modeloequip', '$this->numserie')";
		return $query;
	}

	function editar( $id ){
		$query = "update equipamento set 
					marcaequip='$this->marcaequip',
					modeloequip='$this->modeloequip',
					idtiposequipamentos=$this->tipoequip,
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