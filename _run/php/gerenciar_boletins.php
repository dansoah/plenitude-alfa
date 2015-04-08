<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	exit ;

include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;

$db -> abre(1);
$rel = $db -> query("SELECT sala.idsala \"id_sala\", sala.nome \"nome_sala\"
	FROM sala 
	INNER JOIN professorxsalaxmateria AS rel ON sala.idsala = rel.sala 
	INNER JOIN funcionario ON rel.professor = funcionario.id_funcionario", 1);
$db -> fecha(1);
?>
<script>
	$(document).ready(function(){
		$('#sala_select').change(function(){
			$.post('/req/get_materiasParaProfessorNaSala',{
				sala:$('#sala_select').val()
			},function(response){
				$('#materia_selector').html(response).fadeIn();
				$('.btnBox').fadeIn();
				load_alunos();
				$(".nota").mask("99,99");
			});
		});
		
	});
	
	function load_alunos(){
		$.post('/req/get_ListaBoletim',{
			sala:$('#sala_select').val()
		},function(data){
			$('#container_alunos').html(data);
		});
	}
</script>
<select name="sala" id="sala_select">
	<option selected value="-1">Sala</option>
	<?php
	for($i=0;$i<=count($rel)-1;$i++){
		echo "<option value=\"".$rel[$i]['id_sala']."\">".$rel[$i]['nome_sala']."</option>";
	}
	?>
</select>
<select name="materia" id="materia_selector" style="display:none">
	<option>Matéria</option>
</select>
<select name="periodo" id="periodo_selector" style="display:none;">
</select>
<div id="container_alunos"></div>
<div class="btnBox" style="display:none;">
		<button class="btnFalha" type="reset">Limpar</button> <button id="btnSalvarNoticia" class="btnSucesso" type="submit">Salvar</button>
	</div>
<link href="/layout/css/dualtables.css" rel="stylesheet" media="all"/>