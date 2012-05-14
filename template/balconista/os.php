<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

include_once("topo.php");
include_once("../function/formataData.php");

$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idos = $_GET['id'];
	$idOS = $_GET['idos'];
}

if( $editar == "" ){ ?>

<div id="busca">
	<input type="button" id="novaOS" value="Nova OS (Insert)" />
</div>
<div id="busca">
	<!--<input type="text" id="key" />
	<input type="button" id="buscar" value="Buscar" />-->
</div>

<div id='retornoErro'></div>
<div id="listaOS">
	<script>
		$("#retornoErro").fadeIn(200);
			$("#retornoErro").text("Carregando...");
			$('#listaOS').load('ajax/listarOS.php');
			$("#retornoErro").fadeOut(3000);
	</script>
</div>

<?php }elseif( $editar == "nova"){ ?>

<div id='retornoErro'></div>

<br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Nova Ordem de Serviço
</span>

<div class="novaOS">
	<form name="formNovaOS">
	<table class="nova">
		<tr>
			<td>Cliente<span style="color:red">*</span></td>
			<td><input type="text" name="cliente" id="cliente" value="" /></td>
		</tr>
		<tr>
			<td>Equipamento</td>
			<td>
				<input type="text" name="equipamento" id="equipamento" value="" readonly/>
				<input type="hidden" name="idequipamento" id="idequipamento" value="" />
				<input type="hidden" name="maodeobra" id="maodeobra" value="" />
			</td>
		</tr>
		<tr>
			<td>Defeito<span style="color:red">*</span></td>
			<td><textarea id="defeito" style="width: 200px;height: 100px;"></textarea></td>
		</tr>
		<tr>
			<td>Acessórios</td>
			<td><textarea id="acessorios" style="width: 200px;height:100px"></textarea></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="button" id="cadastrar" value="Cadastrar (F9)" />
				<input type="button" id="cancelar" value="Cancelar (F8)" />
				<input type="reset" id="limpar" value="Limpar" />
			</td>
		</tr>
	</table>
	</form>
</div>

<?php }else{} ?>

<script>
	$(document).ready( function(){
		//$("#listaOS").load('ajax/listarOS.php?key=0');
		<?php
			if( empty($editar) && !empty($idOS) ){
		?>
			window.open('verOs.php?idos=<?=$idOS?>','Janela','width=520,height=600');			
		<?php }elseif($editar == 'imp'){	?>
			window.open('impOS.php?idos=<?=$idOS?>','Janela','width=520, height=600');
		<?php } ?>

		$("#novaOS").click( function(){
			$(window.document.location).attr('href','os.php?editar=nova');
		});
		$("#cliente").click( function(){
			window.open('selecionarEquip.php','Continue_to_Application','width=800,height=600');
		});

		$("#cancelar").click( function(){
			$(window.document.location).attr('href','os.php');
		});

		$("#cadastrar").click( function(){
			var idequipamento = $("#idequipamento").val();
			var defeito = $("#defeito").val();
			var acessorios = $("#acessorios").val();
			var maodeobra = $("#maodeobra").val();

			$.ajax({
				type: "GET",
				url: "ajax/novaOS.php",
				data: "idequipamento="+idequipamento+
					  "&maodeobra="+maodeobra+
					  "&defeito="+defeito+
					  "&acessorios="+acessorios,
				beforeSend: function(){
					$("#retornoErro").fadeIn(200);
					$("#retornoErro").text("Carregando...");
				},
				success: function(html){
					$("#retornoErro").html(html);
				}
			});
		});

		$("#buscar").click( function(){
			var key = $('#key').val();

			$("#retornoErro").fadeIn(200);
			$("#retornoErro").text("Carregando...");
			$('#listaOS').load('ajax/listarOS.php?key='+key);
			$("#retornoErro").fadeOut(3000);
		});

		$("#cliente").click(function(){
	        $('#cliente').css('background','#fff');
	        $('#cliente').css('border','');
	    });
	    $("#defeito").click(function(){
	        $('#defeito').css('background','#fff');
	        $('#defeito').css('border','');
	    });
	});
</script>
<?php
include_once("rodape.php");
