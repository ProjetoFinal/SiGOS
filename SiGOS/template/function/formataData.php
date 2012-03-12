<?php
# Formata Data para exibir na tela.						Ex.: 2010-12-30 para 30/12/2010
function data_dmy($data) {
	if ($data == ""){
		$datad = $data;
	} else {
		# separa pelo espaço, se for campo datetime (Data e Hora)
		$separa		= explode(" ",$data);
		$data		= $separa[0];
		$data_arr	= explode("-",$data);
		$datad		= $data_arr[2].'/'.$data_arr[1].'/'.$data_arr[0];
	}
	return $datad;
}

# Formata Data para cadastrar no banco de dados.		Ex.: 30/12/2010 para 2010-12-30
function data_ymd($data) {
	$data_arr = explode("/",$data);
	$datac = $data_arr[2].'-'.$data_arr[1].'-'.$data_arr[0];
	if ( ($data_arr[1] > 12) or ($data_arr[1] < 1) ) { // comparando mes
		$datac	= 1;
	} else {
		if ( ($data_arr[0] > 31) or ($data_arr[0] < 1) ) { // comparando dia
			$datac	= 2;
		} else {
			$datac = $datac;
		}
	}
	return $datac;
}