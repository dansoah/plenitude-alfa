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
$query = "SELECT materia.idmateria \"id_materia\", materia.nome \"nome_materia\"
	FROM professorxsalaxmateria AS rel 
	INNER JOIN materia ON materia.idmateria = rel.materia
	WHERE
	rel.professor = '" . $usu -> user_info['id_funcionario'] . "' AND rel.sala = '" . mysql_real_escape_string($_POST['sala']) . "'";
$rel = $db -> query($query, 1);

$db -> fecha(1);
if((count($rel)) == 0) {
	echo "nada";
	exit ;
}
?>
<?php
for($i = 0; $i <= count($rel) - 1; $i++) {
	echo "<option value=\"" . $rel[$i]['id_materia'] . "\">" . $rel[$i]['nome_materia'] . "</option>";
}
