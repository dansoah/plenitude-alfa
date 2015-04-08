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
	if($db->query("INSERT INTO noticia (`titulo`,`conteudo`,`tags`,`responsavel`,`imagem`) VALUES ('".mysql_real_escape_string($_POST['titulo'])."','".mysql_real_escape_string($_POST['conteudo'])."','notags','".mysql_real_escape_string($usu->user_info['id_funcionario'])."','".mysql_real_escape_string($_POST['imagem'])."')", 1)){
		echo "sucesso";
	}else{
		echo "falhou";
	}
$db->fecha(1);