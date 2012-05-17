<?php
include_once("topo.php");
?>

<div id="caixaLogin">
	<div id="logo">
		.:: S{i}GOS ::.
	</div>
	<div id="areaForm">
		<form id="form1">
			<table>
				<tr>
					<td align="left">Usuário</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="login" id="login" />
					</td>
				</tr>
				<tr>
					<td align="left">Senha</td>
				</tr>				
				<tr>
					<td><input type="password" name="senha" id="senha" /></td>	
				</tr>
			</table>
		</form>
		<div id="icones">
			<div id="login">
				<img src="img/icone-login.png" />
			</div>
			<div id="senha">
				<img src="img/icone-chave.png" width="55px" height="55px" />
			</div>
		</div>
		<div id="botoesLogar">
			<input type="button" class="bt_entrar" id="fazerLogin" />
		</div>
	</div>
	
</div>
<div id="retornoLogin"></div>

<?php
include_once("rodape.php");
?>

<script>
	$(document).ready( function(){
		$("#caixaLogin").corner("round 28px");

		$("#fazerLogin").click( function(){
			var login = $("#login").val();
			var senha = $("#senha").val();

			$.ajax({
				type: "GET",
				url: "function/validaLogin.php",
				data: "login="+login+
					  "&senha="+senha,
				beforeSend: function(){
					$('#retornoLogin').fadeIn(200);
	                $("#retornoLogin").text('Carregando...');
				},
				success: function(html){
					$('#retornoLogin').html(html);
				}
			});
		});

		$("#login").focus( function(){
			$("#login").css('background','#fff');
			$("#login").css('border','#fff');
		});

		$("#senha").focus( function(){
			$("#senha").css('background','#fff');
			$("#senha").css('border','#fff');
		});
	});
</script>