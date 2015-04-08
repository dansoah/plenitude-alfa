<?php
header('Content-type: text/html; charset=UTF-8');
?>

<style>
#estoque {
		width: 400px;
		margin-top:20px;
	}
	
	.livro{
		width:400px;
		padding:10px;
		border:1px solid #CCC;
		margin-left:10px;
	}
	
	.img_livro{
		float:left;
		width:70px;
		height:100px;
		border:2px solid #CCC;
		margin-top:15px;
		
	}
	
	.resto_livro{
		width:320px;
		height: 130px;
		margin-left:80px;
	}
	
	.titulo_livro{
		font-size:14px;
		font-family: verdana;
		font-weight: bold;
		color:#282828;
		text-decoration: underline;
	}
	.sinopse_livro{
		width:300px;
		margin-top:10px;
		padding-bottom:15px;
	}
	#src_input{
		width:100%;
		font-size: 20px;
	}
</style>
<script>
	$('input[name=oque]').keyup(function(event){
		reload_info();
	});
	
	$('input[name=onde]').click(function(event){
		reload_info();
	});
	
	function reload_info(){
		$.post('/req/src_livro',{
			oque: $('input[name=oque]').val()
		},function(data){
			$('#estoque').html(data);
		});
	}
	
</script>
<div id="src">
	<input type="text" name="oque" id="src_input" placeholder="Nome do livro..." /><br />
</div>
<div id="estoque">
	
</div>

