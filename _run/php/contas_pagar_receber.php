<?php
header('Content-type: text/html; charset=UTF-8');
?>
<script src="../jQuery.js"></script>
<form name="conta" method="post" action="#">
	<div id="tipo_conta">
		<input type="radio" value="0" name="tipo_conta"/>
		Pagar
		<input type="radio" value="1" name="tipo_conta"/>
		Receber
	</div>

	<div id="geral_conta">
		Tipo:
		<input type="text" name="duracao" value="2"/>
		<br />
		Referente a:
		<input type="text" name="duracao" value="2"/>
		<br />
		Descrição:
		<input type="text" name="duracao" value="2"/>
		<br />
		Valor:
		<input type="text" name="duracao" value="2"/>
		<br />
		Emissão:
		<input type="text" name="duracao" value="<?php echo date("d/m/y"); ?>"/>
		<br />
		Vencimento:
		<input type="text" name="duracao" value="2"/>
	</div>

	<div id="botoes">
		<button type="button">
			Salvar
		</button>
	</div>
</form>
<style>
	.container_contas{
		width:400px;
		max-height:300px;
		overflow:auto;
	}
	.main_conta{
		width:410px;
		border:1px solid #CCC;
	}
	.direita{
		float:right;
	}
	.titulo_conta{
		font-size:17px;
		font-weight:bolder;
		color:#C0C0C0;
	}
	.tipo_conta{
		font-size:12px;
		font-weight:bold;
		font-family:verdana;
		background-color:#F0F0A0;
		color:#A0A0A0;
		height:18px;
	}
	table{
		width:400px;
	}
	td{
		font-family:verdana;
		font-size:10px;
	}
	.conta_nome{
		text-indent:10px;
		width:210px;
	}
	.conta_valor{
		width:110px;
	}
	.conta_data{
		width:80px;
	}
	dfn{
		cursor:default;
		font-style:normal;
	}
</style>
<div id="contas">
	<div id="pagar" class="main_conta direita">
		<span class="titulo_conta">Contas a pagar</span>
		<div class="container_contas">
			<table>
				<tr>
					<td colspan="4" class="tipo_conta">Impostos</td>
				</tr>
				<tr>
					<td class="conta_nome">IPTU</td>
					<td class="conta_valor">550,00</td>
					<td class="conta_data">15/11/2012</td>
				</tr>
				<tr>
					<td class="conta_nome">ICMS</td>
					<td class="conta_valor">550,00</td>
					<td class="conta_data">15/11/2012</td>
				</tr>
				<tr>
					<td colspan="3" class="tipo_conta">Custos operacionais</td>
				</tr>
				<tr>
					<td class="conta_nome">Luz</td>
					<td class="conta_valor">900,00</td>
					<td class="conta_data">5/10/12</td>
				</tr>
				<tr>
					<td class="conta_nome">Agua</td>
					<td class="conta_valor">750,00</td>
					<td class="conta_data">5/10/12</td>
				</tr>
				<tr>
					<td class="conta_nome">Telefone</td>
					<td class="conta_valor">1700,00</td>
					<td class="conta_data">5/10/12</td>
				</tr>
			</table>
		</div>
		<div class="container_total">
			<b>Total:</b><i>4450,00</i>
		</div>
	</div>
	<div id="receber" class="main_conta">
		<span class="titulo_conta">Contas a receber</span>
		<div class="container_contas">
			<table>
				<tr>
					<td colspan="4" class="tipo_conta">Operacional</td>
				</tr>
				<tr>
					<td class="conta_nome"><dfn title="Referencia">mensalidades</dfn></td>
					<td class="conta_valor"><dfn title="Valor">300.000,00</dfn></td>
					<td class="conta_data"><dfn title="Data de recebimento">15/11/2012</dfn></td>
				</tr>
				<tr>
					<td colspan="3" class="tipo_conta">Filiados</td>
				</tr>
				<tr>
					<td class="conta_nome"><dfn title="Referencia">Aluguel cantina</dfn></td>
					<td class="conta_valor"><dfn title="Valor">900,00</dfn></td>
					<td class="conta_data"><dfn title="Data de recebimento">5/10/12</dfn></td>
				</tr>
				<tr>
					<td class="conta_nome"><dfn title="Referencia">Aluguel biblioteca</dfn></td>
					<td class="conta_valor"><dfn title="Valor">750,00</dfn></td>
					<td class="conta_data"><dfn title="Data de recebimento">5/10/12</dfn></td>
				</tr>
			</table>
		</div>
		<div class="container_total">
			<b>Total:</b><i>301.650,00</i>
		</div>
	</div>
</div>
