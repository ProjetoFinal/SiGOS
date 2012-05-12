<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("../function/validaCPF.php");
include_once("topo.php");

if( $_POST ){
	$sql = new Conexao();
	$sql->conecta();

	$cliente = new Cliente( $_POST );

	if( validaCPF( $cpf ) == true ){
		$verifica = $sql->consulta( Cliente::validaCPF( $cpf ) );
		$cont = mysql_num_rows( $verifica );

		if( $cont >= 1 ){
			echo "<script>alert('CPF encontrado. Verifique se o cliente ja foi cadastrado.');</script>";
		}else{
			$ok = $sql->consulta ( $cliente->novoCliente() );
			$ultimoId = mysql_insert_id();
			if($ok){
			echo "<script>
					$(window.document.location).attr('href','selecionarEquip.php?editar=1&idcliente=".$ultimoId."');		
				  </script>";
			}else{
				echo "<script>alert('Erro ao cadastrar Novo Cliente');</script>";
			}
		}
	}else{
		echo "<script>alert('CPF Invalido!');</script>";
	}
}
?>
<div id="retornoErro"></div>
<div id="retorno"></div>
<style>
#column1{ margin-left: 70px;}
#column1, #column2, #column3{
	border: 0px solid red;
	float: left;
	margin-top: 15px;
	margin-right: 20px;
}
#column3{ margin: 30px 0 20px 250px; }
#lineButton{ 
	width: 800px;
	height: 25px; 
}
</style>
<form id="form1" action="#" method="post">
<div id="column1">
<table>
	<tr>
		<td>Nome*</td>
		<td>
			<input type="text" name="nome" id="nome" />
		</td>
	</tr>
	<tr>
		<td>Identidade*</td>
		<td>
			<input type="text" name="identidade" id="identidade" />
		</td>
	</tr>
	<tr>
		<td>Orgão Expedidor*</td>
		<td>
			<input type="text" name="orgaoexpedidor" id="orgaoexpedidor" />
		</td>
	</tr>
	<tr>
		<td>CPF*</td>
		<td>
			<input type="text" name="cpf" id="cpf" />
		</td>
	</tr>
	<tr>
		<td>Nascimento*</td>
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
		<td>Telefone*</td>
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
		<td>CEP*</td>
		<td>
			<input type="text" name="cep" id="cep" />
		</td>
	</tr>
	<tr>
		<td>Logradouro*</td>
		<td>
			<input type="text" name="logradouro" id="logradouro" />
		</td>
	</tr>
	</table>
</div>

	<div id="column3">
<table>
	<tr>
		<td>Número*</td>
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
		<td>Bairro*</td>
		<td>
			<input type="text" name="bairro" id="bairro" />
		</td>
	</tr>
	<tr>
		<td>Cidade*</td>
		<td>
			<input type="text" name="cidade" id="cidade" />
		</td>
	</tr>
	<tr>
		<td>Estado*</td>
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
	<input type="button" id="cadastrarCliente" value="Cadastrar" />
	<input type="button" id="voltar" value="Cancelar" />
</div>
</form>

<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="/SiGOS/template/js/jquery.maskedinput.js"></script>
<script>
	$('#menu').css('display','none');
	$('#central').css('top','0');
	$('#central').css('width','800px');
	$('#central').css('height','600px');

	$("#nascimento").datepicker({
	    showOn: "button",
	    buttonImage: "../img/b_calendar.png",
	    buttonImageOnly: true
	});
	
	$("#voltar").click( function(){
		history.back(2);
	});

	$("#cadastrarCliente").click( function(){
    	var formulario = $('#form1').serialize();
        $.ajax({
            type: "GET",
            url: "ajax/novoCliente2.php",
            data: formulario,  
            beforeSend: function(){
                $('#retornoErro').fadeIn(200);
                $("#retornoErro").text('Carregando...');
            },
            success: function(html, data){ 
                    $('#retornoErro').html(html);                	
            }
        });
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
</script>