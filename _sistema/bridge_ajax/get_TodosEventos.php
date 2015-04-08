<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	exit ;

include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;
$db->abre(1);
$res = $db->query("SELECT * FROM evento WHERE para='".$usu->aut_info['tipo']."' OR para=0",1);
$db->fecha(1);
?>
<ul>
<?php
for($i=0;$i<=count($res)-1;$i++){
?>
	<li><?php echo $res[$i]['data'].' - '.$res[$i]['titulo']; ?></li>
<?php
}
?>
</ul>
