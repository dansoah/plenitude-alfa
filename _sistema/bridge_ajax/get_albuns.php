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
$rel = $db -> query("SELECT * FROM album",1);
$db -> fecha(1);

$total = count($rel)-1;

if($total == 0){
	echo "Nenhum album cadastrado!";
	exit;
}

echo"<ul>";
for($i=0;$i<=$total;$i++){
	echo "<li>
			<a href=\"".$rel[$i]['id_album']."\">".$rel[$i]['titulo']."</a>
		</li>";
}
echo"</ul>";
?>


