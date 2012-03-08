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
}

if( $editar == "" ){ ?>

<div id="busca">
	<input type="button" id="novaOS" value="Nova OS (Insert)" />
</div>
<div id="busca">
	<input type="checkbox" class="qualquer" value="A" />A
	<input type="checkbox" class="qualquer" value="A" />B
	<input type="checkbox" class="qualquer" value="A" />C
	<input type="checkbox" class="qualquer" value="A" />D
	<input type="checkbox" class="qualquer" value="A" />E
</div>
<div id="listaOS">
	<script>
		$("#listaOS").load('ajax/listarOS.php?key=0');
	</script>
</div>

<?php }elseif( $editar == "nova"){ ?>

<div class="novaOS">
	<form name="formNovaOS">
	<table class="nova">
		<tr>
			<td>Cliente</td>
			<td><input type="text" name="cliente" id="cliente" value="" /></td>
		</tr>
		<tr>
			<td>Equipamento</td>
			<td>
				<input type="text" name="equipamento" id="equipamento" value="" />
				<input type="hidden" name="idequipamento" id="idequipamento" value="" />
			</td>
		</tr>
		<tr>
			<td>Defeito</td>
			<td><textarea id="defeito" style="width: 200px;height: 100px;"></textarea></td>
		</tr>
		<tr>
			<td>Acessórios</td>
			<td><textarea id="acessorios" style="width: 200px;height:"></textarea></td>
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

		$("#novaOS").click( function(){
			$(window.document.location).attr('href','os.php?editar=nova');
		});
		$("#cliente").click( function(){
			window.open('selecionarEquip.php','Continue_to_Application','width=800,height=600');
		});

		$("#cancelar").click( function(){
			$(window.document.location).attr('href','os.php');
		});
	});
</script>
<?php
include_once("rodape.php");