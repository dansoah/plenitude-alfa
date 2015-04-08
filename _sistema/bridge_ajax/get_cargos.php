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

$db->abre(1);
$cursos = $db->query('SELECT * FROM cargo',1);
$db->fecha(1);
?>

<table class="tb_cargos">
<?php
for($i=0;$i<=count($cursos)-1;$i++){
?>
<tr>
	<td><?php echo $cursos[$i]['desc_cargo']; ?></td>
	<td><a href="<?php echo $cursos[$i]['id_cargo']; ?>" class="ativar">ativar</a> | <a href="<?php echo $cursos[$i]['id_cargo']; ?>" class="desativar">desativar</a></td>
</tr>
<?php
}?>

</table>