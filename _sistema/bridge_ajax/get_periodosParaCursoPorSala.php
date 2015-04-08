<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	exit ;

include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];

if(!$usu -> check_online())
	exit ;
$usu->reload_info();
$db -> abre(1);
$query = "
SELECT periodo.idperiodo,periodo.nome FROM periodo 
INNER JOIN periodoxcurso AS pXc ON pXc.periodo = periodo.idperiodo
INNER JOIN curso ON pXc.curso = curso.idcurso
INNER JOIN sala ON sala.idsa
";
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
