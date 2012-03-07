<?php

class Cliente{
	
	var $nome;
	var $identidade;
	var $orgaoexpedidor;
	var $cpf;
	var $nascimento;
	var $telefone;
	var $celular;
	var $cep;
	var $logradouro;
	var $numero;
	var $complemento;
	var $bairro;
	var $cidade;
	var $uf;
	var $email;

	function __construct( $p ){
		$this->nome = $p['nome'];
		$this->identidade = $p['identidade'];
		$this->orgaoexpedidor = $p['orgaoexpedidor'];
		$this->cpf = $p['cpf'];
		$this->nascimento = data_ymd( $p['nascimento'] );
		$this->telefone = $p['telefone'];
		$this->celular = $p['celular'];
		$this->cep = $p['cep'];
		$this->logradouro = $p['logradouro'];
		$this->numero = $p['numero'];
		$this->complemento = $p['complemento'];
		$this->bairro = $p['bairro'];
		$this->cidade = $p['cidade'];
		$this->uf = $p['uf'];
		$this->email = $p['email'];
	}

	function novoCliente(){
		$query = "insert into cliente values (null, '$this->nome', '$this->identidade', '$this->orgaoexpedidor', '$this->cpf', '$this->nascimento', '$this->telefone', '$this->celular', '$this->cep', '$this->logradouro', '$this->numero', '$this->complemento', '$this->bairro', '$this->cidade', '$this->uf', '$this->email')";
		return $query;
	}

	static function consultaKey( $key ){
		$query = "select * from cliente
					where nome like '%$key%' or cpf like '%$key%' or telefone like '%$key%' or celular like '%$key%' or email like '%$key%'
						order by nome asc";
		return $query;
	}

	static function consultaId( $id ){
		$query = "select * from cliente where idcliente=$id";
		return $query;
	}

	function editar( $id ){
		$query = "update cliente set
					nome='$this->nome', 
					identidade='$this->identidade',
					orgaoexpedidor='$this->orgaoexpedidor',
					cpf='$this->cpf',
					nascimento='$this->nascimento',
					telefone='$this->telefone',
					celular='$this->celular',
					cep='$this->cep',
					logradouro='$this->logradouro',
					numero='$this->numero',
					complemento='$this->complemento',
					bairro='$this->bairro',
					cidade='$this->cidade',uf='$this->uf',
					email='$this->email'
						where idcliente=$id";
		return $query;
	}

	static function verificaCPF( $cpf ){
		$query = "select * from cliente where cpf='$cpf'";
		return $query;
	}

	static function removerId( $id ){
		$query = "delete from cliente where idcliente=$id";
		return $query;
	}

}