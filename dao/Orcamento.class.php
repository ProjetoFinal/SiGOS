<?php

class Orcamento{

	static function novo( $idos, $maodeobra ){
		$query = "insert into orcamento values (null, $idos, '$maodeobra', '0.00')";
		return $query;
	}
	
}