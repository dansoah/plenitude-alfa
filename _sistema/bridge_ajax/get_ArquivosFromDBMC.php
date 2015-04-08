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

$query = "SELECT * FROM arquivos_mc";

$db->abre(1);
$res = $db->query($query, 1);
$db->fecha(1);
if(count($res)>0){
	for($i=0;$i<=count($res)-1;$i++){
	
?>
<li class="arquivoListado">
	<span class="nomeArquivo"><a href="/midia_center/arquivos/<?php echo $res[$i]['titulo']; ?>" target="_blank"><?php echo $res[$i]['nome']; ?></a></span>
	<br />
	<span class="dataArquivo"><?php echo $res[$i]['data_upload']; ?></span>
</li>
<?php
	}
}
