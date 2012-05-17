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
	Manter Usuário
</span><br /><br /><br />
<?php
$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idUsuario = $_GET['idUsuario'];
}

if( $editar == "" ){

?>

<div id="corpoForm">
<form id="form1">
<table>
	<tr>
		<td>Nome<span style="color:red">*</span></td>
		<td>
			<input type="text" name="nome" id="nome" />
		</td>
	
		<td>Login<span style="color:red">*</span></td>
		<td>
			<input type="text" name="login" id="login" />
		</td>
	
		<td>Senha<span style="color:red">*</span></td>
		<td>
			<input type="password" name="senha" id="senha" />
		</td>
	</tr>
	<tr>
		<td>Nível<span style="color:red">*</span></td>
		<td>
			<select name="nivel" id="nivel">
				<option value="">-- Nivel</option>
				<option value="balconista">Balconista</option>
				<option value="estoquista">Estoquista</option>
				<option value="gerente">Gerente</option>
				<option value="tecnico">Técnico</option>
			</select>
		</td>

		<td>Status<span style="color:red">*</span></td>
		<td>
			<select name="status" id="status">
				<option value="">-- Status</option>
				<option value="ativo">Ativo</option>
				<option value="inativo">Inativo</option>
			</select>
		</td>
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
$sql->consulta( Usuario::consultaId( $idUsuario ) );
$l = $sql->resultado();

?>

<div id="corpoForm">
<form id="form2">
	<input type="hidden" name="idUsuario" id="idUsuario" value="<?=$l['idUsuario']?>" />
<table>
	<tr>
		<td>Nome</td>
		<td>
			<input type="text" name="nome" id="nome" value="<?=$l['nome']?>" />
		</td>
	
		<td>Login</td>
		<td>
			<input type="text" name="login" id="login" value="<?=$l['login']?>" />
		</td>
	
		<td>Senha</td>
		<td>
			<input disabled type="password" name="senha" id="senha" value="<?=$l['senha']?>" />
		</td>
	</tr>
	<tr>
		<td>Nível</td>
		<td>
			<select name="nivel" id="nivel">
				<option value="<?=$l['nivel']?>"><?=ucfirst($l['nivel'])?></option>
				<option value="">--------------------</option>
				<?php 
					switch( $l['nivel'] ){
						case "balconista":
							echo "<option value='estoquista'>Estoquista</option>
								  <option value='gerente'>Gerente</option>
								  <option value='tecnico'>Técnico</option>";
							break;

						case "estoquista":
							echo "<option value='balconista'>Balconista</option>
								  <option value='gerente'>Gerente</option>
								  <option value='tecnico'>Técnico</option>";
							break;

						case "gerente":
							echo "<option value='balconista'>Balconista</option>
								  <option value='estoquista'>Estoquista</option>
								  <option value='tecnico'>Técnico</option>";
							break;
						
						case "tecnico":
							echo "<option value='balconista'>Balconista</option>
								  <option value='estoquista'>Estoquista</option>
								  <option value='gerente'>Gerente</option>";
							break;
													
					}
				
				?>	
			</select>
		</td>

		<td>Status</td>
		<td>
			<select name="status" id="status">
				<option value="<?=ucfirst($l['statusUsuario'])?>"><?=ucfirst($l['statusUsuario'])?></option>
				<option value="">------------------</option>
				<?php if ( $l['statusUsuario'] == "inativo" ){ ?>
					<option value="ativo">Ativo</option>
				<?php } else { ?>
					<option value="inativo">Inativo</option>
				<?php } ?>
			</select>
		</td>
	</tr>
</table>

<div id="lineButton">
	<input type="button" class="bt_salvar" id="editar" value="Editar (Ctrl + F11)" />
	<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F8)" />
	<input type="button" class="bt_remover" id="remover" value="Remover (Ctrl + F7)" />
	<input type="button" class="bt_zerar" id="resetarSenha" value="Resetar Senha (Ctrl + R)" style="margin-left:-30px" />
</div>
</form>
</div>

<?php } ?>


<div id="retornoErro"></div>
<div id="retorno" style="height:380px"></div>


<script type="text/javascript" src="teclasGerente.js"></script>

<script>
	$(document).ready( function(){

		//Cadastrar novo usuário
		$("#cadastrar").click( function(){
			$("#retornoErro").hide(5);
			$("#retorno").hide(5);
			var nome = $("#form1 #nome").val();
			var login = $("#form1 #login").val();
			var senha = $("#form1 #senha").val();
			var nivel = $("#form1 #nivel").val();	
			var status = $("#form1 #status").val();

			$.ajax({
	            type: "GET",
	            url: "ajax/novoUsuario.php",
	            data: "nome="+nome+
	                  "&login="+login+
	                  "&senha="+senha+
	                  "&nivel="+nivel+
	                  "&status="+status,  
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
			var nome = $("#nome").val();
			var login = $("#login").val();
			var senha = $("#senha").val();
			var nivel = $("#nivel").val();
			var status = $("#status").val();

			$.ajax({
				type: "GET",
				url: "ajax/consultarUsuario.php",
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
			var idUsuario = $("#form2 #idUsuario").val();
			var nome = $("#form2 #nome").val();
			var login = $("#form2 #login").val();
			var senha = $("#form2 #senha").val();
			var nivel = $("#form2 #nivel").val();
			var status = $("#form2 #status").val();

			$.ajax({
				type: "GET",
				url: "ajax/editarUsuario.php",
				data: "idUsuario="+idUsuario+
					  "&nome="+nome+
					  "&login="+login+
					  "&senha="+senha+
					  "&nivel="+nivel+
					  "&status="+status,
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
			var idUsuario = $("#form2 #idUsuario").val();
			var nome = $("#form2 #nome").val();	

			if( confirm('Deseja realmente remover o usuário '+nome+'?') ){
				$.ajax({
					type: "GET",
					url: "ajax/removerUsuario.php",
					data: "idUsuario="+idUsuario,
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

		$("#resetarSenha").click( function(){
			var idUsuario = $("#form2 #idUsuario").val();
			var nome = $("#form2 #nome").val();
			var senha = $("#form2 #senha").val();
			
			if( confirm('Deseja realmente resetar a senha do usuário '+nome+'?') ){
				$.ajax({
					type: "GET",
					url: "ajax/resetarSenha.php",
					data: "idUsuario="+idUsuario,
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
	    	$(window.document.location).attr('href','usuario.php');
	    });

		$("#nome").focus( function(){
			$("#nome").css('background','#fff');
			$("#nome").css('border','');
		});

		$("#login").focus( function(){
			$("#login").css('background','#fff');
			$("#login").css('border','');
		});

		$("#senha").focus( function(){
			$("#senha").css('background','#fff');
			$("#senha").css('border','');
		});

		$("#nivel").focus( function(){
			$("#nivel").css('background','#fff');
			$("#nivel").css('border','');
		});

		$("#status").focus( function(){
			$("#status").css('background','#fff');
			$("#status").css('border','');
		});
	});
</script>

<?php
include_once("rodape.php");
?>

