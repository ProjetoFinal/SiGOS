<?php
function __autoload($class){
	include_once("../../dao/$class.class.php");
}
include_once("topo.php");
include_once("../function/formataData.php");

extract( $_GET );

$sql = new Conexao();
$sql->conecta();

$sql->consulta( OS::consultarOs( $idos ) );
$l = $sql->resultado();

?>
<style>
	#menu{ display: none; }
	#central{ margin-top:-50px; width:500px;}
	table{ width:500px; background: #fff !important; }
	tr{ height: 30px; }
	td{ border-bottom: 1px solid #aaa}
	td{ border-right: 1px solid #aaa}
	td{ border-left: 1px solid #aaa}
	tr.defeito{ height: 80px; }
	tr.peca{ height: 130px; overflow: auto; }
	div.peca{ overflow: auto; height: 100px;  margin-bottom: 5px; }
	textarea{ height:80px; width:360px; font-size: 14px !important; }
	#linhaPeca{
		border-bottom: 1px solid #999;
		width: 350px;
		height: 25px;
		float: left;
		margin-bottom: 5px;
	}
	#menosUm{ float:left;}
</style>
<table border=0 cellspacing=0>
	<tr>
		<td>OS Nº.</td>
		<td>
			<?=$l['idordemdeservico']?>
			<input type="hidden" id="idordemdeservico" value="<?=$l['idordemdeservico']?>" />
		</td>
	</tr>
	<tr>
		<td>Entrada</td>
		<td><?=data_dmy($l['entrada'])?></td>
	</tr>
	<tr>
		<td>Equipamento</td>
		<td><?=$l['tipo']." - ".$l['marcaequip']." - ".$l['modeloequip']?></td>
	</tr>
	<tr>
		<td>Mão de obra</td>
		<td>R$ <?=$l['maodeobra']?></td>
	</tr>
	<tr class="defeito">
		<td>Defeito</td>
		<td><?=$l['defeito']?></td>
	</tr>
	<tr class="peca">
		<td>Peça</td>
		<td>
			<div class="peca">
				<?php
					$peca = $sql->consulta( PecaSolicitada::consultaPorOS( $l['idordemdeservico'] ) );
					if($peca){
					while( $p = $sql->resultado() ){
				?>
					<div id="linhaPeca">
						<?=$p['nomepeca']?>  |  <input type="text" id="qtdPeca<?=$p['idpecasolicitada']?>" 
												value="<?=$p['qtdsolicitada']?>" 
													style="width: 20px; height: 15px"
													readonly />	
					</div>
				<?php } } else { echo "Sem registros"; } ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>Total Peça</td>
		<td>R$ <?=$l['valorpecasusadas']?></td>
	</tr>
	<tr>
		<td>Solução</td>
		<td><textarea id="solucao" readonly><?=$l['solucao']?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr style="background:green; color: #000; text-transform: bold;">
		<td>Valor Final</td>
		<td>
			R$ <?=$l['valorpecasusadas'] + $l['maodeobra']?>
			<input type="hidden" id="totalFinal" value="<?=$l['valorpecasusadas'] + $l['maodeobra']?>" />	
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<?php if($l['idstatus'] == 8 ){ ?>
			<input type="button" name="ap" id="ap" class="bt_entregar" value="Entregar" />
			<input type="button" name="rp" id="rp" class="bt_reabrir" value="Reabrir" />
			<?php } ?>
			<input type="button" onclick="window.close()" class="bt_voltar" value="Fechar" />
		</td>
	</tr>
</table>

<script>
	/*
	$('#ap').click( function(){
		var idos = $('#idordemdeservico').val();

		if(confirm('Deseja finalizar OS de Nr. '+idos)){
			$.ajax({
				type: "GET",
				url: "ajax/entregar.php",
				data: "idos="+idos,
				success: function(data){
					if(data==1){
						opener.location.reload();
						window.close();			
					}else{
						alert('Erro ao tentar Entregar o Equipamento e Finalizar a OS de Nr. '+idos);						
					}					
				}
			});
		}
	});
	*/

	$('#ap').click( function(){
		var idos = $('#idordemdeservico').val();
		var total = $('#totalFinal').val();
		window.open('pagarOs.php?idos='+idos+'&total='+total, 'PagarOs','width=400,height=300');
	});

	$('#rp').click( function(){
		var idos = $('#idordemdeservico').val();

		if(confirm('Deseja Reabrir OS de Nr. '+idos)){
			$.ajax({
				type: "GET",
				url: "ajax/reabrirOs.php",
				data: "idos="+idos,
				success: function(data){
					if(data==1){
						opener.location.reload();
						window.close();			
					}else if(data==2){
						$('#defeitoReabertura').css('background','#FBE3E4');
						$('#defeitoReabertura').css('border','1px solid #FBC2C4');
					}else{
						alert('Erro ao tentar Reabrir OS de Nr. '+idos);						
					}					
				}
			});
		}
	});

	$('#defeitoReabertura').click( function(){
		$('#defeitoReabertura').css('background','#fff');
		$('#defeitoReabertura').css('border','1px solid #000');
	});
</script>