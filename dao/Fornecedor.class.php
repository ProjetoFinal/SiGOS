<?php

class Fornecedor{

	var $idfornecedor;
	var $razaosocial;
	var $nomefantasia;
	var $cnpj;
	var $inscest;
	var $contato;
	var $telefone;
	var $cep;
	var $logradouro;
	var $numero;
	var $complemento;
	var $bairro;
	var $cidade;
	var $uf;


	function __construct( $p ){
		$this->idfornecedor = $p['idfornecedor'];
		$this->razaosocial = $p['razaosocial'];
		$this->nomefantasia = $p['nomefantasia'];
		$this->cnpj = $p['cnpj'];
		$this->inscest = $p['inscest'];
		$this->contato = $p['contato'];
		$this->telefone = $p['telefone'];
		$this->cep = $p['cep'];
		$this->logradouro = $p['logradouro'];
		$this->numero = $p['numero'];
		$this->complemento = $p['complemento'];
		$this->bairro = $p['bairro'];
		$this->cidade = $p['cidade'];
		$this->uf = $p['uf'];
	}
	
	static function exibirFornecedores(){
		$query = "select * from fornecedor order by razaosocial asc";
		return $query;
	}

	static function consultaFornecedor( $id ){
		$query = "select * from fornecedor where idfornecedor=$id";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select * from fornecedor where idfornecedor=$id";
		return $query;
	}

	static function consultaKey( $key ){
		if ( $key != null ) {
			$query = "select * from fornecedor order by nomefantasia asc";
		}
		else {
			$query = "select * from fornecedor  where nomefantasia like '%$key%' or cnpj like '%$key%' 
				  order by nomefantasia asc";
		}		
		return $query;
	}
	function novo(){
		$query = "insert into fornecedor values (null, 
												'$this->razaosocial', 
												'$this->nomefantasia', 
												'$this->cnpj',	
												'$this->inscest',		
												'$this->contato',	
												'$this->telefone',
												'$this->cep',
												'$this->logradouro',
												'$this->numero',
												'$this->complemento',
												'$this->bairro',
												'$this->cidade',
												'$this->uf')";
		return $query;
	}

	function editar( $id ){
		$query = "update fornecedor set razaosocial  =  '$this->razaosocial', 
					                    nomefantasia =  '$this->nomefantasia', 
										cnpj         =	'$this->cnpj',	
										inscest      =	'$this->inscest',		
										contato		 =  '$this->contato',	
										telefone	 =  '$this->telefone',
										cep			 =  '$this->cep',
										logradouro   = 	'$this->logradouro',
										numero		 =  '$this->numero',
										complemento  =  '$this->complemento',
										bairro       =  '$this->bairro',
										cidade       =  '$this->cidade',
										uf			 =  '$this->uf' 
						where idfornecedor=$id";
		return $query;
	}

	static function removerId( $id ){
		$query = "delete from fornecedor where idfornecedor=$id";
		return $query;
	}

	static function verificarComprasFornecedor( $id ){
		$query = "select * from compra where idfornecedor=$id";
		return $query;
	}
}