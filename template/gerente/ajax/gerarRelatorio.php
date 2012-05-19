<?php 

session_start();

require_once("../pdf/fpdf.php");
require_once("../../function/formataData.php");


function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}


extract( $_POST );

/*

elseif( !empty( $FaturamentoPorPeriodoInicial ) && !empty( $FaturamentoPorPeriodoInicial ) ) {
	$dataInicial = $FaturamentoPorPeriodoInicial;
	$dataFinal = $FaturamentoPorPeriodoInicial;
	$relatorio = utf8_decode("RELATÓRIO DE FATURAMENTO POR PERÍODO");
} 

*/

if( !empty( $OSPorStatus ) ) {
	$key = $OSPorStatus;
	$relatorio = utf8_decode("RELATÓRIO DE OS POR STATUS");

$j = 0;
$dataAtual = date("d/m/Y - H:i");

$sql = new Conexao();
$sql->conecta();

$sql->consulta( Relatorio::statusOs( $key ) );
$status = $sql->resultado();

	$pdf = new FPDF('L');    
	$pdf->Open();    
	$pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetY(7);

	$pdf->Image('../../img/logo_lider.jpg',6,2,50,25);

	$pdf->SetY(11);
	$pdf->SetX(100);
	$pdf->Cell(80,10,$relatorio,0,0,'C');	

	$pdf->Line(6,30,290,30);

	$pdf->SetY(23);
	$pdf->SetX(248);
	$pdf->SetFont('Arial', 'B', 6);
	$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

	$pdf->SetY(40);

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetX(6);
	$pdf->Cell(45,7,strtoupper(utf8_decode($status['status'])),1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->SetX(6);
	$pdf->Cell(40,7,"Ordem de Servico",1,0,'C');
	$pdf->Cell(40,7,"Cliente",1,0,'C');
	$pdf->Cell(40,7,"Equipamento",1,0,'C');
	$pdf->Cell(40,7,"Modelo",1,0,'C');
	$pdf->Cell(40,7,"Serie",1,0,'C');
	$pdf->Cell(40,7,"Entrada",1,0,'C');
	$pdf->Cell(40,7,"Usuario",1,0,'C');
	$pdf->Ln();

	

	$ok = $sql->consulta ( Relatorio::osPorStatus( $key ) );

	while ( $l = $sql->resultado() ) {

		if (($j % 2) == 1) {

			$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
	        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['uNome'],1,0,'C',1);
	        $pdf->Ln();

    	} else {
    		
    		$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
	        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['uNome'],1,0,'C',1);
	        $pdf->Ln();

    	}

    	$j++;

	} // FIM DO WHILE RESULTADO
	
	$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

sleep(1);

} // FIM DO IF OSPorStatus

elseif( !empty( $OSPorPeriodoInicial ) && !empty( $OSPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $OSPorPeriodoInicial );
	$dataFinal = data_ymd( $OSPorPeriodoFinal );
	$relatorio = utf8_decode("RELATÓRIO DE OS POR PERÍODO");

$j = 0;
$dataAtual = date("d/m/Y - H:i");


$sql = new Conexao();
$sql->conecta();

	$pdf = new FPDF('L');    
	$pdf->Open();    
	$pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetY(7);

	$pdf->Image('../../img/logo_lider.jpg',6,2,50,25);

	$pdf->SetY(11);
	$pdf->SetX(100);
	$pdf->Cell(80,10,$relatorio,0,0,'C');	

	$pdf->Line(6,30,290,30);

	$pdf->SetY(23);
	$pdf->SetX(248);
	$pdf->SetFont('Arial', 'B', 6);
	$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

	$pdf->SetY(40);

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetX(6);
	$pdf->Cell(75,7,"Periodo de ".$OSPorPeriodoInicial." a ".$OSPorPeriodoFinal,1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->SetX(6);
	$pdf->Cell(40,7,"Ordem de Servico",1,0,'C');
	$pdf->Cell(40,7,"Cliente",1,0,'C');
	$pdf->Cell(40,7,"Equipamento",1,0,'C');
	$pdf->Cell(40,7,"Modelo",1,0,'C');
	$pdf->Cell(40,7,"Serie",1,0,'C');
	$pdf->Cell(30,7,"Entrada",1,0,'C');
	$pdf->Cell(50,7,"Status",1,0,'C');
	$pdf->Ln();

	

	$ok = $sql->consulta ( Relatorio::osPorPeriodo( $dataInicial, $dataFinal ) );

	while ( $l = $sql->resultado() ) {

		if (($j % 2) == 1) {

			$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
	        $pdf->Cell(30,7,data_dmy( $l['entrada'] ),1,0,'C',1);
	        $pdf->Cell(50,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
	        $pdf->Ln();

    	} else {
    		
    		$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
	        $pdf->Cell(30,7,data_dmy( $l['entrada'] ),1,0,'C',1);
	        $pdf->Cell(50,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
	        $pdf->Ln();

    	}

    	$j++;

	} // FIM DO WHILE RESULTADO
	
	$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

sleep(1);

} // FIM DO IF OSPorPeriodo

elseif( !empty( $ComprasPorPeriodoInicial ) && !empty( $ComprasPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $ComprasPorPeriodoInicial );
	$dataFinal = data_ymd( $ComprasPorPeriodoFinal );
	$relatorio = utf8_decode("RELATÓRIO DE COMPRAS POR PERÍODO");

$j = 0;
$dataAtual = date("d/m/Y - H:i");


$sql = new Conexao();
$sql->conecta();

	$pdf = new FPDF('L');    
	$pdf->Open();    
	$pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetY(7);

	$pdf->Image('../../img/logo_lider.jpg',6,2,50,25);

	$pdf->SetY(11);
	$pdf->SetX(100);
	$pdf->Cell(80,10,$relatorio,0,0,'C');	

	$pdf->Line(6,30,290,30);

	$pdf->SetY(23);
	$pdf->SetX(248);
	$pdf->SetFont('Arial', 'B', 6);
	$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

	$pdf->SetY(40);

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetX(6);
	$pdf->Cell(75,7,"Periodo de ".$ComprasPorPeriodoInicial." a ".$ComprasPorPeriodoFinal,1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->SetX(6);
	$pdf->Cell(40,7,"Pedido",1,0,'C');
	$pdf->Cell(20,7,"QTD.",1,0,'C');
	$pdf->Cell(30,7,"Data",1,0,'C');
	$pdf->Cell(40,7,"Codigo",1,0,'C');
	$pdf->Cell(70,7,"Peça",1,0,'C');
	$pdf->Cell(45,7,"Marca",1,0,'C');
	$pdf->Cell(40,7,"Status",1,0,'C');
	$pdf->Ln();

	

	$ok = $sql->consulta ( Relatorio::comprasPorPeriodo( $dataInicial, $dataFinal ) );

	while ( $l = $sql->resultado() ) {

		if (($j % 2) == 1) {

			$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(40,7,$l['idcomprapeca'],1,0,'C',1);
			$pdf->Cell(20,7,$l['qtd'],1,0,'C',1);
	        $pdf->Cell(30,7,data_dmy( $l['datapedido'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['codigopeca'],1,0,'C',1);
	        $pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
	        $pdf->Cell(45,7,$l['marcapeca'],1,0,'C',1);
	        $pdf->Cell(40,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
	        $pdf->Ln();

    	} else {
    		
    		$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(40,7,$l['idcomprapeca'],1,0,'C',1);
			$pdf->Cell(20,7,$l['qtd'],1,0,'C',1);
	        $pdf->Cell(30,7,data_dmy( $l['datapedido'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['codigopeca'],1,0,'C',1);
	        $pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
	        $pdf->Cell(45,7,$l['marcapeca'],1,0,'C',1);
	        $pdf->Cell(40,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
	        $pdf->Ln();

    	}

    	$j++;

	} // FIM DO WHILE RESULTADO
	
	$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

sleep(1);

} // FIM DO IF ComprasPorPeriodo

elseif( !empty( $FaturamentoPorPeriodoInicial ) && !empty( $FaturamentoPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $FaturamentoPorPeriodoInicial );
	$dataFinal = data_ymd( $FaturamentoPorPeriodoFinal );
	$relatorio = utf8_decode("RELATÓRIO DE FATURAMENTO POR PERÍODO");

$j = 0;
$dataAtual = date("d/m/Y - H:i");


$sql = new Conexao();
$sql->conecta();

	$pdf = new FPDF('L');    
	$pdf->Open();    
	$pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetY(7);

	$pdf->Image('../../img/logo_lider.jpg',6,2,50,25);

	$pdf->SetY(11);
	$pdf->SetX(100);
	$pdf->Cell(80,10,$relatorio,0,0,'C');	

	$pdf->Line(6,30,290,30);

	$pdf->SetY(23);
	$pdf->SetX(248);
	$pdf->SetFont('Arial', 'B', 6);
	$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

	$pdf->SetY(40);

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetX(6);
	$pdf->Cell(75,7,"Periodo de ".$FaturamentoPorPeriodoInicial." a ".$FaturamentoPorPeriodoFinal,1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->SetX(6);
	$pdf->Cell(40,7,"Ordem de Servico",1,0,'C');
	$pdf->Cell(40,7,"Mao de Obra",1,0,'C');
	$pdf->Cell(40,7,"Pecas Usadas",1,0,'C');
	$pdf->Cell(40,7,"Total",1,0,'C');
	$pdf->Cell(40,7,"Entrada",1,0,'C');
	$pdf->Cell(40,7,"Saida",1,0,'C');
	$pdf->Ln();

	

	$ok = $sql->consulta ( Relatorio::faturamentoPorPeriodo( $dataInicial, $dataFinal ) );

	while ( $l = $sql->resultado() ) {

		if (($j % 2) == 1) {

			$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,"R$ ".$l['maodeobra'],1,0,'C',1);
	        $pdf->Cell(40,7,"R$ ".$l['valorpecasusadas'],1,0,'C',1);
	        $pdf->Cell(40,7,"R$ ".( $l['valorpecasusadas'] + $l['maodeobra'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['entrada'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['entrega'],1,0,'C',1);
	        $pdf->Ln();

    	} else {
    		
    		$pdf->SetFont('Arial', '', 8);
			
			$pdf->SetX(6);
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
			$pdf->Cell(40,7,"R$ ".$l['maodeobra'],1,0,'C',1);
	        $pdf->Cell(40,7,"R$ ".$l['valorpecasusadas'],1,0,'C',1);
	        $pdf->Cell(40,7,"R$ ".( $l['valorpecasusadas'] + $l['maodeobra'] ),1,0,'C',1);
	        $pdf->Cell(40,7,$l['entrada'],1,0,'C',1);
	        $pdf->Cell(40,7,$l['entrega'],1,0,'C',1);
	        $pdf->Ln();

    	}

    	$j++;

	} // FIM DO WHILE RESULTADO
	
	$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

sleep(1);

} // FIM DO IF FaturamentoPorPeriodo