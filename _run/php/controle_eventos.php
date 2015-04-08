<script>
	
		$('#criar_novo').click(function(){
			alert('penis');
			$.post('/req/put_evento',{
				data: $('input[name=data]').val(),
				titulo: $('input[name=titulo]').val()
			},function(html){				
				$('#resultados').html(html);
			});
		});

</script>
<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<style>
	#src_input {
		width: 100%;
		font-size: 20px;
	}	#novo {
		padding: 10px;
		border-bottom: 1px solid #CCC;
	}
	#gerenciar {
		margin-top: 15px;
	}
	.header_novo_evento {
		font-size: 16px;
		font-weight: bold;
		color: #909090;
		font-family: arial;
	}	
	.resultado{
		margin-left:10px;
	}
	.first{
		margin-top:10px;
	}
	.esquerda{
		padding:5px;
		float:left;
		width:360px;
		
		border-bottom:1px solid #CCC;
	}
	.direita{
		padding:5px;
		width:100px;
		border-left:5px solid #CCC;
		margin-left:360px;
		background-color:#E9E9E9;
		border-bottom:1px solid #CCC;
		text-align:center;
	}
	.direita a{
		font-size:14px;
		font-family:arial;
		font-weight:bold;
		color:#212121;
		text-decoration:none;
	}
</style>
<div id="novo">
	<span class="header_novo_evento">Novo: </span>
	<input type="text" name="data" placeholder ="data" />
	<input type = "text" name="titulo" placeholder="titulo" />
	<button id="criar_novo" class="btnSucesso" type="submit">
		Salvar
	</button>
</div>
<div id="gerenciar">
	<div id="pesquisa">
		<input type="text" name="oque" placeholder ="Pesquisar" id="src_input"/>
	</div>
	<div id="resultados">
		<div class="resultado first">
			<div class="esquerda">
				<span class="titulo_evento">Titulo</span><br />
				<span class="data_evento">data</span> - <span class="retricao_evento">Restrito para: <i>aaa</i></span>
			</div>
			<div class="direita">
				<a href="1" class="excluir">excluir</a>
			</div>
		</div>
	</div>
</div>
