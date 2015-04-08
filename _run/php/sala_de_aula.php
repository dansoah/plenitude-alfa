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
<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<link href="/layout/css/dualtables.css" rel="stylesheet" media="all"/>
<script>
	$(document).ready(function(){
		$(".data").mask("99/99/9999");
		$('#sala_select').change(function(){
			$.post('/req/get_materiasParaProfessorNaSala',{
				sala:$('#sala_select').val()
			},function(response){
				alert(response);
				$('#materia_selector').html(response).fadeIn();
				$('input[name=data_faltas]').fadeIn();
				$('.btnBox').fadeIn();
				load_alunos();
			});
		});
	});
	
	function load_alunos(){
		$.post('/req/get_ListaChamada',{
			sala:$('#sala_select').val()
		},function(data){
			$('#chamada').append(data);
		});
	}
</script>
<style>
	
</style>
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
<input type='text' name='data_faltas' maxlength="10" size="12" class="data" style="display:none;"/>
<div id="container_alunos">
	<table id="chamada">
		
	</table>
	<div class="btnBox" style="display:none;">
		<button class="btnFalha" type="reset">Limpar</button> <button id="btnSalvarNoticia" class="btnSucesso" type="submit">Salvar</button>
	</div>
</div>