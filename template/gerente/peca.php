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

<div id="corpoForm">
<form id="form1">				<!-- Início do formulário de cadastro peças -->
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

</form>				<!-- Fim do formulário de cadastro peças -->
</div>

<?php }else{

  $sql = new Conexao();
  $ok = $sql->conecta();
  if ($ok) {
	  echo "OK";
  }else{
	  echo "Erro";
  }
   //$sql->consulta( Peca::consultaId( $idpeca ) );
  //$l = $sql->resultado();

?>

<?php } ?>


<div id="retornoErro"></div>
<div id="retorno"></div>

<script type="text/javascript" src="/SiGOS/template/js/jquery.maskMoney.js"></script>
<script>
    $(document).ready( function(){
    	

		//Início script Cadastrar nova peça
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
		});// Fim do script Cadastrar Nova peça
		
		// Função para exibir calendário
		$("#dataentrada").datepicker({
	            showOn: "button",
	            buttonImage: "../img/b_calendar.png",
	            buttonImageOnly: true
	    });

	    //Função para exibir máscara Monetária
	    $('#precounidade').maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
			  
	});
</script>


<?php include_once("rodape.php"); ?>
