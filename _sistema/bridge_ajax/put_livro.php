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
$var = $_POST;
$db->abre(1);
if($db->query("INSERT INTO livro (`titulo`,`autor`,`ISBN`,`ano`,`sinopse`,`estoque_atual`) VALUES ('".$var['titulo']."','".$var['isbn']."','".$var['ano']."','".$var['sinopse']."','".$var['estoque']."')",1)){
	echo 'sucesso';
}else{
	echo "INSERT INTO livro (`titulo`,`autor`,`ISBN`,`ano`,`sinopse`,`estoque_atual`) VALUES ('".$var['titulo']."','".$var['autor']."','".$var['isbn']."','".$var['ano']."','".$var['sinopse']."','".$var['estoque']."')";
	echo'falhou';
}
$db->fecha(1);
?>