<?php

class Uf{
	
	static function exibirUf(){
		$query = "select * from uf order by id_uf asc";
		return $query;
	}
	
}