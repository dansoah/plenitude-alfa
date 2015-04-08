<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	exit ;

include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu -> reload_info();
if(!$usu -> check_online())
	exit ;

$db -> abre(1);
$rel = $db -> query("SELECT aluno.id_aluno, aluno.nome, aluno.sobrenome FROM lista_chamada AS lst
INNER JOIN aluno ON lst.id_aluno = aluno.id_aluno
WHERE lst.id_sala='" . mysql_real_escape_string($_POST['sala']) . "'", 1);
$db -> fecha(1);
?>

<tr>
	<td class="tbheader">#</td>
	
	<td class="tbheader">Aluno</td>
	
	<td class="tbheader">Presença</td>
</tr>
<?php
for($i = 0; $i <= count($rel) - 1; $i++) {
	$numero = $i + 1;
	echo "
<tr>
<td class=\"esquerda\">" . $numero . "</td>
<td class=\"esquerda\">" . $rel[$i]['nome'] . " " . $rel[$i]['sobrenome'] . "</td>
<td class=\"direita\"><input type=\"checkbox\" name=\"aluno[" . $rel[$i]['id_aluno'] . "]\" value=\"1\" checked/></td>
</tr>
";
}
?>
<link href="/layout/css/dualtables.css" rel="stylesheet" media="all"/>
