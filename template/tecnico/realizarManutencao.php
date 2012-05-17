<?php
#function __autoload($class){
#	include_once("../../dao/$class.class.php");
#}
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
<table border=1>
	<tr>
		<td>OS N.</td>
		<td>
			<?=$l['idordemdeservico']?>
			<input type="hidden" id="idordemdeservico" value="<?=$l['idordemdeservico']?>" />
			<input type="hidden" id="idorcamento" value="<?=$idor?>" />
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
		<td>Acompanhamento</td>
		<td>
			<textarea id="acompanhamento"><?=$l['acompanhamento']?></textarea>
			<input type="button" class="bt_attacomp" id="attAcompanhamento" value="Atualizar Acompanhamento" />
		</td>

	</tr>
	<tr>
		<td>Solução<span style="color:red">*</span></td>
		<td>
			<textarea id="solucao"><?=$l['solucao']?></textarea>
		</td>

	</tr>

	<tr style="background:green; color: #000; text-transform: bold;">
		<td>Valor Final</td>
		<td>R$ <?=$l['valorpecasusadas'] + $l['maodeobra']?></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="button" class="bt_fimmanut" id="fecharManutencao" value="Finalizar Manutenção" />
			&nbsp;
			<input type="button" class="bt_voltar" onclick="window.close()" value="Fechar sem Finalizar" />
		</td>
	</tr>
</table>

<script>
	function abrir(pagina,largura,altura) {

		//pega a resolução do visitante
		w = screen.width;
		h = screen.height;

		//divide a resolução por 2, obtendo o centro do monitor
		meio_w = w/2;
		meio_h = h/2;

		//diminui o valor da metade da resolução pelo tamanho da janela, fazendo com q ela fique centralizada
		altura2 = altura/2;
		largura2 = largura/2;
		meio1 = meio_h-altura2;
		meio2 = meio_w-largura2;

		//abre a nova janela, já com a sua devida posição
		window.open(pagina,'','height='+altura+',width='+largura+',top='+meio1+',left='+meio2+',scrollbars=no, toolbar=no'); 
	}

	$('#addPeca').click( function(){
		abrir('addPeca.php?idos=<?=$idos?>&idor=<?=$idor?>','1000','600');
	});

	$('#menosUm').css('cursor','pointer');

	function menosUm( id, idor, valor ){
		var qtd = $('#qtdPeca'+id).val() - 1;
		$.ajax({
			type: "GET",
			url: "ajax/menosUma.php",
			data: "idpecasolicitada="+id+
				  "&idor="+idor+
				  "&qtd="+qtd+
				  "&valor="+valor,
			success: function(data){
				if(data==1){
					location.reload();						
				}else{
					alert('Erro ao remover uma unidade de Peca');						
				}					
			}
		});
	}

	$('#attAcompanhamento').click( function(){
		var idos = $('#idordemdeservico').val();
		var acompanhamento = $('#acompanhamento').val();
		$.ajax({
				type: "GET",
				url: "ajax/attAcompanhamento.php",
				data: "idos="+idos+
					  "&acompanhamento="+acompanhamento,
				success: function(data){
					if(data==1){
						location.reload();			
					}else{
						alert('Erro ao tentar atualizar Acompanhamento');						
					}					
				}
			});
	});

	$('#fecharManutencao').click( function(){
		var idos = $('#idordemdeservico').val();
		var solucao = $('#solucao').val();

		if(confirm('Deseja finalizar a Manutencao da OS de Nr. '+idos)){
			$.ajax({
				type: "GET",
				url: "ajax/fecharManutencao.php",
				data: "idos="+idos+
					  "&solucao="+solucao,
				success: function(data){
					if(data==1){
						opener.location.reload();
						window.close();			
					}else if(data==2){
						$('#solucao').css('background','#FBE3E4');
						$('#solucao').css('border','1px solid #FBC2C4');
					}else{
						alert('Erro ao tentar finalizar Manutencao');						
					}					
				}
			});
		}
	});

	$('#solucao').click( function(){
		$('#solucao').css('background','#fff');
		$('#solucao').css('border','1px solid #000');
	});
</script>