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
	#central{ margin-top:-50px; }
	table{ width:500px; }
	tr{ height: 30px; }
	tr.defeito{ height: 80px; }
	tr.peca{ height: 130px; overflow: auto; }
	div.peca{ overflow: auto; height: 100px;  margin-bottom: 5px; }
	textarea{ height:80px; width:390px; font-size: 14px !important; }
	#linhaPeca{
		border-bottom: 1px solid #999;
		width: 350px;
		height: 25px;
		float: left;
		margin-bottom: 5px;
	}
	#menosUm{ float:left;}
</style>
<table border=1>
	<tr>
		<td>OS N.</td>
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
		<td>Comentários</td>
		<td><textarea id="comentarios" readonly><?=$l['comentarios']?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr style="background:green; color: #000; text-transform: bold;">
		<td>Valor Final</td>
		<td>R$ <?=$l['valorpecasusadas'] + $l['maodeobra']?></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			&nbsp;
			<input type="button" class="bt_fechar" onclick="window.close()" value="Fechar" />
		</td>
	</tr>
</table>