<?php

class Relatorio {
	
	static function osPorStatus( $key ){
		$query = "select equipamento.marcaequip AS marcaequip, equipamento.modeloequip AS modeloequip, equipamento.numserie AS numserie, 				usuario.nome AS uNome, cliente.nome AS cNome, idordemdeservico, entrada from ordemdeservico os
						inner join equipamento on equipamento.idequipamento = os.idequipamento
						inner join usuario on usuario.idusuario = os.idusuario
						inner join cliente on cliente.idcliente = equipamento.idcliente
						where os.idstatus = $key";

		return $query;
	}

	static function osTodosStatus(){
		$query = "select equipamento.marcaequip AS marcaequip, equipamento.modeloequip AS modeloequip, equipamento.numserie AS numserie, 				statusos.status AS status, cliente.nome AS cNome, idordemdeservico, entrada from ordemdeservico os
						inner join equipamento on equipamento.idequipamento = os.idequipamento
						inner join statusos on statusos.idStatus = os.idstatus
						inner join cliente on cliente.idcliente = equipamento.idcliente
						group by os.idordemdeservico
						order by statusos.status";

		return $query;
	}

	static function statusOs( $key ){
		$query = "select statusos.status AS status from ordemdeservico os
					inner join statusos on statusos.idstatus = os.idstatus
					where os.idstatus = $key";

		return $query;
	}

	static function osPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select equipamento.marcaequip AS marcaequip, equipamento.modeloequip AS modeloequip, equipamento.numserie AS numserie, 				statusos.status AS status, cliente.nome AS cNome, idordemdeservico, entrada from ordemdeservico os
						inner join equipamento on equipamento.idequipamento = os.idequipamento
						inner join statusos on statusos.idStatus = os.idstatus
						inner join cliente on cliente.idcliente = equipamento.idcliente
						where os.entrada >= '$dataInicial' AND os.entrada <= '$dataFinal'";
		
		return $query;
	}

	static function comprasPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select idcomprapeca, qtd, status, datapedido, peca.codigopeca AS codigopeca, peca.nomepeca AS nomepeca, peca.marcapeca AS 			marcapeca, peca.precounidade AS precounidade from comprapeca
						inner join peca on peca.idpeca = comprapeca.idpeca
						where comprapeca.datapedido >= '$dataInicial' AND comprapeca.datapedido <= '$dataFinal'";

		return $query;
	}

	static function faturamentoPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select maodeobra, valorpecasusadas, ordemdeservico.idordemdeservico, ordemdeservico.entrada, ordemdeservico.entrega 
					from orcamento 
						inner join ordemdeservico on ordemdeservico.idordemdeservico = orcamento.idordemdeservico 
						where ordemdeservico.entrega >= '$dataInicial' AND ordemdeservico.entrega <= '$dataFinal'";

		return $query;
	}

	static function faturadoDiarioPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select os.entrada AS entrada, sum(o.maodeobra + o.valorpecasusadas) AS total
					from ordemdeservico os, orcamento o
						where os.idordemdeservico = o.idordemdeservico
							and os.idstatus = 10
							and os.entrega between '$dataInicial' and '$dataFinal'
								group by os.entrada";

		return $query;
	}

	static function despesasPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select cp.datapedido AS data, sum(cp.qtd * p.precounidade) AS total
					from comprapeca cp, peca p
						where cp.idpeca = p.idpeca
							and cp.datapedido between '$dataInicial' and '$dataFinal'
								group by cp.datapedido";

		return $query;
	}

	static function maodeobraPorPeriodo( $dataInicial, $dataFinal ){
		$query = "select te.tipo AS tipo, sum(te.maodeobra) AS total
					from ordemdeservico os, equipamento e, tiposequipamentos te
						where os.idequipamento = e.idequipamento
							and e.idtiposequipamentos = te.idtiposequipamentos
							and os.idstatus = 10
							and os.entrega between '$dataInicial' and '$dataFinal'
								group by te.tipo";

		return $query;
	}

	static function verCompraPdf( $datapedido ){
		$query = "select p.nomepeca AS nomepeca, qtd, status from comprapeca cp
					inner join peca p on p.idpeca = cp.idpeca
						where cp.datapedido = '$datapedido'";

		return $query;
	}

}