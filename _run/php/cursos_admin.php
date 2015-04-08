<script>
	$(document).ready(function() {
		refresh();
	});
	
	function refresh(){
		load_cursos();
		load_turmas();
		load_periodos();
	}
	
	function load_cursos() {
		$.ajax({
			url : '/req/get_cursos',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_curso').html(html);
			}
		});

	}
	function load_turmas() {
		$.ajax({
			url : '/req/get_turmas',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_turma').html(html);
			}
		});

	}
	function load_periodos() {
		$.ajax({
			url : '/req/get_periodos',
			dataType : 'html',
			success : function(html) {
				$('#gerenciar_periodo').html(html);
			}
		});

	}
</script>
<div id="curso">
	<h1> Cursos </h1>
	<div class="first" id="adicionar_curso">
		<input type="text" name="novo_curso" />
		<button type="button">
			Criar
		</button>
	</div>
	<div id="gerenciar_curso"></div>
</div>
<div id="turmas">
	<h1> Turmas </h1>
	<div class="first" id="adicionar_turma">
		<input type="text" name="nova_turma" />
		<button type="button">
			Criar
		</button>
	</div>
	<div id="gerenciar_turma"></div>
</div>
<div id="periodo">
	<h1> Periodos </h1>
	<div class="first" id="adicionar_periodo">
		<input type="text" name="novo_curso" />
		<button type="button">
			Criar
		</button>
	</div>
	<div id="gerenciar_periodo"></div>
</div>
<style>
	.tb_cursos {
		border: 1px solid #000;
	}	
	.first{
		margin-top:15px;
	}
		#curso{
		margin-top:10px;
		width:300px;
		float:left;
		height:200px;
		border-right:3px dashed #CCC;
		overflow:auto;
		padding-right:5px;
	}
	#turmas{
		margin-top:10px;
		width:390px;
		float:right;
		height:200px;
		overflow:auto;
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
