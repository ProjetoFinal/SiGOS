<?php
function __autoload($class){
	include_once("../../dao/$class.class.php");
}
include_once("topo.php");
include_once("../function/formataData.php");

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$sql->consulta( Compra::consultaData( $datapedido ) );

while( $l = $sql->resultado() ){
	$entrada = $l['datapedido'];
	$status = $l['status'];
}

if( $entrada < date("Y-m-d") and $status == 'aberta' ){
	$sql->consulta( Compra::finalizar( $datapedido ) );
	echo "<script>opener.location.reload();
						window.close();</script>";
}


?>
<style>
	#menu{ display: none; }
	#central{ margin-top:-50px; }
	table{ width:500px; }
	tr{ height: 30px; }
	tr.defeito{ height: 80px; }
	tr.peca{ height: 330px; overflow: auto; }
	div.peca{ overflow: auto; height: 300px;  margin-bottom: 5px; }
	textarea{ height:80px; width:390px; font-size: 14px !important; }
	#linhaPeca{
		border-bottom: 1px solid #999;
		width: 100%;
		height: 50px;
		float: left;
		margin-bottom: 5px;
	}
	#menosUm{ float:left;}
</style>
<table border=1>
	<tr>
		<td>Entrada</td>
		<td>
			<?=data_dmy($entrada)?>
			<input type="hidden" id="datapedido" value="<?=$entrada?>" />
		</td>
	</tr>
	<tr class="peca">
		<td>Peça</td>
		<td>
			<div class="peca">
				<?php
					$peca = $sql->consulta( Compra::verPeca( $datapedido ) );
					if($peca){
					while( $p = $sql->resultado() ){
				?>
					<div id="linhaPeca">
						<?=$p['nomepeca']?>  |  <input type="text" class="qtd[]" id="qtd<?=$p['idpeca']?>" 
													onclick="qtd(<?=$p['idpeca']?>)"
														value="<?=$p['qtd']?>"
															style="width: 50px; height: 15px; text-align:right" />	
												<input type="hidden" id="idpeca" value="<?=$p['idpeca']?>" />
												<?php
													if( $status == "aberta" ){
												?>
												<input type="button" onclick='attPeca(<?=$p['idpeca']?>)' 
													value="Att Quantidade"
														style="width:120px; height: 25px" />
												<?php } ?>
					</div>
				<?php } } else { echo "Sem registros"; } ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			&nbsp;
			<?php if( date('H:i') > '16:30' and $status == 'aberta' ){ ?>
				<input type="button" class="bt_fimcompra" id="finalizar" value="Finalizar Compra" />
			<?php } ?>
			
			<input type="button" class="bt_voltar" onclick="window.close()" value="Fechar" />
			
			<?php if( $status == 'aberta' ){ ?>
				<input type="button" class="bt_cancelcompra" id="cancelar" value="Cancelar Compra" />
			<?php } ?>
		</td>
	</tr>
</table>
<script>
	$('#finalizar').click( function(){
		var datapedido = $('#datapedido').val();
		if(confirm('A Compra do dia <?=data_dmy($entrada)?> será finalizada.')){
			$.ajax({
				type: "GET",
				url: "ajax/attCompra.php",
				data: "datapedido="+datapedido,
				success: function(data){
					if(data==1){
						opener.location.reload();
						window.close();			
					}else if(data==2){
						alert('Erro ao finalizar a Compra');					
					}else{
						alert('Existem Peças com Quantidade não definidas.');
					}				
				}
			});
		}
	});

	$('#cancelar').click( function(){
		var datapedido = $('#datapedido').val();
		if(confirm('Deseja Cancelar o pedido de Compra?')){
			$.ajax({
				type: "GET",
				url: "ajax/delCompra.php",
				data: "datapedido="+datapedido,
				success: function(data){
					if(data==1){
						opener.location.reload();
						window.close();			
					}else if(data==2){
						alert('Erro ao finalizar a Compra');					
					}else{
						alert('Existem Peças com Quantidade não definidas.');
					}					
				}
			});
		}
	});

	function qtd(idpeca){
		$('#qtd'+idpeca).val('');
	}
		
	function attPeca( idpeca ){
		var qtd = $('#qtd'+idpeca).val();
		var datapedido = $('#datapedido').val();
		$.ajax({
			type: "GET",
			url: "ajax/attQtdCompra.php",
			data: "idpeca="+idpeca+
				  "&qtd="+qtd+
				  "&datapedido="+datapedido,
			success: function(data){
				if(data==1){
					location.reload();						
				}else{
					alert('Erro ao atualizar Quantidade');						
				}					
			}
		});
	}
</script>