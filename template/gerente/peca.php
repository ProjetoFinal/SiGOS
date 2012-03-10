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
                <input type="text" name="codigoPeca" id="codigoPeca" />
            </td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td>
                <input type="text" name="nomePeca" id="nomePeca" />
            </td>
        </tr>
        <tr>
            <td>Marca</td>
                <td>
                    <input type="text" name="marcaPeca" id="marcaPeca" />
                </td>
        </tr>    
        <tr>    
            <td>Modelo</td>
            <td>
                <input type="text" name="modeloPeca" id="modeloPeca" />
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
                <input type="text" name="precoUnidade" id="precoUnidade" />
            </td>
        </tr>
        <tr>    
            <td>Data Entrada</td>
            <td>
                <input type="text" name="dataEntrada" id="dataEntrada"
                    style="width:150px !important;
                            margin-right: 5px!important" readonly />
            </td>    
        </tr>
</div>
  
    </table>

        <div id="lineButton">
            <input type="button" id="cadastrar" value="Cadastrar (F9)" />
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
            var codigoPeca = $("#form1 #codigoPeca").val(); 
            var nomePeca = $("#form1 #nomePeca").val();
            var marcaPeca = $("#form1 #marcaPeca").val();
            var modeloPeca = $("#form1 #modeloPeca").val();
            var quantidade = $("#form1 #quantidade").val();
            var precoUnidade = $("#form1 #precoUnidade").val();
            var dataEntrada = $("#form1 #dataEntrada").val();

            $.ajax({
                type: "GET",
                url: "ajax/novaPeca.php",
                data: "codigoPeca="+codigoPeca+
                      "&nomePeca="+nomePeca+
                      "&marcaPeca="+marcaPeca+
                      "&modeloPeca="+modeloPeca+
                      "&quantidade="+quantidade+
                      "&precoUnidade="+precoUnidade+
                      "&dataEntrada="+dataEntrada,
                beforeSend: function(){
                    $('#retornoErro').fadeIn(200);
                    $("#retornoErro").text('Carregando...');
                },
                success: function(html){ 
                        $('#retornoErro').html(html);
                }
            }); 
        }); 
        $("#dataEntrada").datepicker({
                showOn: "button",
                buttonImage: "../img/b_calendar.png",
                buttonImageOnly: true
        });
        
    });
</script>
<?php
include_once("rodape.php");
?> 