<?php

/*
 *
 *
 */

include_once '/var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit;


echo "oi";
exit;
//Uploadeando
var_dump($_FILES);
$exp = explode('.', $_FILES['uploadfile']['name']);

if ($_FILES['uploadfile']['type'] != "application/x-zip") {
	echo "tipo incorreto de arquivo:";
	exit ;
}

$nome = hash('sha512', $_FILES['uploadfile']['tmp_name'] . date('dmyhiss')) . '.' . $exp[count($exp) - 1];
$file = PASTA_TEMPORARIOS . '/zip/' . $nome;

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	$nome_arquivo = $file;
} else {
	echo "error";
	exit ;
}

//Extraindo e exibindo

$nome_dir = date('dmyhis') . "_" . hash('sha512', date('dmyhis' . $nome_arquivo));
$nome_dir = PASTA_TEMPORARIOS . '/galeria/' . $nome_dir;

$extensoes = array('jpg', 'jpeg', 'png');

if (@fopen($nome_arquivo, 'r')) {
	$za = new ZipArchive();
	if ($handler = $za -> open($nome_arquivo)) {//aquui vai o arquivo temporario
		if (mkdir($nome_dir)) {
			$za -> extractTo($nome_dir);
			$za -> close($handler);
			unlink($nome_arquivo);

			if ($dh = opendir($nome_dir)) {
				while (($file = readdir($dh)) !== false) {
					echo "ok";
					$exp = explode('.', $file);
					$ext = $exp[count($exp) - 1];
					if (in_array($ext, $extensoes))
						echo "<figure>
		<img src=\"img/foto_exemplo.jpg\" width=\"150\"/>
		<input type=\"checkbox\" checked=\"checked\"/>
	</figure>";
					else
						unlink($file);
				}
				closedir($dh);


			}

		}

	}
} else {
	echo "error";
}



function delTree($dir) {
	$files = array_diff(scandir($dir), array('.', '..'));
	foreach ($files as $file) {
		(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
	}
	return rmdir($dir);
}
?>
	