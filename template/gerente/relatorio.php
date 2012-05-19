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

<br /><br />

<div id="relatoriosOperacionaisOut" style="width:100%; height:auto; border:1px solid transparent; cursor:pointer;">
	<span style="color: #777; float:left; margin-left:50px;">
		<div id="botaoOpOut" style="width:15px; 
							  height:15px;
							  float:left; 
							  margin-right:5px;
							  border:1px solid transparent; 
							  background:url('../img/layout/bt_setas.jpg') no-repeat;
							  background-position:-22px 0px;"></div>
		<div id="botaoOpIn" style="width:15px; 
							  height:15px;
							  float:left;
							  margin-right:5px; 
							  border:1px solid transparent; 
							  background:url('../img/layout/bt_setas.jpg') no-repeat;
							  background-position:-64px 0px;
							  display:none;"></div>
			Relatórios Operacionais
	</span>

		<div id="relatoriosOperacionaisIn" style="width:100%; height:350px; float:left; border:1px solid transparent; display:none;">

			<div id="column1" style="border:0px solid red; margin: 20px 0 0 80px">
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

		</div>
</div>

<!-- RELATORIOS GERENCIAIS -->

<br /><br />

<div id="relatoriosGerenciaisOut" style="width:100%; height:auto; float:left; border:1px solid transparent; cursor:pointer;">
	<span style="color: #777; float:left; margin-left:50px;">
		<div id="botaoGerOut" style="width:15px; 
							  height:15px;
							  float:left; 
							  margin-right:5px;
							  border:1px solid transparent; 
							  background:url('../img/layout/bt_setas.jpg') no-repeat;
							  background-position:-22px 0px;"></div>
		<div id="botaoGerIn" style="width:15px; 
							  height:15px;
							  float:left;
							  margin-right:5px; 
							  border:1px solid transparent; 
							  background:url('../img/layout/bt_setas.jpg') no-repeat;
							  background-position:-64px 0px;
							  display:none;"></div>
			Relatórios Gerenciais
	</span>

		<div id="relatoriosGerenciaisIn" style="width:100%; height:350px; float:left; border:1px solid transparent; display:none;">

			<div id="column1" style="border:0px solid red; margin: 20px 0 0 80px">
				<table border=0>
					
					<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
						<td>Total Diario Faturado por Periodo</td>
						<td align="left">
							<input type="text" name="faturadoDiarioPorPeriodoInicial" id="faturadoDiarioPorPeriodoInicial"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
						<td>
							<input type="text" name="faturadoDiarioPorPeriodoFinal" id="faturadoDiarioPorPeriodoFinal"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />
						</td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<td>
							<div style="margin-top:-10px; margin-left:20px;">
								<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
								<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
							</div>
						</td>
					</tr></form>

					<tr><td colspan="4">&nbsp;</td></tr>
					<tr><td colspan="4"><div style="border-top:3px solid #aaa ">&nbsp;</div></tr>

					<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
						<td>Total Diario de Despesas por Periodo</td>
						<td align="left">
							<input type="text" name="despesasPorPeriodoInicial" id="despesasPorPeriodoInicial"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
						<td>
							<input type="text" name="despesasPorPeriodoFinal" id="despesasPorPeriodoFinal"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />
						</td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<td>
							<div style="margin-top:-10px; margin-left:20px;">
								<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
								<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
							</div>
						</td>
					</tr></form>

					<tr><td colspan="4">&nbsp;</td></tr>
					<tr><td colspan="4"><div style="border-top:3px solid #aaa ">&nbsp;</div></tr>

					<tr><form id="form1" method="post" action="ajax/gerarRelatorio.php">
						<td>Total Diario de Custo de Mao de Obra no Periodo</td>
						<td align="left">
							<input type="text" name="maodeobraPorPeriodoInicial" id="maodeobraPorPeriodoInicial"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
						<td>
							<input type="text" name="maodeobraPorPeriodoFinal" id="maodeobraPorPeriodoFinal"
								style="width:150px !important;
									   margin-right: 5px!important" readonly />
						</td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<td>
							<div style="margin-top:-10px; margin-left:20px;">
								<input type="submit" class="bt_gerarrel" id="gerarRelatorio" onclick="loading()" value="Gerar Relatório (Ctrl + F11)" />
								<input type="reset" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
							</div>
						</td>
					</tr></form>

				</table>
				</div>

		</div>
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

	    $("#faturadoDiarioPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#faturadoDiarioPorPeriodoFinal").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#despesasPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#despesasPorPeriodoFinal").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#maodeobraPorPeriodoInicial").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	    $("#maodeobraPorPeriodoFinal").datepicker({
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
		
		$("#botaoOpOut").click( function(){
			$("#relatoriosGerenciaisIn").slideUp(500);
			$("#botaoGerIn").hide();
			$("#botaoGerOut").show();
			$("#relatoriosOperacionaisIn").slideDown(500);
			$("#botaoOpOut").hide();
			$("#botaoOpIn").show();
		});
		$("#botaoOpIn").click( function(){
			$("#relatoriosOperacionaisIn").slideUp(500);
			$("#botaoOpIn").hide();
			$("#botaoOpOut").show();
		});

		$("#botaoGerOut").click( function(){
			$("#relatoriosOperacionaisIn").slideUp(500);
			$("#botaoOpIn").hide();
			$("#botaoOpOut").show();
			$("#relatoriosGerenciaisIn").slideDown(500);
			$("#botaoGerOut").hide();
			$("#botaoGerIn").show();
		});
		$("#botaoGerIn").click( function(){
			$("#relatoriosGerenciaisIn").slideUp(500);
			$("#botaoGerIn").hide();
			$("#botaoGerOut").show();
		});


	});

	function loading(){
		$('#retornoErro').fadeIn(1000);
        $("#retornoErro").text('Gerando Relatório...');
        $("#retornoErro").fadeOut(1000);
	}
</script>