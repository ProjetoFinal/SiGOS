<?php

include_once("topo.php");
include_once("../function/formataData.php");


$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idpeca = $_GET['idpeca'];
	$idos = $_GET['idos'];
	$idor = $_GET['idor'];
}

if( $editar == ""){
?>

<br />
<span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Adicionar Peça
</span>
<br />

<!-- Início do formulário de cadastro peças -->

<form id="form1">				
<div id="column1" style="margin-left: 190px">
	<input type="hidden" id="idos" value="<?=$idos?>" />
	<input type="hidden" id="idor" value="<?=$idor?>" />
	<table style="display:none">
		<tr>
			<td>Código da Peça</td>
			<td>
				<input type="text" name="codigopeca" id="codigopeca" />
			</td>
			<td>Descrição</td>
			<td>
				<input type="text" name="nomepeca" id="nomepeca" />
			</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>
				<input type="text" name="marcapeca" id="marcapeca" />
			</td>
			<td>Modelo</td>
			<td>
				<input type="text" name="modelopeca" id="modelopeca" />
			</td>
		</tr>
	</table>
</div>

<div id="lineButton" style="display:none">
	<input type="button" class="bt_buscar" id="consultar" value="Consultar (Enter)" />
	<input type="button" class="bt_voltar" id="cancelar" onclick="fechar()" value="Cancelar (F5)" />
</div>

</form>

<!-- Fim do formulário de cadastro peças -->

<?php }else{

	$sql = new Conexao();
	$ok = $sql->conecta();
	$sql->consulta( Peca::consultaID( $idpeca ) );
	$l = $sql->resultado();

?>

<!-- Início do formulário de consulta-->
<form id="form2">
<div id="column1">
	<input type="hidden" name="idpeca" id="idpeca" value="<?=$l['idpeca']?>" />
<table style="display:none">
		<tr>
			<td>Código da Peça</td>
			<td>
				<input type="text" name="codigopeca" id="codigopeca" value="<?=$l['codigopeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Descrição</td>
			<td>
				<input type="text" name="nomepeca" id="nomepeca" value="<?=$l['nomepeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>
				<input type="text" name="marcapeca" id="marcapeca" value="<?=$l['marcapeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td>
				 <input type="text" name="modelopeca" id="modelopeca" value="<?=$l['modelopeca']?>" />
			</td>
		</tr>
</table>
</div>

<div id="column2">
	<table>
		<tr>
			<td>Quantidade</td>
			<td>
				<input type="text" name="quantidade" id="quantidade" value="<?=$l['quantidade']?>" />
			</td>
		</tr>
		<tr>
			<td>Preco Unitátio</td>
			<td>
				<input type="text" name="precounidade" id="precounidade" value="<?=$l['precounidade']?>" />
			</td>
		</tr>
		<tr>
			<td>Data Entrada</td>
			<td>
				<input type="text" name="dataentrada" id="dataentrada"
						style="width:150px !important;
							margin-right: 5px!important" readonly value="<?=data_dmy($l['dataentrada'])?>" />
			</td>
		</tr>
	</table>
</div>

<div id="lineButton" style="display:none">
	<input type="button" id="editar"   value="Editar (Ctrl + F11)" />
	<input type="button" id="cancelar" value="Cancelar (F8)"       />
	<input type="button" id="remover"  value="Remover (Ctrl + F7)" />
</div>
</form>

<!-- Início do formulário de consulta-->  

<?php } ?>

<div id="retornoErro"></div>
<div id="retorno"></div>

<script type="text/javascript" src="/SiGOS/template/js/jquery.maskMoney.js"></script>
<script type="text/javascript" >
    $(document).ready( function(){
		// Início Consultar Peça

		$('#retorno').load('ajax/consultarPeca.php?idos=<?=$idos?>&idor=<?=$idor?>');

		$("#consultar").click( function(){
	        var codigopeca	= $("#codigopeca").val();
	        var nomepeca	= $("#nomepeca").val();
	        var marcapeca	= $("#marcapeca").val();
	        var modelopeca	= $("#modelopeca").val();
	        var idos = $('#idos').val();  
	        var idor = $('#idor').val();  

	        $.ajax({
	            type: "GET",
	            url: "ajax/consultarPeca.php",
	            data: "codigopeca="+codigopeca+
	                  "&nomepeca="+nomepeca+
	                  "&marcapeca="+marcapeca+
	                  "&modelopeca="+modelopeca+
	                  "&idos="+idos+
	                  "&idor="+idor,
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Consultando...');
	            },
	            success: function(html){ 
	            		$('#retornoErro').fadeOut(5000);
	                    $('#retorno').html(html);
	            }
	        });
	    });
	    //Fim do Consultar Peças 
	});

	function fechar(){
		opener.location.reload();
		window.close();
	}
</script>

<?php include_once("rodape.php"); ?>

<style>
	#menu{ display: none; }
	#central{ margin-top:-50px; }
	#retorno{ top: -200px !important; overflow: hidden; height: auto; }
	#retornoErro{ width: 995px; }
</style>