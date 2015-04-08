<?php
/*
 * Compressor 1
 * 
 * Comprime CSS e JavaScript
 * 
 * Deve ser incluido com variavel $tipo setada como JS ou CSS e variável $content contendo os arquivos
 * 
 */

include_once '/var.php';

 //cfg
 switch($tipo){
 	case'css':
		$pasta = PASTA_CSS;
		$content_type = 'text/css';
		break;
	case 'js':
		$pasta = PASTA_JS;
		$content_type = 'text/javascript';
		break;
 }

$arquivo = explode(',',$content);

//lopp base
$resultado = NULL;

for($i=0;$i<=count($arquivo)-1;$i++){
	if($fp = fopen($pasta."/".$arquivo[$i],'r')){
		while($fr = fread($fp,1024)){
			$resultado .= $fr;
		}
		fclose($fp);
	}
}

function compress($buffer){
	/* remove os comentarios */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, espaços, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}

#################################################################################
#				ComPRESSão
#################################################################################

//error_reporting(0);
header('Content-type: '.$content_type);

ob_start("compress");
echo $resultado;
ob_flush();


