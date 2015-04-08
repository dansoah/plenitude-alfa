<?php
session_start();
define('PASTA_BASE', 'c:/wamp/www/plenitude_alfa', true);
define('PASTA_PAGINAS', PASTA_BASE . '/_run', true);
define('PASTA_CSS', PASTA_BASE . "/layout/css");
define('PASTA_SISTEMA', PASTA_BASE . "/_sistema/php");
define('PASTA_AJAX', PASTA_BASE . "/_sistema/bridge_ajax");
define('PASTA_UPLOAD', PASTA_BASE . '/midia_center/arquivos', true);
define('PASTA_UPLOAD_NOTICIAS', PASTA_BASE . '/media/dcim_news', true);
define('PASTA_UPLOAD_BG', PASTA_BASE . '/media/bg', true);
define('PASTA_TEMPORARIOS', PASTA_BASE.'/__temp');
//Headers <3

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Expires: 0');

//DEFININDO BANCO DE DADOS
include_once PASTA_SISTEMA . '/mysql.class.php';
global $db;
$db = new database();
$db -> novoDB("localhost", "root", "", "plenitude_alfa", 1);

//DEFININDO USUARIOS
include_once PASTA_SISTEMA . '/usuario.class.php';
global $usu;
$usu = new usuario();
