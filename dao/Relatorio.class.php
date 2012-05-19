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
		$query = "select idcomprapeca, qtd, status, datapedido, peca.codigopeca AS codigopeca, peca.nomepeca AS nomepeca, peca.marcapeca AS 			marcapeca from comprapeca
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

	static function teste( $key ){
		$query = "select equipamento.marcaequip AS marcaequip, usuario.nome AS uNome, cliente.nome AS cNome, idordemdeservico, entrada from 			ordemdeservico os
						inner join equipamento on equipamento.idequipamento = os.idequipamento
						inner join usuario on usuario.idusuario = os.idusuario
						inner join cliente on cliente.idcliente = equipamento.idcliente
						where os.idstatus = $key";

		return $query;
	}



}