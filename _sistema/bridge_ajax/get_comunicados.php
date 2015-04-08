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
$res = $db->query("SELECT * FROM comunicado", 1);
$db->fecha(1);

if(count($res)-1 > 0){
for($i=0;$i<=count($res)-1;$i++){
?>
<li class="comunicado_li">
	<span class="header_cmm"><?php echo $res[$i]['titulo'];?></span>
	<p class="content_cmm">
		<?php $comm = str_replace('<p>', '', $res[$i]['conteudo']);
		$comm = str_replace('</p>','',$comm);
		echo $comm;
		?>
	</p>
	<span class="footer_cmm"><?php echo $res[$i]['data'];?></span>
</li>
<?php
}
}else{
echo "<li>Sem comunicados!</li>";
}
