<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("topo.php");

$editar = "";
if($_GET){
	$editar = $_GET['editar'];
	$idcliente = $_GET['idcliente'];
}

if( $editar == ""){
?>

<br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Selecionar Cliente
</span>

<div id="busca" style="border: 0px solid red; width: 800px">
	
</div>
<div id="busca" style="border: 0px solid red; width: 800px">
	<input type="text" id="key" />
	<input type="button" class="bt_buscar" id="buscar" value="Buscar" />
	<input type="button" class="bt_voltar" onclick="window.close()" value="Voltar" />
	<input type="button" class="bt_novocli" id="novoCliente" value="Novo Cliente" />
</div>
<br />
<div id="retornoErro"></div>
<div id="listaClientes"></div>

<?php } elseif( $editar == "novoCliente" ){ ?>

<div id="novoCliente"></div>
<script>
	//$('#novoCliente').load('novoCliente.php');
	window.location='novoCliente.php';
</script>

<?php
}else { ?>

<br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Selecionar Equipamento
</span>

<div id="dadosCliente">
	<?php 
		$sql = new Conexao();
		$sql->conecta();
		$sql->consulta( Cliente::consultaId( $idcliente ) );
		$r = $sql->resultado();
		echo "<input type='hidden' id='cliente' value='".$r['nome']."' />";
		echo "Cliente: ".$r['nome']."<br />";
		echo "Identidade: ".$r['identidade']." - ".$r['orgaoexpedidor']."<br />";
		echo "CPF: ".$r['cpf']."<br />";
		echo "Telefone: ".$r['telefone']." | Celular: ".$r['celular']."<br />";
		echo "Endereço: ".$r['logradouro'].", ".$r['numero']." ".$r['complemento']." - ".$r['cep']."<br />";
		echo "Bairro: ".$r['bairro']." | Cidade: ".$r['cidade']."<br />";
		echo "Estado: ".$r['uf'];
	?>
</div>

<hr />

<div id="busca" style="width: 820px !important;">
	<input type="button" class="bt_novoequip" id="novoEquipamento" value="Novo Equipamento (Insert)" />
	<input type="button" class="bt_voltar" id="voltar" value="Voltar" />
</div>

<div id="dadosEquip">
	
	<div id="addEquip" style="display: none">
		<input type="hidden" id="idcliente" value="<?=$idcliente?>" />
		<table>
		<tr>
			<td>Marca: <input type="text" name="marca" id="marca" /></td>
			<td>Modelo: <input type="text" name="modelo" id="modelo" /></td>
		</tr>
		<tr>
			<td>Tipo: <select id="tipo" style="height: 37px">
							<option value="" selected>--- Tipo</option>
							<?php
								$equip = new Conexao();
								$equip->conecta();
								$equip->consulta( TipoEquipamento::listar() );
								while( $te = $equip->resultado() ){
							?>
								<option value="<?=$te['idtiposequipamentos']?>"><?=$te['tipo']?></option>
							<?php } ?>
					   </select>
			</td>		   
			<td>N. Série: <input type="text" name="serie" id="serie" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="button" class="bt_gravar" id="cadastrar" value="Cadastrar (F9)" />
				<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F5)" />
			</td>
		</tr>
		</table>
	</div>
	
	<div id="editEquip" style="display: none">
		<input type="hidden" id="idcliente" value="<?=$idcliente?>" />
	</div>


	<div id="retornoErro" style="width: 980px"></div>
	<br /><br />
	
	<?php
		$sql->consulta( Equipamento::consultaCliente( $idcliente ) );
		echo "
			<table>
				<thead>
					<tr id='trTitulo'>
						<td>Marca</td>
						<td>Modelo</td>
						<td>Tipo</td>
						<td>N. Serie</td>
					</tr>
					</tr>
				</thead>
			<tbody>";

		while( $l = $sql->resultado() ){
			echo "<input type='hidden' id='equipamento".$l['idequipamento']."' value='".$l['tipoequip']." - ".$l['marcaequip']." - ".$l['modeloequip']."' />
				<input type='hidden' id='idequipamento".$l['idequipamento']."' value='".$l['idequipamento']."' />
				<input type='hidden' id='maodeobra".$l['idequipamento']."' value='".$l['maodeobra']."' />
				
						<tr>
							<td class='um'>
								<a href='#' onclick='usarEquip(".$l['idequipamento'].")'>".$l['marcaequip']."</a>
							</td>
							<td class='dois'>".$l['modeloequip']."</td>
							<td class='tres'>".$l['tipoequip']."</td>
							<td class='quatro'>".$l['numserie']."</td>
						</tr>
					</tbody>
				</table>	
			";
		}	
	?>
</div>

<?php } ?>
<script>
	$(document).ready( function(){
		$('#dadosEquip table tbody tr:odd').css('background','#bbd5e2');
		$('#dadosEquip table tbody tr:even').css('background','#EBF3EB');

		$('#menu').css('display','none');
		$('#central').css('top','0');
		$('#central').css('width','800px');
		$('#central').css('height','600px');

		$('#listaClientes').css('width','780px');
		$('#listaClientes').css('height','435px');
		$('#listaClientes').css('margin-top','120px');
		$('#listaClientes').css('overflow-x','hidden');
		$('body').css('overflow','hidden');

		$('#dadosEquip table').css('width','770px');
		$('#dadosEquip table').css('height','auto');

		$('#dadosEquip').css('width','799px');
		$('#dadosEquip').css('height','350px');
		$('#dadosEquip').css('overflow-x','hidden');

		$('#retornoErro').fadeIn(200);
        $("#retornoErro").text('Carregando...');
        $('#retornoErro').fadeOut(2000);
		$("#listaClientes").load("ajax/consultarEquipamento2.php");

		$("#buscar").click( function(){
			var key = $("#key").val();
			$('#retornoErro').fadeIn(200);
            $("#retornoErro").text('Carregando...');
            $('#retornoErro').fadeOut(2000);
			$("#listaClientes").load("ajax/consultarEquipamento2.php?key="+key);
		});

		$("#novoEquipamento").click( function(){
			$("#busca").fadeOut(200);
			$("#addEquip").fadeIn(200);
			$("#marca").focus();
		});

		$("#voltar").click( function(){
			history.back();
		});

		$("#cancelar").click( function(){
			$(window.document.location).attr('href','selecionarEquip.php?editar=1&idcliente=<?=$idcliente?>');
		});

		$("#cadastrar").click( function(){
			var idcliente = $("#addEquip #idcliente").val();
	        var marca = $("#addEquip #marca").val();
	        var modelo = $("#addEquip #modelo").val();
	        var tipo = $("#addEquip #tipo").val();
	        var serie = $("#addEquip #serie").val();

	        $.ajax({
	            type: "GET",
	            url: "ajax/novoEquipamento2.php",
	            data: "idcliente="+idcliente+
	            	  "&marca="+marca+
	                  "&modelo="+modelo+
	                  "&tipo="+tipo+
	                  "&serie="+serie,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Carregando...');
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	        });
	    });

	    $("#marca").click(function(){
	        $('#marca').css('background','#fff');
	        $('#marca').css('border','');
	    });
	    $("#serie").click(function(){
	        $('#serie').css('background','#fff');
	        $('#serie').css('border','');
	    });
	    $("#modelo").click(function(){
	        $('#modelo').css('background','#fff');
	        $('#modelo').css('border','');
	    });
	    $("#tipo").click(function(){
	        $('#tipo').css('background','#fff');
	        $('#tipo').css('border','');
	    });

	    $("#novoCliente").click( function(){
	    	$(window.document.location).attr('href','selecionarEquip.php?editar=novoCliente');
	    });
	    
	    // Ctrl
	    var pressedCtrl = false; 
		$(document).keydown( function(e){
		    if( e.which == 17 )
		        pressedCtrl = true; 
		});

	    $(document).keyup( function(e){
	    	// Insert
	    	if( e.which == 45 ){
	    		$("#busca").fadeOut(200);
				$("#addEquip").fadeIn(200);
				$("#marca").focus();
	    	}

	    	// F9 Cadastrar
			if( e.which == 120 ){
				var idcliente = $("#addEquip #idcliente").val();
		        var marca = $("#addEquip #marca").val();
		        var modelo = $("#addEquip #modelo").val();
		        var tipo = $("#addEquip #tipo").val();
		        var serie = $("#addEquip #serie").val();

		        $.ajax({
		            type: "GET",
		            url: "ajax/novoEquipamento2.php",
		            data: "idcliente="+idcliente+
		            	  "&marca="+marca+
		                  "&modelo="+modelo+
		                  "&tipo="+tipo+
		                  "&serie="+serie,  
		            beforeSend: function(){
		                $('#retornoErro').fadeIn(200);
		                $("#retornoErro").text('Carregando...');
		            },
		            success: function(html){ 
		                    $('#retornoErro').html(html);
		            }
		        });
			}

			// Ctrl + F11 Editar
			if ( e.which == 122 && pressedCtrl == true ){
				var idcliente = $("#editEquip #idcliente").val();
				var idequipamento = $("#editEquip #idequipamento").val();
		    	var marca = $("#editEquip #marca").val();
		        var modelo = $("#editEquip #modelo").val();
		        var tipo = $("#editEquip #tipo").val();
		        var serie = $("#editEquip #serie").val();

		        $.ajax({
		            type: "GET",
		            url: "ajax/editarEquipamento2.php",
		            data: "idcliente="+idcliente+
		            	  "&idequipamento="+idequipamento+
		            	  "&marca="+marca+
		                  "&modelo="+modelo+
		                  "&tipo="+tipo+
		                  "&serie="+serie,  
		            beforeSend: function(){
		                $('#retornoErro').fadeIn(200);
		                $("#retornoErro").text('Carregando...');
		            },
		            success: function(html){ 
		                    $('#retornoErro').html(html);
		            }
		        });
			}

			// Crtrl + F7 Remover
			if ( e.which == 118 && pressedCtrl == true ){
				var idcliente = $("#editEquip #idcliente").val();
				var idequipamento = $("#editEquip #idequipamento").val();
		    	
		    	if( confirm('Deseja remover o Equipamento?') ){
					$.ajax({
						type: "GET",
						url: "ajax/removerEquipamento2.php",
						data: "idcliente="+idcliente+
							  "&idequipamento="+idequipamento,
						beforeSend: function(){
				                $('#retornoErro').fadeIn(200);
				                $("#retornoErro").text('Carregando...');
				            },
			            success: function(html){ 
			                    $('#retornoErro').html(html);
			            }
					});
				}
			}
	    });
	});

	function usarEquip( id ){
		var cliente = $('#cliente').val();
		var idequipamento = $('#idequipamento'+id).val();
		var equipamento = $('#equipamento'+id).val();
		var maodeobra = $('#maodeobra'+id).val();

		window.opener.document.formNovaOS.cliente.value = cliente;
		window.opener.document.formNovaOS.equipamento.value = equipamento;
		window.opener.document.formNovaOS.idequipamento.value = idequipamento;
		window.opener.document.formNovaOS.maodeobra.value = maodeobra;
		window.close();
	}
</script>
<?php include_once("rodape.php"); ?>