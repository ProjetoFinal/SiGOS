<?php
function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}
include_once("../function/validaCPF.php");

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
<script>
	$("#nascimento").datepicker({
	    showOn: "button",
	    buttonImage: "../img/b_calendar.png",
	    buttonImageOnly: true
	});

	$("#cadastrarCliente").click( function(){
		$('#form1').validate({
        	// define regras para os campos
            rules: {
                nome: {
                    required: true,
                    minlength: 10
                },
                identidade: {
                    required: true
                },
                orgaoexpedidor: {
                    required: true
                },
                cpf: {
                    required: true
                },
                nascimento: {
                    required: true
                },
                telefone: {
                    required: true
                },
                cep: {
                    required: true
                },
                logradouro: {
                    required: true
                },
                numero: {
                    required: true
                },
                bairro: {
                    required: true
                },
                cidade: {
                    required: true
                },
                estado: {
                    required: true
                }
            }
        });
		$("#form1").submit();
	});

	$("#voltar").click( function(){
		history.back(2);
	});
</script>