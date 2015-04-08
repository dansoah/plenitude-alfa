<style>
	#src_input{
		width:100%;
		font-size: 20px;
	}
	form{
		font-family:verdana;
		color:#212121;
	}
	#resultados{
		border-top:1px dashed #CCC;
		padding-top:20px;
		margin-top:20px;
	}
	.nome{
		font-size:18px;
		color:#909090;
		font-family:arial;
		font-weight:bold;
	}
	.srcRES{
		height:80px;
		padding:15px;
		border-bottom:1px solid #CCC;
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
		$.post('/req/src_info',{
			oque: $('input[name=oque]').val(),
			onde:  $("input[name=onde]:checked").val()
		},function(data){
			$('#resultados').html(data);
		});
	}
	
</script>
<div id="formPesquisa">
	<form method="post">
		<input type="text" name="oque" id="src_input" placeholder="Quem deseja encontrar?" /><br />
		<input type="radio" name = "onde" value="0"> Alunos
		<input type="radio" name = "onde" value="1" checked> Responsáveis
		<input type="radio" name = "onde" value="2"> Funcionários
	</form>
</div>
<div id="resultados">
	
</div>
