<?php

class Pagamento
{
	
	function __construct()
	{
		# code...
	}

	static function listarTipo(){
		$query = "select * from tipopagamento";
		return $query;
	}

	static function pagar( $p ){
		if ($p['vp'] != null) {
			$vp = $p['vp'];
		}else{
			$vp = 0;
		}
		$query = "insert into pagos values (null,".$p['idos'].",".$p['tp'].",".$p['total'].",$vp)";
		return $query;
	}
}