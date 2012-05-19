<?php
function __autoload($class){
	include_once("../../dao/$class.class.php");
}
include_once("topo.php");
include_once("../function/formataData.php");


extract($_GET);


?>

<style>
	#menu{ display: none; }
	#central{ margin-top:-50px; width:380px; height:300px; }
	table{ width:380px; background: #fff !important; }
	tr{ height: 30px; }
	td{ border-bottom: 0px solid #aaa}
	td{ border-right: 0px solid #aaa}
	td{ border-left: 0px solid #aaa}
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
<script>
	$(document).ready( function(){
		$('td:even').css('color','#777');
		$('td:even').css('font-weight','bold');
		$('td:odd').css('text-align','left');
	});
</script>
<span
	style="
		font-size: 20px;
		font-weight: bold;
		color: #777;
	";>
	Pagamento
</span>
<table border=0 cellspacing=0>
<form id="form" method="post" action="ajax/pagarOs.php">

	<tr>
		<td>OS Nº.</td>
		<td>
			<?=$idos?>
			<input type="hidden" name="idos" value="<?=$idos?>" />
		</td>
	</tr>
	<tr>
		<td>Tipo Pagamento</td>
		<td>
			<select id="tp" name="tp">
				<option selected>--- Tipo de Pagamento</option>				
				<option>-----------</option>
				<?php
					$sql = new Conexao();
					$sql->conecta();
					$sql->consulta( Pagamento::listarTipo() );
					while($r = $sql->resultado() ){
				?>
					<option 
					<?php
						if($r['idtipopagamento'] == 3)
							echo "id='show'";	
					?>	
					value="<?=$r['idtipopagamento']?>"><?=$r['tipo']?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Total</td>
		<td>
			<span style="color:darkgreen;font-weight:bold;">R$ <?=$total?></span>
			<input type="hidden" id="total" name="total" value="<?=$total?>" />	
		</td>
	</tr>
	<tr class="vp" style="display:none">
		<td>Valor Pago</td>
		<td><input type="text" id="vp" name="vp" /></td>
	</tr>
	<tr class="desconto" style="display:none">
		<td>Desconto</td>
		<td><input type="text" id="desconto"  readonly/></td>
	</tr>
	<tr class="troco" style="display:none">
		<td>Troco</td>
		<td><input type="text" id="troco"  readonly/></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="button" class="bt_pagar" id="pagar" value="Pagar" />
			<input type="button" class="bt_voltar" onclick="window.close();" value="Voltar" />
		</td>
	</tr>
</table>
</form>
<script>
	$('select#tp').change( function(){
		var tipo = "";
		$('select #show:selected').each( function(){
			tipo = $(this).text();
		});
		if( tipo == 'DINHEIRO'){
			$('.vp').show(200);
			$('.troco').show(200);
			var total = parseFloat($('#total').val());
			var desc = total / 100 * 3;
			$('#desconto').val(desc.toFixed(2));
			$('.desconto').show(200);
		}else{
			return false;
		}
	});

	$('#vp').keyup( function(){
		var tecla = window.event.keyCode;

		if( tecla == 13){
			var vp = 0;
			var desc = 0;
			var tipo = '';
			var total = parseFloat($('#total').val());
			var troco = 0;
			vp = parseFloat($('#vp').val());

			$('select #show:selected').each( function(){
				tipo = $(this).text();
			});

			if( tipo == 'DINHEIRO')
				desc = total / 100 * 3;

			total = total - desc;	
			troco = vp - total;
			troco = troco.toFixed(2);

			$('#troco').val(troco);
			$('#pagar').focus();
		}
	});

	$('#pagar').click( function(){
		$('#form').submit();
	});
</script>