<?php
session_start();

require_once("../pdf/fpdf.php");
require_once("../../function/formataData.php");

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

$relatorio = utf8_decode("COMPROVANTE DE ATENDIMENTO DE PEÇAS");

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

			$pdf->SetY(25);

			/*

			$pdf->SetFont('Arial', 'B', 8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetX(6);
			$pdf->Cell(45,7,strtoupper(utf8_decode($status['status'])),1,0,'C');

			*/

			$ok = $sql->consulta ( PecaSolicitada::consultaPorOS( $_SESSION['idos'] ) );

			$p = $sql->resultado();

			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetFont('Arial', 'B', 8);

			$pdf->SetX(6);
			$pdf->Cell(40,7,"Ordem de Servico",1,0,'C');
			$pdf->Cell(70,7,$_SESSION['idos'],1,0,'C');

			$pdf->Ln();

			$pdf->SetX(6);
			$pdf->Cell(40,7,"Entrada",1,0,'C');
			$pdf->Cell(70,7,data_dmy( $p['entrada'] ),1,0,'C');

			$pdf->Ln();

			$pdf->SetX(6);
			$pdf->Cell(40,7,"Equipamento",1,0,'C');
			$pdf->Cell(70,7,$p['equip'],1,0,'C');
				
			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetX(6);
			$pdf->Cell(70,7,utf8_decode( "Peças" ),1,0,'C');
			$pdf->Cell(40,7,"QTD.",1,0,'C');
			$pdf->Ln();

			$ok1 = $sql->consulta ( PecaSolicitada::consultaPorOS( $_SESSION['idos'] ) );

			while ( $l = $sql->resultado() ) {

				if (($j % 2) == 1) {

					$pdf->SetFont('Arial', '', 8);
					
					$pdf->SetX(6);
					$pdf->SetFillColor(255,255,255);
					$pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
					$pdf->Cell(40,7,$l['qtdsolicitada'],1,0,'C',1);
			        $pdf->Ln();

		    	} else {
		    		
		    		$pdf->SetFont('Arial', '', 8);
					
					$pdf->SetX(6);
					$pdf->SetFillColor(200,200,200);
					$pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
					$pdf->Cell(40,7,$l['qtdsolicitada'],1,0,'C',1);
			        $pdf->Ln();

		    	}

		    	$j++;

			} // FIM DO WHILE RESULTADO

			$pdf->Ln(20);
			
			$pdf->SetX(8);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(100,7,utf8_decode( "Declaro ter recebido a(s) peça(s) acima em  ____ / ____ / ________" ),0,0,'C',1);
			$pdf->Ln(15);
			$pdf->Cell(100,7,"___________________________________________________________________",0,0,'C',1);
			$pdf->Ln();
			$pdf->SetX(42);
			$pdf->Cell(30,7,$p['usuario'],0,0,'C',1);
			
			$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

		sleep(1);

	
