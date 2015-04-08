<?php
include_once '/var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;

$exp = explode('.', $_FILES['uploadfile']['name']);

$nome=hash('sha512', $_FILES['uploadfile']['tmp_name'] . date('dmyhiss')) . '.' . $exp[count($exp) - 1];
$file = PASTA_UPLOAD_NOTICIAS . '/' . $nome;

if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	echo $nome;
} else {
	echo "error";
}
?>