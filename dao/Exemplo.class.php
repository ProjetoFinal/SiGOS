<?php

// toda classe tem q receber o nome NomeDaClasse.class.php
// sempre usando camelCase

class Exemplo{

	function __construct( $param ) {
		var id_exemplo = $param['id_exemplo'];
		var exemploA = $param['exemploA'];
		var exeploB = $param['exemploB'];
	}
	
	function inserirAlgumaCoisa() {
		$query = 'insert into exemplo ( exemploa, exemplob ) values ( '$this->exemploA', '$this->exemploB')';
		return $query;
	}

	function exibirAlgumaCoisa() {
		$query = 'select * from exemplo where id_exemplo = $this->id_exemplo';
		return $query;
	}

	function editarAlgumaCoisa() {
		$query = 'update exemplo set 
					exemploa='$this->exemploA',
					exemplob='$this->exemploB'
						where id_exemplo=$this->id_exemplo';
		return $query;
	}
	
	function removerAlgumaCoisa() {
		$query = 'delete from exemplo where id_exemplo = $this->id_exemplo';
		return $query;
	}	

}