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
	Manter Fornecedor
</span>
<?php

$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idfornecedor = $_GET['id'];
}

if( $editar == "" ){
?>

<form id="form1">
<div id="column1">
<table>
	<tr>
		<td>Razao Social<span style="color:red">*</span></td>
		<td>
			<input type="text" name="razaosocial" id="razaosocial" />
		</td>
	</tr>
	<tr>
		<td>Nome Fantasia</td>
		<td>
			<input type="text" name="nomefantasia" id="nomefantasia" />
		</td>
	</tr>
	<tr>
		<td>CNPJ<span style="color:red">*</span></td>
		<td>
			<input type="text" name="cnpj" id="cnpj" />
		</td>
	</tr>
	<tr>
		<td>Inscrição Estadual</td>
		<td>
			<input type="text" name="inscest" id="inscest" />
		</td>
	</tr>
	<tr>
		<td>Contato</td>
		<td>
			<input type="text" name="contato" id="contato" />
		</td>
	</tr>
	</table>
	</div>

	<div id="column2">
<table>
	<tr>
		<td>Telefone<span style="color:red">*</span></td>
		<td>
			<input type="text" name="telefone" id="telefone" />
		</td>
	</tr>
	<tr>
		<td>CEP<span style="color:red">*</span></td>
		<td>
			<input type="text" name="cep" id="cep" />
		</td>
	</tr>
	<tr>
		<td>Logradouro<span style="color:red">*</span></td>
		<td>
			<input type="text" name="logradouro" id="logradouro" />
		</td>
	</tr>
	<tr>
		<td>Numero<span style="color:red">*</span></td>
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
	</table>
</div>

	<div id="column3">
<table>
	<tr>
		<td>Bairro<span style="color:red">*</span></td>
		<td>
			<input type="text" name="bairro" id="bairro" />
		</td>
	</tr>
	<tr>
		<td>cidade<span style="color:red">*</span></td>
		<td>
			<input type="text" name="cidade" id="cidade" />
		</td>
	</tr>
	<tr>
		<td>Estado<span style="color:red">*</span></td>
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
$sql->consulta( Fornecedor::consultaId( $idfornecedor ) );
$l = $sql->resultado();

?>
<form id="form2">
<div id="column1">
	<input type="hidden" name="idfornecedor" id="idfornecedor" value="<?=$l['idfornecedor']?>" />
<table>
	<tr>
		<td>Razão Social</td>
		<td>
			<input type="text" name="razaosocial" id="razaosocial" value="<?=$l['razaosocial']?>" />
		</td>
	</tr>
	<tr>
		<td>Nome Fantasia</td>
		<td>
			<input type="text" name="nomefantasia" id="nomefantasia" value="<?=$l['nomefantasia']?>" />
		</td>
	</tr>
	<tr>
		<td>CNPJ</td>
		<td>
			<input type="text" name="cnpj" id="cnpj" value="<?=$l['cnpj']?>" />
		</td>
	</tr>
	<tr>
		<td>Inscrição Estadual</td>
		<td>
			<input type="text" name="inscest" id="inscest" value="<?=$l['inscest']?>" />
		</td>
	</tr>
	<tr>
		<td>Contato</td>
		<td>
			<input type="text" name="contato" id="contato" value="<?=$l['contato']?>" />
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
	<tr>
		<td>Número</td>
		<td>
			<input type="text" name="numero" id="numero" value="<?=$l['numero']?>" />
		</td>
	</tr>
	<tr>
		<td>Bairro</td>
		<td>
			<input type="text" name="bairro" id="bairro" value="<?=$l['bairro']?>" />
		</td>
	</tr>
	</table>
</div>

	<div id="column3">
<table>	
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
	<input type="button" class="bt_salvar" id="editar"   value="Editar (Ctrl + F11)" />
	<input type="button" class="bt_voltar" id="cancelar" value="Cancelar (F8)"       />
	<input type="button" class="bt_remover" id="remover"  value="Remover (Ctrl + F7)" />
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

			var razaosocial  =  $("#form1 #razaosocial").val();
			var nomefantasia =  $("#form1 #nomefantasia").val();
			var cnpj         =  $("#form1 #cnpj").val();
			var inscest      =  $("#form1 #inscest").val();
			var contato      =  $("#form1 #contato").val();
			var telefone     =  $("#form1 #telefone").val();
			var cep          =  $("#form1 #cep").val();
			var logradouro   =  $("#form1 #logradouro").val();
			var numero       =  $("#form1 #numero").val();
			var complemento  =  $("#form1 #complemento").val();
			var bairro       =  $("#form1 #bairro").val();
			var cidade       =  $("#form1 #cidade").val();
			var uf           =  $("#form1 #uf").val();

			$.ajax({
	            type: "GET",
	            url: "ajax/novoFornecedor.php",
	            data: "razaosocial="+razaosocial+
	                  "&nomefantasia="+nomefantasia+
	                  "&cnpj="+cnpj+
	                  "&inscest="+inscest+
	                  "&contato="+contato+
	                  "&telefone="+telefone+
	                  "&cep="+cep+
	                  "&logradouro="+logradouro+
	                  "&numero="+numero+
	                  "&complemento="+complemento+
	                  "&bairro="+bairro+
	                  "&cidade="+cidade+
	                  "&uf="+uf,  
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Cadastrando...');
	            },
	            success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
	        });
	    });
    
	    $("#consultar").click( function(){
	        var nomefantasia = $("#nomefantasia").val();
	        var cnpj         = $("#cnpj").val();	     

	        $.ajax({
	            type: "GET",
	            url: "ajax/consultarFornecedor.php",
	            data: "nomefantasia="+nomefantasia+
	                  "&cnpj="+cnpj,  
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

			var idfornecedor =  $("#form2 #idfornecedor").val();
	    	var razaosocial  =  $("#form2 #razaosocial").val();
			var nomefantasia =  $("#form2 #nomefantasia").val();
			var cnpj         =  $("#form2 #cnpj").val();
			var inscest      =  $("#form2 #inscest").val();
			var contato      =  $("#form2 #contato").val();
			var telefone     =  $("#form2 #telefone").val();
			var cep          =  $("#form2 #cep").val();
			var logradouro   =  $("#form2 #logradouro").val();
			var numero       =  $("#form2 #numero").val();
			var complemento  =  $("#form2 #complemento").val();
			var bairro       =  $("#form2 #bairro").val();
			var cidade       =  $("#form2 #cidade").val();
			var uf           =  $("#form2 #uf").val();

	        $.ajax({
	            type: "GET",
	            url: "ajax/editarFornecedor.php",
	            data: "idfornecedor="+idfornecedor+
	            	  "&razaosocial="+razaosocial+
	                  "&nomefantasia="+nomefantasia+
	                  "&cnpj="+cnpj+
	                  "&inscest="+inscest+
	                  "&contato="+contato+
	                  "&telefone="+telefone+
	                  "&cep="+cep+
	                  "&logradouro="+logradouro+
	                  "&numero="+numero+
	                  "&complemento="+complemento+
	                  "&bairro="+bairro+
	                  "&cidade="+cidade+
	                  "&uf="+uf,   
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
	    	var idfornecedor = $("#form2 #idfornecedor").val();
	    	var nomefantasia = $("#form2 #nomefantasia").val();
	    	if( confirm('Deseja remover o Fornecedor '+nomefantasia+'?') ){
					$.ajax({
						type: "GET",
						url: "ajax/removerFornecedor.php",
						data: "idfornecedor="+idfornecedor,
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
	    	$(window.document.location).attr('href','fornecedor.php');
	    });

	    $("#razaosocial").focus(function(){
	        $('#razaosocial').css('background','#fff');
	        $('#razaosocial').css('border','');
	    });
	   	$("#nomefantasia").focus(function(){
	        $('#nomefantasia').css('background','#fff');
	        $('#nomefantasia').css('border','');
	    });
	    $("#cnpj").focus(function(){
	        $('#cnpj').css('background','#fff');
	        $('#cnpj').css('border','');
	    });
	    $("#inscest").focus(function(){
	        $('#inscest').css('background','#fff');
	        $('#inscest').css('border','');
	    });
	    $("#contato").focus(function(){
	        $('#contato').css('background','#fff');
	        $('#contato').css('border','');
	    });
	    $("#telefone").focus(function(){
	        $('#telefone').css('background','#fff');
	        $('#telefone').css('border','');
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

	  
	    $('#cep').mask("99999-999");
	    $('#telefone').mask("(99)9999-9999");
	    $('#cnpj').mask("99.999.999/9999-99");

	});
</script>


<?php
include_once("rodape.php");
?>
