<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

include_once("topo.php");
?>
<br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Manter Tipo de Equipamento e Mão de Obra
</span><br /><br /><br />
<?php
$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idtiposequipamentos = $_GET['idtiposequipamentos'];
}

if( $editar == "" ){
?>

<div id="corpoForm">
<form id="form1">
<table>
	<tr>
		<td>Tipo de Equipamento</td>
		<td><input type="text" name="tipoequip" id="tipoequip" /></td>
	</tr>
	<tr>
		<td>Valor Mão de Obra</td>
		<td><input type="text" name="valor" id="valor" /></td>
	</tr>	
</table>

<div id="lineButton">
	<input type="button" class="bt_gravar" id="cadastrar" value="Cadastrar (F9)" />
	<input type="button" class="bt_buscar" id="consultar" value="Consultar (Enter)" />
	<input type="button" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
</div>
</form>
</div>


<?php }else{

$sql = new Conexao();
$sql->conecta();
$sql->consulta( TipoEquipamento::consultaId( $idtiposequipamentos ) );
$l = $sql->resultado();

?>

<div id="corpoForm">
<form id="form2">
	<input type="hidden" name="idtiposequipamentos" id="idtiposequipamentos" value="<?=$l['idtiposequipamentos']?>" />
<table>
	<tr>
		<td>Tipo de Equipamento</td>
		<td><input type="text" name="tipoequip" id="tipoequip" value="<?=$l['tipo']?>" /></td>
	</tr>
	<tr>
		<td>Valor Mão de Obra</td>
		<td><input type="text" name="valor" id="valor" value="<?=$l['maodeobra']?>" /></td>
	</tr>
</table>

<div id="lineButton">
	<input type="button" class="bt_salvar" id="editar" value="Editar (Ctrl + F11)" />
	<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F8)" />
	<input type="button" class="bt_remover" id="remover" value="Remover (Ctrl + F7)" />
</div>
</form>
</div>

<?php } ?>


<div id="retornoErro"></div>
<div id="retorno" style="border:0px solid red;
						 height:auto;
						 overflow:hidden;
						 background: #fff;"></div>


<script type="text/javascript" src="teclasGerente.js"></script>
<script type="text/javascript" src="../js/jquery.maskMoney.js"></script>
<script>
	$(document).ready( function(){

		//Cadastrar novo usuário
		$("#cadastrar").click( function(){
			$("#retornoErro").hide(5);
			$("#retorno").hide(5);
			var tipo = $("#form1 #tipoequip").val();
			var valor = $("#form1 #valor").val();

			$.ajax({
	            type: "GET",
	            url: "ajax/novaMaodeObra.php",
	            data: "tipo="+tipo+
	                  "&valor="+valor,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Cadastrando...');
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	        });
		});

		//Consultar usuários
		$("#consultar").click( function(){
			var nome = "";//("#nome").val();
			var login = "";//$("#login").val();
			var senha = "";//"";//$("#senha").val();
			var nivel = "";//$("#nivel").val();
			var status = "";//$("#status").val();

			$.ajax({
				type: "GET",
				url: "ajax/consultarMaodeObra.php",
				data: "nome="+nome+
					  "&login="+login+
					  "&senha="+senha+
					  "&nivel="+nivel+
					  "&status="+status,
				beforeSend: function(){
					$('#retornoErro').fadeIn(200);
					$('#retornoErro').text('Consultando...');
				},
				success: function(html){ 
	            		$('#retornoErro').fadeOut(3000);
	                    $('#retorno').html(html);
	            }

			});
			$("#login").val('');
		});

		//Editar Usuários
		$("#editar").click( function(){
			var idtiposequipamentos = $("#form2 #idtiposequipamentos").val();
			var tipo = $("#form2 #tipoequip").val();
			var valor = $("#form2 #valor").val();

			$.ajax({
				type: "GET",
				url: "ajax/editarMaodeObra.php",
				data: "idtiposequipamentos="+idtiposequipamentos+
					  "&tipo="+tipo+
	                  "&valor="+valor,
				beforeSend: function(){
					$('#retornoErro').fadeIn(200);
					$('#retornoErro').text('Editando...');
				},
				success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
			});
		});

		//Remover Usuários
		$("#remover").click( function(){
			var idtiposequipamentos = $("#form2 #idtiposequipamentos").val();
			var nome = $("#form2 #tipoequip").val();
			 	
			if( confirm('Deseja realmente remover o Tipo de Equipamento '+nome+'?') ){
				$.ajax({
					type: "GET",
					url: "ajax/removerMaodeObra.php",
					data: "idtiposequipamentos="+idtiposequipamentos,
					beforeSend: function(){
				        $('#retornoErro').fadeIn(200);
				        $("#retornoErro").text('Removendo...');
				    },
			        success: function(html){ 
			            $('#retornoErro').html(html);
			        }
				});
			}

		});

		$("#cancelar").click( function(){
	    	$(window.document.location).attr('href','maodeobra.php');
	    });

		$("#tipoequip").focus( function(){
			$("#tipoequip").css('background','#fff');
			$("#tipoequip").css('border','');
		});

		$("#valor").focus( function(){
			$("#valor").css('background','#fff');
			$("#valor").css('border','');
		});

		$('#valor').maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
	});
</script>

<?php
include_once("rodape.php");
?>

