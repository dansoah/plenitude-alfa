<?php
include_once '/var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;

$exp = explode('.', $_FILES['uploadfile']['name']);

$nome=hash('sha512', $_FILES['uploadfile']['tmp_name'] . date('dmyhiss')) . '.' . $exp[count($exp) - 1];
$file = PASTA_UPLOAD_BG . '/' . $nome;
//var_dump($usu->aut_info);
if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	$id_usuario = $usu->aut_info['referencia'];
	$tipo_usuario = $usu->aut_info['tipo'];
	$turma = 0;
	$db->abre(1);
	$query = "UPDATE autenticar SET bg = '".$nome."' WHERE id_aut = '".$usu->aut_info['id_aut']."'";	
	$db->query($query, 1);
	$db->fecha(1);
	echo "success";
} else {
	echo "error";
}
?>