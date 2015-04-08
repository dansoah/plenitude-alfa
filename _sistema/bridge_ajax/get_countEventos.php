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
$res = $db->query("SELECT count(*)\"contagem\" FROM evento WHERE para='".$usu->aut_info['tipo']."' OR para=0",1);
$db->fecha(1);

echo $res[0]['contagem']
?>
