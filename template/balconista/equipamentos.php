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
<div id="busca">
	<input type="text" id="key" />
	<input type="button" id="buscar" value="Buscar" />
</div>
<div id="retornoErro"></div>
<div id="listaClientes"></div>

<?php } else { ?>

<div id="dadosCliente">
	<?php 
		$sql = new Conexao();
		$sql->conecta();
		$sql->consulta( Cliente::consultaId( $idcliente ) );
		$r = $sql->resultado();
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

<div id="busca">
	<input type="button" id="novoEquipamento" value="Novo Equipamento (Insert)" />
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
							<option value="DVD">Aparelho de DVD</option>
							<option value="TV">Televisão</option>
					   </select>
			</td>		   
			<td>N. Série: <input type="text" name="serie" id="serie" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="button" id="cadastrar" value="Cadastrar (F9)" />
				<input type="button" id="cancelar" value="Cancelar (F5)" />
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
		while( $l = $sql->resultado() ){
			echo"
				<table>
					<tbody>
						<tr>
							<td class='um'>
								<a href='#' onclick='verEquip(".$l['idequipamento'].")'>".$l['marcaequip']."</a>
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

		$('#retornoErro').fadeIn(200);
        $("#retornoErro").text('Carregando...');
        $('#retornoErro').fadeOut(2000);
		$("#listaClientes").load("ajax/consultarEquipamento.php");
		
		$("#buscar").click( function(){
			var key = $("#key").val();
			$('#retornoErro').fadeIn(200);
            $("#retornoErro").text('Carregando...');
            $('#retornoErro').fadeOut(2000);
			$("#listaClientes").load("ajax/consultarEquipamento.php?key="+key);
		});

		$("#novoEquipamento").click( function(){
			$("#busca").fadeOut(200);
			$("#addEquip").fadeIn(200);
			$("#marca").focus();
		});

		$("#cancelar").click( function(){
			$(window.document.location).attr('href','equipamentos.php?editar=1&idcliente=<?=$idcliente?>');
		});

		$("#cadastrar").click( function(){
			var idcliente = $("#addEquip #idcliente").val();
	        var marca = $("#addEquip #marca").val();
	        var modelo = $("#addEquip #modelo").val();
	        var tipo = $("#addEquip #tipo").val();
	        var serie = $("#addEquip #serie").val();

	        $.ajax({
	            type: "GET",
	            url: "ajax/novoEquipamento.php",
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
		            url: "ajax/novoEquipamento.php",
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
		            url: "ajax/editarEquipamento.php",
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
		    	
		    	if( confirm('Deseja remover o Equipamento da base de dados?') ){
					$.ajax({
						type: "GET",
						url: "ajax/removerEquipamento.php",
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

	function verEquip( id ){
	    	$("#busca").fadeOut(200);
			$("#editEquip").fadeIn(200);
	    	$("#editEquip").load('ajax/mostrarEquip.php?id='+id);
	    }
</script>
<?php include_once("rodape.php"); ?>