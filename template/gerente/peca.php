<?php
function __autoload( $class ) {
    include_once("../dao/$class.class.php");
}
include_once("topo.php");
include_once("../function/formataData.php");

$editar = "";

if($_GET) {
    $editar = $_GET['editar'];
    $idpeca = $_GET['id'];
}

if( $editar == "" ){

?>

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
                <input type="text" name="modeloeca" id="modelopeca" />
             </td>    
        </tr>
</div>

<div id="column2">

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
</div>
  
    </table>

        <div id="lineButton">
            <input type="button" id="cadastrar" value="Cadastrar (F9)" />
            <input type="button" id="editar" value="Editar ctrl+f11" />
            <input type="button" id="cancelar" value="Cancelar (F5)" />
        </div>        
       
       
<div id="retornoErro"></div>
<div id="retorno"></div>

    <!--</div>    -->

</div>
</form>



<?php } else {
    $sql = new Conexao();
    $sql->conecta();
    $sql->consulta( Peca::consultaId( $idpeca ) );
    $l = $sql->resultado();
?>

<?php } ?>

<script>
    $(document).ready( function(){
        $("#marcaPeca").focus();
        
        $("#cadastrar").click( function(){
            var codigopeca = $("#form1 #codigopeca").val(); 
            var nomepeca = $("#form1 #nomepeca").val();
            var marcapeca = $("#form1 #marcapeca").val();
            var modelopeca = $("#form1 #modelopeca").val();
            var quantidade = $("#form1 #quantidade").val();
            var precounidade = $("#form1 #precounidade").val();
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
                    $("#retornoErro").text('Carregando...');
                },
                success: function(html){ 
                        $('#retornoErro').html(html);
                }
            }); 
        }); 
        $("#dataentrada").datepicker({
                showOn: "button",
                buttonImage: "../img/b_calendar.png",
                buttonImageOnly: true
        });
        
    });
</script>
<?php
include_once("rodape.php");
?> 