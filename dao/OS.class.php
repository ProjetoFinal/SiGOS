<?php

class OS{
	
	var $idequipamento;
	var $idstatus;
	var $status;
	var $defeito;
	var $acessorios;
	var $solucao;

	function __construct( $p ){
		$this->idequipamento = $p['idequipamento'];
		$this->idstatus = $p['idstatus'];
		$this->status = $p['status'];
		$this->defeito = $p['defeito'];
		$this->acessorios = $p['acessorios'];
		$this->solucao = $p['solucao'];
	}

	static function listarOS( $key ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
									inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%'
										order by os.idstatus desc, os.entrada asc";
		return $query;
	}

	static function listarOsId( $key, $idstatus ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where (c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%') and os.idstatus=$idstatus
										order by os.entrada asc";
		return $query;
	}

	static function listarOsAssumidas( $key, $idusuario ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip, orc.idorcamento from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
								left join orcamento orc on orc.idordemdeservico = os.idordemdeservico
									where (c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%') and os.idusuario=$idusuario and (os.idstatus=2 or os.idstatus=6)
										order by os.idstatus desc, os.entrada asc";
		return $query;
	}

	static function listarOsOrcadas( $key, $idusuario ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where (c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%') and os.idusuario=$idusuario and os.idstatus=3
										order by os.idstatus desc, os.entrada asc";
		return $query;
	}

	static function listarOsPrioridade( $key, $idusuario ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where (c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%') and os.idusuario=$idusuario and os.idstatus=9
										order by os.idstatus desc, os.entrada asc";
		return $query;
	}

	static function listarOsAprovadas( $key, $idusuario ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where (c.nome like '%$key%' or os.idordemdeservico like '%$key%' or s.status like '%$key%') and os.idusuario=$idusuario and os.idstatus=4
										order by os.entrada asc";
		return $query;
	}

	static function listarOsAguardandoPeca(){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
						inner join cliente c on c.idcliente = e.idcliente 
						inner join statusos s on s.idstatus = os.idstatus 
						inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
						where os.idstatus=7
						order by os.entrada asc";
		return $query;
	}
	function nova(){
		$query = "insert into ordemdeservico (idequipamento,idstatus,defeito,acessorios,entrada) values ($this->idequipamento, 1, '$this->defeito', '$this->acessorios', now())";
		return $query;
	}

	function verificarEquipOS(){
		$query = "select * from ordemdeservico where idequipamento=$this->idequipamento and idstatus <> 10";
		return $query;
	}

	static function attCaminhoImp( $id, $arquivo ){
		$query = "update ordemdeservico set caminhoimpressao='$arquivo' where idordemdeservico=$id";
		return $query;
	}

	static function impOS( $id ){
		$query = "select os.*, e.*, s.status, c.nome, c.cpf, c.telefone, te.tipo as tipoequip from ordemdeservico os 
						inner join equipamento e on e.idequipamento = os.idequipamento 
							inner join cliente c on c.idcliente = e.idcliente 
								inner join statusos s on s.idstatus = os.idstatus 
								inner join tiposequipamentos te on te.idtiposequipamentos = e.idtiposequipamentos 
									where idordemdeservico=$id 
										order by os.entrada desc, s.status asc";
		return $query;
	}

	static function arquivoImp( $id ){
		$query = "select * from ordemdeservico where idordemdeservico=$id";
		return $query;
	}

	static function contadorOS( $idstatus, $idusuario ){
		$sql = new Conexao();
		$sql->conecta();
		if( $idstatus == 1 ){
			$sql->consulta( "select count(idstatus) as n from ordemdeservico where idstatus=$idstatus" );
		}else{
			$sql->consulta( "select count(idstatus) as n from ordemdeservico where idstatus=$idstatus and idusuario=$idusuario" );	
		}		
		$l = $sql->resultado();
		return $l['n'];
	}

	static function assumirOs( $idusuario, $idos, $idstatus ){
		$query = "update ordemdeservico set idusuario=$idusuario, idstatus=$idstatus where idordemdeservico=$idos";
		return $query;
	}

	static function consultarOs( $idos ){
		$query = "select os.*, e.*, t.tipo, o.* from ordemdeservico os
					inner join orcamento o on o.idordemdeservico = os.idordemdeservico
					inner join equipamento e on e.idequipamento = os.idequipamento
					inner join tiposequipamentos t on t.idtiposequipamentos = e.idtiposequipamentos
						where os.idordemdeservico=$idos";
		return $query;
	}

	static function attAcompanhamento( $id, $acomp ){
		$query = "update ordemdeservico set acompanhamento='$acomp' where idordemdeservico=$id";
		return $query;
	}

	static function finalizarManutencao( $id, $solucao ){
		$query = "update ordemdeservico set idstatus=8 ,solucao='$solucao' where idordemdeservico=$id";
		return $query;
	}

	static function reabrirPrioridade($idusuario, $idos){
		$query = "update ordemdeservico set idstatus=6 where idordemdeservico=$idos";
		return $query;
	}

	static function apRp( $idos, $idstatus ){
		$query = "update ordemdeservico set idstatus=$idstatus where idordemdeservico=$idos";
		return $query;
	}

}