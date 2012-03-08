<?php

class OS{
	
	var $status;
	var $defeito;
	var $acessorios;
	var $solucao;

	function __construct( $p ){
		$this->status = $p['status'];
		$this->defeito = $p['defeito'];
		$this->acessorios = $p['acessorios'];
		$this->solucao = $p['solucao'];
	}

	static function listarOS( $key ){
		$queryA = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus ";
		$queryB = "order by os.entrada desc, s.status asc";
		if( $key == 0){
			$query = $queryA.$queryB;
		}
		return $query;
	}

}