<?php

function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

include_once("topo.php");
include_once("../function/formataData.php");

?>

<br /><br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Relatórios
</span>


<div id="column1" style="border:0px solid red; margin: 50px 0 0 80px">
<table border=0>

	<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
		<td>Relatório de OS por Status</td>
		<td>
			<select name="OSPorStatus" id="OSPorStatus">
				<option value="" selected>-- STATUS</option>
				<?php
					$statusOs = new Conexao();
					$statusOs->conecta();
					$statusOs->consulta( OS::listarStatusOs() );
					while( $r = $statusOs->resultado() ){
				?>
				<option  value="<?=$r['idStatus']?>"><?=$r['status']?></option>
				<?php } ?>
			</select>
		</td>
		<td align="right">
			<div style="margin-top:-10px">&nbsp;&nbsp;
				<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
				<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
			</div>
		</td>
	</tr></form>

	<tr><td colspan="4">&nbsp;</td></tr>
	<tr><td colspan="4"><div style="border-top:3px solid #aaa ">&nbsp;</div></tr>

	<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
		<td>Relatório de OS por período</td>
		<td align="left">
			<input type="text" name="OSPorPeriodoInicial" id="OSPorPeriodoInicial"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à
		</td>
		<td>
			<input type="text" name="OSPorPeriodoFinal" id="OSPorPeriodoFinal"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />
		</td>
		<td>
			<div style="margin-top:-10px">
				<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
				<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
			</div>
		</td>
	</tr></form>

	<tr><td colspan="4">&nbsp;</td></tr>
	<tr><td colspan="4"><div style="border-top:3px solid #aaa ">&nbsp;</div></tr>

	<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
		<td>Relatório de Compras por período</td>
		<td align="left">
			<input type="text" name="ComprasPorPeriodoInicial" id="ComprasPorPeriodoInicial"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à
		</td>
		<td>
			<input type="text" name="ComprasPorPeriodoFinal" id="ComprasPorPeriodoFinal"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />
		</td>
		<td>
			<div style="margin-top:-10px">
				<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
				<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
			</div>
		</td>
	</tr></form>

	<tr><td colspan="4">&nbsp;</td></tr>
	<tr><td colspan="4"><div style="border-top:3px solid #aaa ">&nbsp;</div></tr>

	<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
		<td>Relatório de Faturamento por período</td>
		<td align="left">
			<input type="text" name="FaturamentoPorPeriodoInicial" id="FaturamentoPorPeriodoInicial"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à
		</td>
		<td>
			<input type="text" name="FaturamentoPorPeriodoFinal" id="FaturamentoPorPeriodoFinal"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />
		</td>
		<td>
			<div style="margin-top:-10px">
				<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
				<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
			</div>
		</td>
	</tr></form>

</table>
</div>




<div id="retornoErro"></div>
<div id="retorno"></div>

<script>
	$(document).ready( function(){
		$("#OSPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#OSPorPeriodoFinal").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#ComprasPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#ComprasPorPeriodoFinal").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#FaturamentoPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#FaturamentoPorPeriodoFinal").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#OSPorStatus").click( function(){
	    	$("#OSPorPeriodoInicial").val("");
	    	$("#OSPorPeriodoFinal").val("");
	    	$("#ComprasPorPeriodoInicial").val("");
	    	$("#ComprasPorPeriodoFinal").val("");
	    	$("#FaturamentoPorPeriodoInicial").val("");
	    	$("#FaturamentoPorPeriodoFinal").val("");
	    });
	    $("#cancelar").click( function(){
	    	$(window.document.location).attr('href','relatorio.php');
	    });
	    /*
	    $("#gerarRelatorio").click( function(){
	    	var formulario = $("#form1").serialize();
	    	$.ajax({
	    		type: "GET",
	            url: "ajax/gerarRelatorio.php",
	            data: formulario,  
	            beforeSend: function(){
	            	$("#form1").submit();
	                $('#retornoErro').fadeIn(1000);
	                $("#retornoErro").text('Gerando Relatório...');
	                $("#retornoErro").fadeOut(1000);
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	    	});
	    });
		*/
	});

	function loading(){
		$('#retornoErro').fadeIn(1000);
        $("#retornoErro").text('Gerando Relatório...');
        $("#retornoErro").fadeOut(1000);
	}
</script>