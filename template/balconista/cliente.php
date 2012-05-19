<?php

function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

include_once("topo.php");
include_once("../function/formataData.php");
?>
<br /><span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Manter Cliente
</span>
<?php

$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idcliente = $_GET['id'];
}

if( $editar == "" ){
?>

<form id="form1">
<div id="column1">
<table>
	<tr>
		<td>Nome <span style="color:red">*</span></td>
		<td>
			<input type="text" name="nome" id="nome" />
		</td>
	</tr>
	<tr>
		<td>Identidade <span style="color:red">*</span></td>
		<td>
			<input type="text" name="identidade" id="identidade" />
		</td>
	</tr>
	<tr>
		<td>Orgão Expedidor <span style="color:red">*</span></td>
		<td>
			<input type="text" name="orgaoexpedidor" id="orgaoexpedidor" />
		</td>
	</tr>
	<tr>
		<td>CPF <span style="color:red">*</span></td>
		<td>
			<input type="text" name="cpf" id="cpf" />
		</td>
	</tr>
	<tr>
		<td>Nascimento <span style="color:red">*</span></td>
		<td>
			<input type="text" name="nascimento" id="nascimento"
				style="width:150px !important;
					   margin-right: 5px!important" readonly />
		</td>
	</tr>
	</table>
	</div>

	<div id="column2">
<table>
	<tr>
		<td>Telefone <span style="color:red">*</span></td>
		<td>
			<input type="text" name="telefone" id="telefone" />
		</td>
	</tr>
	<tr>
		<td>Celular</td>
		<td>
			<input type="text" name="celular" id="celular" />
		</td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td>
			<input type="text" name="email" id="email" />
		</td>
	</tr>
	<tr>
		<td>CEP <span style="color:red">*</span></td>
		<td>
			<input type="text" name="cep" id="cep" />
		</td>
	</tr>
	<tr>
		<td>Logradouro <span style="color:red">*</span></td>
		<td>
			<input type="text" name="logradouro" id="logradouro" />
		</td>
	</tr>
	</table>
</div>

	<div id="column3">
<table>
	<tr>
		<td>Número <span style="color:red">*</span></td>
		<td>
			<input type="text" name="numero" id="numero" />
		</td>
	</tr>
	<tr>
		<td>Complemento</td>
		<td>
			<input type="text" name="complemento" id="complemento" />
		</td>
	</tr>
	<tr>
		<td>Bairro <span style="color:red">*</span></td>
		<td>
			<input type="text" name="bairro" id="bairro" />
		</td>
	</tr>
	<tr>
		<td>Cidade <span style="color:red">*</span></td>
		<td>
			<input type="text" name="cidade" id="cidade" />
		</td>
	</tr>
	<tr>
		<td>Estado <span style="color:red">*</span></td>
		<td>
			<select name="uf" id="uf">
				<option  value="" selected>-- Estado</option>
				<?php
					$uf = new Conexao();
					$uf->conecta();
					$uf->consulta( Uf::exibirUf() );
					while( $r = $uf->resultado() ){
				?>
				<option  value="<?=$r['estado']?>"><?=$r['estado']?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
</table>
</div>

<div id="lineButton">
	<input type="button" class="bt_gravar" id="cadastrar" value="Cadastrar (F9)" />
	<input type="button" class="bt_buscar" id="consultar" value="Consultar (F10)" />
	<input type="button" class="bt_limpar" id="cancelar" value="Cancelar (F5)" />
</div>
</form>
<?php }else{

$sql = new Conexao();
$sql->conecta();
$sql->consulta( Cliente::consultaId( $idcliente ) );
$l = $sql->resultado();

?>
<form id="form2">
<div id="column1">
	<input type="hidden" name="idcliente" id="idcliente" value="<?=$l['idcliente']?>" />
<table>
	<tr>
		<td>Nome</td>
		<td>
			<input type="text" name="nome" id="nome" value="<?=$l['nome']?>" />
		</td>
	</tr>
	<tr>
		<td>Identidade</td>
		<td>
			<input type="text" name="identidade" id="identidade" value="<?=$l['identidade']?>" />
		</td>
	</tr>
	<tr>
		<td>Orgão Expedidor</td>
		<td>
			<input type="text" name="orgaoexpedidor" id="orgaoexpedidor" value="<?=$l['orgaoexpedidor']?>" />
		</td>
	</tr>
	<tr>
		<td>CPF</td>
		<td>
			<input type="text" name="cpf" id="cpf" value="<?=$l['cpf']?>" />
		</td>
	</tr>
	<tr>
		<td>Nascimento</td>
		<td>
			<input type="text" name="nascimento" id="nascimento"
				style="width:150px !important;
					   margin-right: 5px!important" readonly value="<?=data_dmy($l['nascimento'])?>" />
		</td>
	</tr>
	</table>
	</div>

	<div id="column2">
<table>
	<tr>
		<td>Telefone</td>
		<td>
			<input type="text" name="telefone" id="telefone" value="<?=$l['telefone']?>" />
		</td>
	</tr>
	<tr>
		<td>Celular</td>
		<td>
			<input type="text" name="celular" id="celular" value="<?=$l['celular']?>" />
		</td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td>
			<input type="text" name="email" id="email" value="<?=$l['email']?>" />
		</td>
	</tr>
	<tr>
		<td>CEP</td>
		<td>
			<input type="text" name="cep" id="cep" value="<?=$l['cep']?>" />
		</td>
	</tr>
	<tr>
		<td>Logradouro</td>
		<td>
			<input type="text" name="logradouro" id="logradouro" value="<?=$l['logradouro']?>" />
		</td>
	</tr>
	</table>
</div>

	<div id="column3">
<table>
	<tr>
		<td>Número</td>
		<td>
			<input type="text" name="numero" id="numero" value="<?=$l['numero']?>" />
		</td>
	</tr>
	<tr>
		<td>Complemento</td>
		<td>
			<input type="text" name="complemento" id="complemento" value="<?=$l['complemento']?>" />
		</td>
	</tr>
	<tr>
		<td>Bairro</td>
		<td>
			<input type="text" name="bairro" id="bairro" value="<?=$l['bairro']?>" />
		</td>
	</tr>
	<tr>
		<td>Cidade</td>
		<td>
			<input type="text" name="cidade" id="cidade" value="<?=$l['cidade']?>" />
		</td>
	</tr>
	<tr>
		<td>Estado</td>
		<td>
			<select name="uf" id="uf">
				<option  value="<?=$l['uf']?>" selected><?=$l['uf']?></option>
				<option  value="">------</option>
				<?php
					$uf = new Conexao();
					$uf->conecta();
					$uf->consulta( Uf::exibirUf() );
					while( $r = $uf->resultado() ){
				?>
				<option  value="<?=$r['estado']?>"><?=$r['estado']?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
</table>
</div>

<div id="lineButton">
	<input type="button" class="bt_salvar" id="editar" value="Editar (Ctrl + F11)" />
	<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F8)" />
	<input type="button" class="bt_remover" id="remover" value="Remover (Ctrl + F7)" />
</div>
</form>
<?php } ?>

<div id="retornoErro"></div>
<div id="retorno" style="border:0px solid red;
						 height:auto;
						 overflow:hidden;
						 background: #fff;"></div>

<script type="text/javascript" src="/SiGOS/template/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="teclas.js"></script>
 <script>
    $(document).ready( function(){
    	$("#nome").focus();
    	
	    $("#cadastrar").click( function(){
	    	var formulario = $('#form1').serialize();
	        $.ajax({
	            type: "GET",
	            url: "ajax/novoCliente.php",
	            data: formulario,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Carregando...');
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	        });
	    });
    
	    $("#consultar").click( function(){
	        var nome = $("#nome").val();
	        var cpf = $("#cpf").val();
	        var telefone = $("#telefone").val();
	        var celular = $("#celular").val();
	        var email = $("#email").val();

	        $.ajax({
	            type: "GET",
	            url: "ajax/consultarCliente.php",
	            data: "nome="+nome+
	                  "&cpf="+cpf+
	                  "&telefone="+telefone+
	                  "&celular="+celular+
	                  "&email="+email,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Carregando...');
	            },
	            success: function(html){ 
	            		$('#retornoErro').fadeOut(5000);
	                    $('#retorno').html(html);
	            }
	        });
	    });
		

	    $("#editar").click( function(){
	    	var formulario = $('#form2').serialize();
	        $.ajax({
	            type: "GET",
	            url: "ajax/editarCliente.php",
	            data: formulario,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Carregando...');
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	        });
	    });

	    $("#remover").click(function(){
	    	var idcliente = $("#form2 #idcliente").val();
	    	var nome = $("#form2 #nome").val();
	    	if( confirm('Deseja remover o Cliente '+nome+'?') ){
					$.ajax({
						type: "GET",
						url: "ajax/removerCliente.php",
						data: "idcliente="+idcliente,
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

	    $("#cancelar").click( function(){
	    	$(window.document.location).attr('href','cliente.php');
	    });

	   	$("#nome").focus(function(){
	        $('#nome').css('background','#fff');
	        $('#nome').css('border','');
	    });
	    $("#identidade").focus(function(){
	        $('#identidade').css('background','#fff');
	        $('#identidade').css('border','');
	    });
	    $("#orgaoexpedidor").focus(function(){
	        $('#orgaoexpedidor').css('background','#fff');
	        $('#orgaoexpedidor').css('border','');
	    });
	    $("#cpf").focus(function(){
	        $('#cpf').css('background','#fff');
	        $('#cpf').css('border','');
	    });
	    $("#nascimento").focus(function(){
	        $('#nascimento').css('background','#fff');
	        $('#nascimento').css('border','');
	    });
	    $("#telefone").focus(function(){
	        $('#telefone').css('background','#fff');
	        $('#telefone').css('border','');
	    });
	    $("#celular").focus(function(){
	        $('#celular').css('background','#fff');
	        $('#celular').css('border','');
	    });
	    $("#email").focus(function(){
	        $('#email').css('background','#fff');
	        $('#email').css('border','');
	    });
	    $("#cep").focus(function(){
	        $('#cep').css('background','#fff');
	        $('#cep').css('border','');
	    });
	    $("#logradouro").focus(function(){
	        $('#logradouro').css('background','#fff');
	        $('#logradouro').css('border','');
	    });
	    $("#numero").focus(function(){
	        $('#numero').css('background','#fff');
	        $('#numero').css('border','');
	    });
	    $("#complemento").focus(function(){
	        $('#complemento').css('background','#fff');
	        $('#complemento').css('border','');
	    });
	    $("#bairro").focus(function(){
	        $('#bairro').css('background','#fff');
	        $('#bairro').css('border','');
	    });
	    $("#cidade").focus(function(){
	        $('#cidade').css('background','#fff');
	        $('#cidade').css('border','');
	    });
	    $("#uf").focus(function(){
	        $('#uf').css('background','#fff');
	        $('#uf').css('border','');
	    });

	    $('#cpf').mask("999.999.999-99");
	    $('#cep').mask("99999-999");
	    $('#telefone').mask("(99)9999-9999");
	    $('#celular').mask("(99)9999-9999");

	    $("#nascimento").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });
	});
</script>


<?php
include_once("rodape.php");
?>
