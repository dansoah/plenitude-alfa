<script>
	$(document).ready(function() {
		refresh();
	});
	
	function refresh(){
		load_departamentos();
		load_cargos();
		load_periodos();
	}
	
	function load_departamentos() {
		$.ajax({
			url : '/req/get_departamentos',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_depto').html(html);
			}
		});

	}
	function load_cargos() {
		$.ajax({
			url : '/req/get_cargos',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_cargo').html(html);
			}
		});

	}
	function load_relacionamento() {
		$.ajax({
			url : '/req/get_periodos',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_periodo').html(html);
			}
		});

	}
</script>
<div id="departamentos">
	<h1> Departamentos </h1>
	<div class="first" id="adicionar_depto">
		<input type="text" name="novo_depto" />
		<button type="button">
			Criar
		</button>
	</div>
	<div id="gerenciar_depto"></div>
</div>
<div id="cargos">
	<h1> Cargos </h1>
	<div class="first" id="adicionar_cargo">
		<input type="text" name="novo_cargo" />
		<button type="button">
			Criar
		</button>
	</div>
	<div id="gerenciar_cargo"></div>
</div>
<div id="relacionamento">
	<h1> Relação entre cursos e cargos </h1>
	
	<div id="gerenciar_periodo"></div>
</div>
<style>
	.first{
		margin-top:15px;
	}
	
	#departamentos{
		margin-top:10px;
		width:300px;
		float:left;
		height:200px;
		border-right:3px solid #CCC;
		border-bottom:1px solid #CCC;
		overflow:auto;
		padding-right:5px;
	}
	#cargos{
		margin-top:10px;
		width:390px;
		float:right;
		height:200px;
		overflow:auto;
		border-bottom:1px solid #CCC;
	}
	
	h1{
		font-family:arial;
		font-size:18px;
		color:#313131;
		text-align:center;
		display:block;
		border-bottom: 1px solid #CCC;
	}
</style>
