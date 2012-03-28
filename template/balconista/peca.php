<?php

function __autoload( $class ){
	include_once("../../dao/$class.class.php");
}

include_once("topo.php");
include_once("../function/formataData.php");


$editar = "";

if($_GET){
	$editar = $_GET['editar'];
	$idpeca = $_GET['idpeca'];
}

if( $editar == ""){
?>


<!-- Início do formulário de cadastro peças -->

<form id="form1">				
<div id="column1">
	<table>
		<tr>
			<td>Código da Peça</td>
			<td>
				<input type="text" name="codigopeca" id="codigopeca" />
			</td>
		</tr>
		<tr>
			<td>Descrição</td>
			<td>
				<input type="text" name="nomepeca" id="nomepeca" />
			</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>
				<input type="text" name="marcapeca" id="marcapeca" />
			</td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td>
				<input type="text" name="modelopeca" id="modelopeca" />
			</td>
		</tr>
	</table>
</div>

<div id="column2">
	<table>
		<tr>
			<td>Quantidade</td>
			<td>
				<input type="text" name="quantidade" id="quantidade" />
			</td>
		</tr>
		<tr>
			<td>Preco Unitátio</td>
			<td>
				<input type="text" name="precounidade" id="precounidade" />
			</td>
		</tr>
		<tr>
			<td>Data Entrada</td>
			<td>
				<input type="text" name="dataentrada" id="dataentrada"
						style="width:150px !important;
							margin-right: 5px!important" readonly />
			</td>
		</tr>
	</table>
</div>


<div id="lineButton">
	<input type="button" id="cadastrar" value="Cadastrar (F9)" />
	<input type="button" id="consultar" value="Consultar (F10)" />
	<input type="button" id="cancelar" value="Cancelar (F5)" />
</div>

</form>

<!-- Fim do formulário de cadastro peças -->

<?php }else{

	$sql = new Conexao();
	$ok = $sql->conecta();
	$sql->consulta( Peca::consultaID( $idpeca ) );
	$l = $sql->resultado();

?>

<!-- Início do formulário de consulta-->
<form id="form2">
<div id="column1">
	<input type="hidden" name="idpeca" id="idpeca" value="<?=$l['idpeca']?>" />
<table>
		<tr>
			<td>Código da Peça</td>
			<td>
				<input type="text" name="codigopeca" id="codigopeca" value="<?=$l['codigopeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Descrição</td>
			<td>
				<input type="text" name="nomepeca" id="nomepeca" value="<?=$l['nomepeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>
				<input type="text" name="marcapeca" id="marcapeca" value="<?=$l['marcapeca']?>" />
			</td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td>
				 <input type="text" name="modelopeca" id="modelopeca" value="<?=$l['modelopeca']?>" />
			</td>
		</tr>
</table>
</div>

<div id="column2">
	<table>
		<tr>
			<td>Quantidade</td>
			<td>
				<input type="text" name="quantidade" id="quantidade" value="<?=$l['quantidade']?>" />
			</td>
		</tr>
		<tr>
			<td>Preco Unitátio</td>
			<td>
				<input type="text" name="precounidade" id="precounidade" value="<?=$l['precounidade']?>" />
			</td>
		</tr>
		<tr>
			<td>Data Entrada</td>
			<td>
				<input type="text" name="dataentrada" id="dataentrada"
						style="width:150px !important;
							margin-right: 5px!important" readonly value="<?=data_dmy($l['dataentrada'])?>" />
			</td>
		</tr>
	</table>
</div>

<div id="lineButton">
	<input type="button" id="editar"   value="Editar (Ctrl + F11)" />
	<input type="button" id="cancelar" value="Cancelar (F8)"       />
	<input type="button" id="remover"  value="Remover (Ctrl + F7)" />
</div>
</form>

<!-- Início do formulário de consulta-->  

<?php } ?>

<div id="retornoErro"></div>
<div id="retorno"></div>

<script type="text/javascript" src="/SiGOS/template/js/jquery.maskMoney.js"></script>
<script type="text/javascript" >
    $(document).ready( function(){
    	

		//Início Cadastrar nova peça
		$("#cadastrar").click( function(){
			$("#retornoErro").hide(5);
			$("#retorno").hide(5);
			var codigopeca	= $("#form1 #codigopeca").val();
			var nomepeca	= $("#form1 #nomepeca").val();
			var marcapeca	= $("#form1 #marcapeca").val();
			var modelopeca	= $("#form1 #modelopeca").val();
			var quantidade	= $("#form1 #quantidade").val();	
			var precounidade= $("#form1 #precounidade").val();
			var dataentrada = $("#form1 #dataentrada").val();
	
  		  
			$.ajax({
		            type: "GET",
		            url: "ajax/novaPeca.php",
		            data: "codigopeca="+codigopeca+
		                  "&nomepeca="+nomepeca+
		                  "&marcapeca="+marcapeca+
		                  "&modelopeca="+modelopeca+
		                  "&quantidade="+quantidade+
						  "&precounidade="+precounidade+
						  "&dataentrada="+dataentrada,
		            beforeSend: function(){
		                $('#retornoErro').fadeIn(200);
		                $("#retornoErro").text('Cadastrando...');
		            },
		            success: function(html){ 
		                    $('#retornoErro').html(html);
		            }
		    });
		});
		// Fim do script Cadastrar Nova peça

		// Início Consultar Peça
		$("#consultar").click( function(){
	        var codigopeca	= $("#form1 #codigopeca").val();
	        var nomepeca	= $("#form1 #nomepeca").val();
	        var marcapeca	= $("#form1 #marcapeca").val();
	        var modelopeca	= $("#form1 #modelopeca").val();  
	        
	        $.ajax({
	            type: "GET",
	            url: "ajax/consultarPeca.php",
	            data: "codigopeca="+codigopeca+
	                  "&nomepeca="+nomepeca+
	                  "&marcapeca="+marcapeca+
	                  "&modelopeca="+modelopeca,
	            beforeSend: function(){
	                $('#retornoErro').fadeIn(200);
	                $("#retornoErro").text('Consultando...');
	            },
	            success: function(html){ 
	            		$('#retornoErro').fadeOut(5000);
	                    $('#retorno').html(html);
	            }
	        });
	    });
	    //Fim do Consultar Peças
	    
	    //Editar Peças
		$("#editar").click( function(){
			var idpeca 		= $("#form2 #idpeca").val();
			var codigopeca	= $("#form2 #codigopeca").val();
			var nomepeca	= $("#form2 #nomepeca").val();
			var marcapeca	= $("#form2 #marcapeca").val();
			var modelopeca	= $("#form2 #modelopeca").val();
			var quantidade	= $("#form2 #quantidade").val();
			var precoentrada= $("#form2 #precounidade").val();
			var dataentrada	= $("#form2 #dataentrada").val();

			$.ajax({
				type: "GET",
				url: "ajax/editarPeca.php",
				data: "idpeca="+idpeca+
					  "&codigopeca="+codigopeca+
					  "&nomepeca="+nomepeca+
					  "&marcapeca="+marcapeca+
					  "&modelopeca="+modelopeca+
					  "&quantidade="+quantidade+
					  "&precounidade="+precoentrada+
					  "&dataentrada"+dataentrada,
				beforeSend: function(){
					$('#retornoErro').fadeIn(200);
					$('#retornoErro').text('Editando...');
				},
				success: function(html){ 
	                    $('#retornoErro').html(html);
	            }
			});
		});
	    // Fim do editar peça
	    
	    //Início Remover Peças
		$("#remover").click( function(){
			var idpeca = $("#form2 #idpeca").val();
			var nomepeca = $("#form2 #nomepeca").val();	

			if( confirm('Deseja realmente excluir a peça '+nomepeca+'?') ){
				$.ajax({
					type: "GET",
					url: "ajax/removerPeca.php",
					data: "idpeca="+idpeca,
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
		//Fim Remover Peças
		
		// Função para exibir calendário
		$("#dataentrada").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });

	    //Função para exibir máscara Monetária
	    $('#precounidade').maskMoney({allowZero:false, allowNegative:true, defaultZero:false});

            $("#cancelar").click( function(){
	    	$(window.document.location).attr('href','peca.php');
	    });
	});
</script>


<?php include_once("rodape.php"); ?>
