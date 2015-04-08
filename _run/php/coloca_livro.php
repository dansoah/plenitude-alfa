<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	header('location:/');
	exit ;
}
include_once '/var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit;

?>
<style>
	#declarar {
		padding:10px;
		border-bottom:1px solid #CCC;
	}
	.header_recentes_saidas{
		padding:5px;
		display:block;
		font-size:16px;
		font-weight:bold;
		color:#909090;
		font-family:arial;
	}
	
	#declarar{
		font-family:arial;
		color:#212121;
		
	}
	#declarar .input, #declarar textarea{
		padding:4px;
		margin-top:10px;
		border:1px solid #CCC;
	}
	
	#divdeclarar{
		width:400px;
		margin-left:30px;
	}
	
	.rotulo{
		color:#999;
		font-family:arial;
		font-weight:bold;
	}
</style>
<script>
	$('#btnSalvar').click(function(){
		$.post('/req/put_livro',{
			titulo: $('input[name=titulo]').val(),
			autor: $('input[name=autor]').val(),
			ano: $('input[name=ano]').val(),
			isbn: $('input[name=isbn]').val(),
			estoque: $('input[name=estoque]').val(),
			sinopse: $('textarea[name=sinopse]').val()
		},function(html){
			alert(html);
			if(html === 'sucesso'){
				alert('Inserido com sucesso!');
			}else{
				alert('Falha ao inserir!');
			}
		});
		return false;
	});
</script>
<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<form id="declarar">
<span class="header_recentes_saidas">Novo livro</span>
	<div id="divdeclarar">		
		<input class="input" type="text" name="titulo" placeholder="Titulo" size="50"/>
		<br />
		<input class="input" type="text" name="autor" placeholder="Autor" size="50"/>
		<br />
		<input class="input" type="text" name="ano" placeholder="Ano" size="50"/>
		<br />
		<input class="input" type="text" name="isbn" placeholder="ISBN" size="50"/>
		<br />
		<input class="input" type="text" name="estoque" placeholder="Estoque inicial" size="50"/>
		<br />
		<textarea name="sinopse" placeholder="sinopse" cols="60" rows="5"></textarea>
		<br />
	</div>
<div class="btnBox">
		<button class="btnFalha" type="reset">Limpar</button> <button id="btnSalvar" class="btnSucesso" type="submit">Salvar</button>
	</div>
</form>