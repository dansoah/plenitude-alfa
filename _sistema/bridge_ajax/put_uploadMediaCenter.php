<?php
include_once '/var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;

$exp = explode('.', $_FILES['uploadfile']['name']);

$nome=hash('sha512', $_FILES['uploadfile']['tmp_name'] . date('dmyhiss')) . '.' . $exp[count($exp) - 1];
$file = PASTA_UPLOAD . '/' . $nome;

if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	$id_usuario = $usu->aut_info['referencia'];
	$tipo_usuario = $usu->aut_info['tipo'];
	$turma = 0;
	$db->abre(1);
	$query = "INSERT INTO arquivos_mc (`nome`,`titulo`,`dono`,`tipo_dono`,`turma`,`data_upload`,`status`) VALUES ('".mysql_real_escape_string($_FILES['uploadfile']['name'])."','".$nome."','".$id_usuario."','".$tipo_usuario."','".$turma."',CURDATE(),'A')";
	
	$db->query($query, 1);
	$db->fecha(1);
	echo "success";
} else {
	echo "error";
}
?>