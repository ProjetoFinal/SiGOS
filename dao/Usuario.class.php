<?php

class Usuario{
	
	var $nome;
	var $login;
	var $senha;
	var $nivel;
	var $status;

	function __construct( $p ){
		$this->nome = $p['nome'];
		$this->login = $p['login'];
		$this->senha = sha1("51g05".$p['senha']."51g05");
		$this->nivel = $p['nivel'];
		$this->status = $p['status'];
	}

	function novoUsuario(){		
		$query = "insert into usuario values (null,'$this->nome','$this->login','$this->senha','$this->nivel','$this->status')";
		return $query;
	}

	static function consultaLogin( $login ){
		$query = "select * from usuario where login = '$login'";

		return $query;
	}

	static function consultaKey( $key ){
		$query = "select * from usuario
					where nome like '%$key[nome]%' and login like '%$key[login]%' and senha like '%$key[senha]%' and nivel like '%$key[nivel]%' and statususuario like '$key[status]%' 
						order by nome asc";
		return $query;
	}

	static function consultaTodosUsuarios(){
		$query = "select * from usuario order by nome asc";

		return $query;
	}

	static function consultaId( $idUsuario ){
		$query = "select * from usuario where idUsuario = '$idUsuario'";

		return $query;
	}

	function editarUsuario( $idUsuario ){
		$query = "update usuario set
					nome='$this->nome',
					login='$this->login',
					nivel='$this->nivel',
					statusUsuario='$this->status'
						where idUsuario='$idUsuario'";
		return $query;
	}

	static function verificaUsuarioEmOs( $idUsuario ){
		$query = "select * from ordemdeservico where idUsuario = '$idUsuario'";

		return $query;
	}

	static function removerUsuario( $idUsuario ){
		$query = "delete from usuario where idUsuario = '$idUsuario'";

		return $query;
	}

	static function resetarSenhaUsuario( $idUsuario ){
		$senhaPadrao = "PP@ssword12";
		$senhaSistema = "51g05";
		$senhaCriptografada = sha1($senhaSistema.$senhaPadrao.$senhaSistema);
		$query = "update usuario set senha='$senhaCriptografada' where idUsuario = '$idUsuario'";

		return $query;
	}

	function validarUsuario(){
		$query = "select * from usuario where login='$this->login' AND senha='$this->senha'";

		return $query;
	}

}