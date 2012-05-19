<?php
session_start();

function __autoload( $classes ) {
	include_once("../../../dao/$classes.class.php");
}

$sql = new Conexao();
$sql->conecta();
$sql->consulta( Equipamento::consultaId( $_GET['id'] ) );
$l = $sql->resultado();
?>

<input type="hidden" id="idequipamento" value="<?=$l['idequipamento']?>" />
<input type="hidden" id="idcliente" value="<?=$l['idcliente']?>" />
<table>
	<tr>
		<td>Marca<span style="color:red">*</span> <input type="text" name="marca" id="marca" value="<?=$l['marcaequip']?>" /></td>
		<td>Modelo<span style="color:red">*</span> <input type="text" name="modelo" id="modelo" value="<?=$l['modeloequip']?>" /></td>
	</tr>
	<tr>
		<td>Tipo<span style="color:red">*</span> <select id="tipo" style="height: 37px">
						<option value="<?=$l['idtiposequipamentos']?>" selected><?=$l['tipoequip']?></option>
						<option value="">-----</option>
						<?php
							$equip = new Conexao();
							$equip->conecta();
							$equip->consulta( TipoEquipamento::listar() );
							while( $te = $equip->resultado() ){
						?>
							<option value="<?=$te['idtiposequipamentos']?>"><?=$te['tipo']?></option>
						<?php } ?>
					   </select>
				   </select>
		</td>		   
		<td>N. Série<span style="color:red">*</span> <input type="text" name="serie" id="serie" value="<?=$l['numserie']?>" /></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="button" class="bt_salvar" id="editar" value="Editar (Ctrl + F11)" />
			<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F5)" />
			<input type="button" class="bt_remover" id="remover" value="Remover (Ctr + F7)" />
		</td>
	</tr>
</table>


<script>
	//$("#dadosEquip table tbody tr:odd").css("background","#bbd5e2");
	//$("#dadosEquip table tbody tr:even").css("background","#EBF3EB");

	$("#editar").click( function(){
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
    });
	    
    $("#remover").click( function(){
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
    });

    $("#editEquip #cancelar").click( function(){
    		var idcliente = $("#editEquip #idcliente").val();
			$(window.document.location).attr('href','equipamentos.php?editar=1&idcliente='+idcliente);
	});
</script>

<?php sleep(1); ?>