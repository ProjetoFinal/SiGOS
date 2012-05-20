<?php 

session_start();

require_once("../pdf/fpdf.php");
require_once("../../function/formataData.php");


function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

if( $_POST['status'] ){

	extract( $_POST );

	if( empty($OSPorStatus) ){
	
		$relatorio = utf8_decode("RELATÓRIO DE ORDEM DE SERVIÇO");

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

			$pdf->Ln();
			
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetX(105);
			$pdf->Cell(70,7,"Todos os Status",0,0,'C');	

			$pdf->Line(6,30,290,30);

			$pdf->SetY(23);
			$pdf->SetX(248);
			$pdf->SetFont('Arial', 'B', 6);
			$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

			$pdf->SetY(40);

			/*

			$pdf->SetFont('Arial', 'B', 8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetX(6);
			$pdf->Cell(45,7,strtoupper(utf8_decode($status['status'])),1,0,'C');

			*/

			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetFont('Arial', 'B', 8);

			$pdf->SetX(6);
			$pdf->Cell(40,7,"Status",1,0,'C');
			$pdf->Cell(40,7,"Ordem de Servico",1,0,'C');
			$pdf->Cell(40,7,"Cliente",1,0,'C');
			$pdf->Cell(40,7,"Equipamento",1,0,'C');
			$pdf->Cell(40,7,"Modelo",1,0,'C');
			$pdf->Cell(40,7,"Serie",1,0,'C');
			$pdf->Cell(40,7,"Entrada",1,0,'C');		
			$pdf->Ln();

			

			$ok = $sql->consulta ( Relatorio::osTodosStatus() );

			while ( $l = $sql->resultado() ) {

				if (($j % 2) == 1) {

					$pdf->SetFont('Arial', '', 8);
					
					$pdf->SetX(6);
					$pdf->SetFillColor(255,255,255);
					$pdf->Cell(40,7,utf8_decode( $l['status'] ),1,0,'C',1);
					$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
					$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
			        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
			        $pdf->Ln();

		    	} else {
		    		
		    		$pdf->SetFont('Arial', '', 8);
					
					$pdf->SetX(6);
					$pdf->SetFillColor(255,255,255);
					$pdf->Cell(40,7,utf8_decode( $l['status'] ),1,0,'C',1);
					$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
					$pdf->Cell(40,7,$l['cNome'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['marcaequip'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['modeloequip'],1,0,'C',1);
			        $pdf->Cell(40,7,$l['numserie'],1,0,'C',1);
			        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
			        $pdf->Ln();

		    	}

		    	$j++;

			} // FIM DO WHILE RESULTADO

			$pdf->Ln();
			$pdf->Ln();

			$total = mysql_num_rows( $ok );
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(30,7,"Total de OS's: ",1,0,'C',1);
			$pdf->Cell(30,7,$total,1,0,'C',1);
			
			$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

		sleep(1);

	} // FIM DO IF DE VALIDAÇÃO DE STATUS EM BRANCO

	if( !empty( $OSPorStatus ) ) {
		$key = $OSPorStatus;
		$relatorio = utf8_decode("RELATÓRIO DE ORDEM DE SERVIÇO POR STATUS");

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

			$pdf->Ln();
			
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetX(105);
			$pdf->Cell(70,7,"Status ".strtoupper(utf8_decode($status['status'])),0,0,'C');	

			$pdf->Line(6,30,290,30);

			$pdf->SetY(23);
			$pdf->SetX(248);
			$pdf->SetFont('Arial', 'B', 6);
			$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

			$pdf->SetY(40);

			/*

			$pdf->SetFont('Arial', 'B', 8);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetX(6);
			$pdf->Cell(45,7,strtoupper(utf8_decode($status['status'])),1,0,'C');

			*/

			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetFont('Arial', 'B', 8);

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

			$pdf->Ln();
			$pdf->Ln();

			$total = mysql_num_rows( $ok );
			
			$pdf->SetX(6);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(30,7,"Total de OS's: ",1,0,'C',1);
			$pdf->Cell(30,7,$total,1,0,'C',1);
			
			$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

		sleep(1);

	} // FIM DO IF OSPorStatus
}


extract( $_POST );

/* ##### INÍCIO DA GERAÇÃO DE PDF's ##### */

if( !empty( $OSPorPeriodoInicial ) && !empty( $OSPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $OSPorPeriodoInicial );
	$dataFinal = data_ymd( $OSPorPeriodoFinal );

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$relatorio = utf8_decode("RELATÓRIO DE ORDEM DE SERVIÇO POR PERÍODO");

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

		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(103);
		$pdf->Cell(75,7,"Periodo de ".$OSPorPeriodoInicial." a ".$OSPorPeriodoFinal,0,0,'C');	

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$OSPorPeriodoInicial." a ".$OSPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

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

		$pdf->Ln();
		$pdf->Ln();

		$total = mysql_num_rows( $ok );
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total de OS's: ",1,0,'C',1);
		$pdf->Cell(30,7,$total,1,0,'C',1);
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF OSPorPeriodo

elseif( !empty( $ComprasPorPeriodoInicial ) && !empty( $ComprasPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $ComprasPorPeriodoInicial );
	$dataFinal = data_ymd( $ComprasPorPeriodoFinal );
	$relatorio = utf8_decode("RELATÓRIO DE COMPRAS POR PERÍODO");

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$j = 0;
	$total = 0;
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

		$pdf->Ln();
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(100);
		$pdf->Cell(75,7,"Periodo de ".$ComprasPorPeriodoInicial." a ".$ComprasPorPeriodoFinal,0,0,'C');	

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$ComprasPorPeriodoInicial." a ".$ComprasPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetX(6);
		$pdf->Cell(30,7,"Pedido",1,0,'C');
		$pdf->Cell(20,7,"Data",1,0,'C');
		$pdf->Cell(30,7,"Codigo",1,0,'C');
		$pdf->Cell(70,7,utf8_decode( "Peça" ),1,0,'C');
		$pdf->Cell(40,7,"Marca",1,0,'C');
		$pdf->Cell(15,7,"QTD.",1,0,'C');
		$pdf->Cell(30,7,utf8_decode( "Preço Unit." ),1,0,'C');
		$pdf->Cell(30,7,"Status",1,0,'C');
		$pdf->Ln();

		

		$ok = $sql->consulta ( Relatorio::comprasPorPeriodo( $dataInicial, $dataFinal ) );

		while ( $l = $sql->resultado() ) {

			if (($j % 2) == 1) {

				$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(30,7,$l['idcomprapeca'],1,0,'C',1);
				$pdf->Cell(20,7,data_dmy( $l['datapedido'] ),1,0,'C',1);
		        $pdf->Cell(30,7,$l['codigopeca'],1,0,'C',1);
		        $pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
		        $pdf->Cell(40,7,$l['marcapeca'],1,0,'C',1);
		        $pdf->Cell(15,7,$l['qtd'],1,0,'C',1);
		        $pdf->Cell(30,7,"R$ ".number_format( $l['precounidade'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(30,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
		        $pdf->Ln();

		        $total += ( $l['qtd'] * $l['precounidade'] );

	    	} else {
	    		
	    		$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(30,7,$l['idcomprapeca'],1,0,'C',1);
				$pdf->Cell(20,7,data_dmy( $l['datapedido'] ),1,0,'C',1);
		        $pdf->Cell(30,7,$l['codigopeca'],1,0,'C',1);
		        $pdf->Cell(70,7,$l['nomepeca'],1,0,'C',1);
		        $pdf->Cell(40,7,$l['marcapeca'],1,0,'C',1);
		        $pdf->Cell(15,7,$l['qtd'],1,0,'C',1);
		        $pdf->Cell(30,7,"R$ ".number_format( $l['precounidade'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(30,7,strtoupper(utf8_decode( $l['status'] )),1,0,'C',1);
		        $pdf->Ln();

		        $total += ( $l['qtd'] * $l['precounidade'] );

	    	}

	    	$j++;

		} // FIM DO WHILE RESULTADO

		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total: ",1,0,'C',1);
		$pdf->Cell(30,7,"R$ ".number_format($total,2,',','.'),1,0,'C',1);
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF ComprasPorPeriodo

elseif( !empty( $FaturamentoPorPeriodoInicial ) && !empty( $FaturamentoPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $FaturamentoPorPeriodoInicial );
	$dataFinal = data_ymd( $FaturamentoPorPeriodoFinal );
	$relatorio = utf8_decode("RELATÓRIO DE FATURAMENTO POR PERÍODO");

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$j = 0;
	$total = 0;
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

		$pdf->Ln();
		$pdf->SetX(100);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75,7,"Periodo de ".$FaturamentoPorPeriodoInicial." a ".$FaturamentoPorPeriodoFinal,0,0,'C');	

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$FaturamentoPorPeriodoInicial." a ".$FaturamentoPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

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
				$pdf->Cell(40,7,"R$ ".number_format( $l['maodeobra'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(40,7,"R$ ".number_format( $l['valorpecasusadas'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(40,7,"R$ ".number_format(( $l['valorpecasusadas'] + $l['maodeobra'] ),2,',','.'),1,0,'C',1);
		        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
		        $pdf->Cell(40,7,data_dmy( $l['entrega'] ),1,0,'C',1);
		        $pdf->Ln();

		        $total += ( $l['valorpecasusadas'] + $l['maodeobra'] );

	    	} else {
	    		
	    		$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(200,200,200);
				$pdf->Cell(40,7,$l['idordemdeservico'],1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['maodeobra'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(40,7,"R$ ".number_format( $l['valorpecasusadas'],2,',','.' ),1,0,'C',1);
		        $pdf->Cell(40,7,"R$ ".number_format(( $l['valorpecasusadas'] + $l['maodeobra'] ),2,',','.'),1,0,'C',1);
		        $pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
		        $pdf->Cell(40,7,data_dmy( $l['entrega'] ),1,0,'C',1);
		        $pdf->Ln();

		        $total += ( $l['valorpecasusadas'] + $l['maodeobra'] );

	    	}

	    	$j++;

		} // FIM DO WHILE RESULTADO

		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total: ",1,0,'C',1);
		$pdf->Cell(30,7,"R$ ".number_format($total,2,',','.'),1,0,'C',1);
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF FaturamentoPorPeriodo



/* ##### RELATÓRIOS GERENCIAIS ##### */

elseif( !empty( $faturadoDiarioPorPeriodoInicial ) && !empty( $faturadoDiarioPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $faturadoDiarioPorPeriodoInicial );
	$dataFinal = data_ymd( $faturadoDiarioPorPeriodoFinal );
	$relatorio = utf8_decode("TOTAL DIARIO FATURADO POR PERÍODO");

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$j = 0;
	$total = 0;
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

		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(100);
		$pdf->Cell(75,7,"Periodo de ".$faturadoDiarioPorPeriodoInicial." a ".$faturadoDiarioPorPeriodoFinal,0,0,'C');

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$faturadoDiarioPorPeriodoInicial." a ".$faturadoDiarioPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetX(6);
		$pdf->Cell(40,7,"Data Entrada",1,0,'C');
		$pdf->Cell(40,7,"Total",1,0,'C');
		$pdf->Ln();

		

		$ok = $sql->consulta ( Relatorio::faturadoDiarioPorPeriodo( $dataInicial, $dataFinal ) );

		while ( $l = $sql->resultado() ) {

			if (($j % 2) == 1) {

				$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	} else {
	    		
	    		$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(200,200,200);
				$pdf->Cell(40,7,data_dmy( $l['entrada'] ),1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	}

	    	$j++;

		} // FIM DO WHILE RESULTADO

		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total: ",1,0,'C',1);
		$pdf->Cell(30,7,"R$ ".number_format($total,2,',','.'),1,0,'C',1);
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF TOTAL DIARIO FATURADO POR PERÍODO

elseif( !empty( $despesasPorPeriodoInicial ) && !empty( $despesasPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $despesasPorPeriodoInicial );
	$dataFinal = data_ymd( $despesasPorPeriodoFinal );
	$relatorio = utf8_decode("TOTAL DIARIO DE DESPESAS POR PERÍODO");

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$j = 0;
	$total = 0;
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

		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(100);
		$pdf->Cell(75,7,"Periodo de ".$despesasPorPeriodoInicial." a ".$despesasPorPeriodoFinal,0,0,'C');	

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$despesasPorPeriodoInicial." a ".$despesasPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetX(6);
		$pdf->Cell(40,7,"Data Pedido",1,0,'C');
		$pdf->Cell(40,7,"Total",1,0,'C');
		$pdf->Ln();

		

		$ok = $sql->consulta ( Relatorio::despesasPorPeriodo( $dataInicial, $dataFinal ) );

		while ( $l = $sql->resultado() ) {

			if (($j % 2) == 1) {

				$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(40,7,data_dmy( $l['data'] ),1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	} else {
	    		
	    		$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(200,200,200);
				$pdf->Cell(40,7,data_dmy( $l['data'] ),1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	}

	    	$j++;

		} // FIM DO WHILE RESULTADO

		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total: ",1,0,'C',1);
		$pdf->Cell(30,7,"R$ ".number_format($total,2,',','.'),1,0,'C',1);
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF TOTAL DIARIO DE DESPESAS POR PERÍODO

elseif( !empty( $maodeobraPorPeriodoInicial ) && !empty( $maodeobraPorPeriodoFinal ) ) {
	$dataInicial = data_ymd( $maodeobraPorPeriodoInicial );
	$dataFinal = data_ymd( $maodeobraPorPeriodoFinal );
	$relatorio = utf8_decode("TOTAL DIARIO DE CUSTO DE MÃO DE OBRA POR EQUIPAMENTO");

	if( $dataInicial > $dataFinal ){
		echo "
			<script language='javascript'>
				alert('Data selecionada invalida. Selecione um periodo valido!');
				window.location='../relatorio.php';
			</script>
		";

		die();
	}

	$j = 0;
	$total = 0;
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

		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(100);
		$pdf->Cell(75,7,"Periodo de ".$maodeobraPorPeriodoInicial." a ".$maodeobraPorPeriodoFinal,0,0,'C');	

		$pdf->Line(6,30,290,30);

		$pdf->SetY(23);
		$pdf->SetX(248);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50,10,"SiGOS - ".$dataAtual,0,0,'C');

		$pdf->SetY(40);

		/*

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetX(6);
		$pdf->Cell(75,7,"Periodo de ".$maodeobraPorPeriodoInicial." a ".$maodeobraPorPeriodoFinal,1,0,'C');

		*/

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetX(6);
		$pdf->Cell(60,7,"Tipo de Eequipamento",1,0,'C');
		$pdf->Cell(40,7,"Total",1,0,'C');
		$pdf->Ln();

		

		$ok = $sql->consulta ( Relatorio::maodeobraPorPeriodo( $dataInicial, $dataFinal ) );

		while ( $l = $sql->resultado() ) {

			if (($j % 2) == 1) {

				$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(60,7,$l['tipo'],1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	} else {
	    		
	    		$pdf->SetFont('Arial', '', 8);
				
				$pdf->SetX(6);
				$pdf->SetFillColor(200,200,200);
				$pdf->Cell(60,7,$l['tipo'],1,0,'C',1);
				$pdf->Cell(40,7,"R$ ".number_format( $l['total'],2,',','.' ),1,0,'C',1);
		        $pdf->Ln();

		        $total += $l['total'];

	    	}

	    	$j++;

		} // FIM DO WHILE RESULTADO

		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetX(6);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,7,"Total: ",1,0,'C',1);
		$pdf->Cell(30,7,"R$ ".number_format($total,2,',','.'),1,0,'C',1);	
		
		$pdf->Output($relatorio." - ".$dataAtual.".pdf","D");

	sleep(1);

} // FIM DO IF TOTAL DIARIO DE CUSTO DE MÃO DE OBRA POR EQUIPAMENTO

/* ##### FIM DA GERAÇÃO DE PDF's ##### */



/* ##### INÍCIO DA VALIDAÇÃO DE CAMPOS DE CONSULTA EM BRANCO ##### */

if( empty( $OSPorPeriodoInicial ) && empty( $OSPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE OS POR PERÍODO EM BRANCO

elseif( empty( $ComprasPorPeriodoInicial ) && empty( $ComprasPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE COMPRAS POR PERÍODO EM BRANCO

elseif( empty( $FaturamentoPorPeriodoInicial ) && empty( $FaturamentoPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE FATURAMENTO POR PERÍODO EM BRANCO

/* ##### RELATÓRIOS GERENCIAIS ##### */

elseif( empty( $faturadoDiarioPorPeriodoInicial ) && empty( $faturadoDiarioPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE TOTAL DIARIO FATURADO POR PERÍODO EM BRANCO

elseif( empty( $despesasPorPeriodoInicial ) && empty( $despesasPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE TOTAL DIARIO DE DESPESAS POR PERÍODO EM BRANCO

elseif( empty( $maodeobraPorPeriodoInicial ) && empty( $maodeobraPorPeriodoFinal ) ){
	echo "
		<script language='javascript'>
			alert('Selecione uma data valida!');
			window.location='../relatorio.php';
		</script>
	";
} // FIM DO IF DE VALIDAÇÃO DE TOTAL DIARIO DE CUSTO DE MÃO DE OBRA POR EQUIPAMENTO EM BRANCO


/* ##### FIM DA VALIDAÇÃO DE CAMPOS DE CONSULTA EM BRANCO ##### */