		<?php

class Peca{

	var $codigopeca;
	var $nomepeca;
	var $marcapeca;
	var $modelopeca;
	var $quantidade;
	var $precounidade;
	var $dataentrada;

	function __construct( $p ){
		$this->codigopeca = $p['codigopeca'];
		$this->nomepeca = $p['nomepeca'];
		$this->marcapeca = $p['marcapeca'];
		$this->modelopeca = $p['modelopeca'];
		$this->quantidade = $p['quantidade'];
		$this->precounidade = $p['precounidade'];
		$this->dataentrada = data_ymd($p['dataentrada']);

	}
	
	static function consultaID( $idpeca ){
		$query = "select * from peca where idpeca = $idpeca";

		return $query;
	}
	
	static function consultaCodigo( $codigopeca ){
		$query = "select codigopeca from peca where codigopeca=$codigopeca";
		return $query;
	}

	function novaPeca(){
		$query = "insert into peca values (null, 
										  '$this->codigopeca',
										  '$this->nomepeca',
										  '$this->marcapeca',
										  '$this->modelopeca',
										  '$this->quantidade',
										  '$this->precounidade',
										  '$this->dataentrada')";
		
		return $query;
	}

	static function consultaKey( $key ){
		$query = "select * from peca
					where codigopeca like '%$key[codigopeca]%' and nomepeca like '%$key[nomepeca]%' and
						marcapeca like '%$key[marcapeca]%' and modelopeca like '%$key[modelopeca]%'  
							order by nomepeca asc";

		return $query;
	}
	
	
	static function consultaTodasPecas(){
		$query = "select * from peca order by nomepeca asc";

		return $query;
	}
	
	function editarPeca( $idpeca ){
		$query = "update peca set
					codigopeca	='$this->codigopeca',
					nomepeca	='$this->nomepeca',
					marcapeca	='$this->marcapeca',
					modelopeca	='$this->modelopeca',
					quantidade	='$this->quantidade',
					precounidade	='$this->precounidade',
					dataentrada	='$this->dataentrada'
						where idpeca='$idpeca'";
		return $query;
	}
	
	static function verificaEstoquePeca( $idpeca ){
		$query = "select quantidade from peca where idpeca = '$idpeca'";
		
		return $query;
	}
	
	static function removerPeca( $idpeca ){
		$query = "delete from peca where idpeca = '$idpeca'";
		return $query;
	}

 	static function atualizaQuantidadeEstoquePeca( $idpeca, $quantidade ){
		$query = "update peca 
					set quantidade=$quantidade 
						where idpeca='$idpeca'";
		
		return $query;
	}
	
}

/*

$testar = new Peca();
( $peca->novaPeca() ) ? $msg = "conectado" : $msg = "não conectado";
echo $msg,"<br />";

$testar = new Peca();
$busca = "select * from peca";
$testar->consultaCodigo();

while( $dados = $testar->resultado() )
echo $dados['quantidade']; */
?>
