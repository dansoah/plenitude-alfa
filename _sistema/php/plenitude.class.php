<?php

class plenitude extends usuario{
	public function get_url($array=true){
		if($array)
			return explode('/', $_SERVER['REQUEST_URI']);
		else
			return $_SERVER['REQUEST_URI'];
	}
	
	public function run(){
		$url = self::get_url();
		$todo = self::processa($url);
	}
	
	function processa($url){
		switch(strtolower($url[1])){
			case "javascript":
				self::compress('js');
				break;
			case "css":
				$tipo = "css";
				$content = $url[2];
				include_once "compressor_1.php";
				break;
			case "central":
				$path = PASTA_PAGINAS.'/cfg/'.$url[2];
				if(file_exists($path)){
					header ("content-type: text/xml");
					include_once $path;
				}else{
					
				}
				break;
			case "pagina":
				$path = PASTA_PAGINAS.'/php/'.$url[2].'.php';
				if(file_exists($path)){
					header ("content-type: text/html");
					include_once $path;
				}else{
					
				}
				break;
			case "req":
				$fp = fopen('/debug.txt','w+');
				fwrite($fp,$_POST." -> ".date('h:i:s'));
				fclose($fp);
				
				$path = PASTA_AJAX.'/'.$url[2].'.php';
				if(file_exists($path)){
					include_once $path;
				}else{
					echo "nop: ".$path;
				}
				break;
			case "sair":
				unset($_SESSION);
				session_destroy();
			default:
				if(parent::check_online() == true){
					parent::reload_info();
					include_once "default.php";
				}else{
					include_once "login.php";
				}
		}
	}
	
	function desenhar_icones($max_coluna){
		$icone = self::get_icones();
		$total_de_icones = count($icone);
		$altura = 0;
		$cnt_coluna = 0;
		$esquerda = 0;
		for($i=0;$i<=$total_de_icones-1;$i++){
			
			if($cnt_coluna == $max_coluna){
				$esquerda += 70;
				$cnt_coluna = 0;
				$altura = 0;
			}
			
			echo"<div id=\"icone_".$i."\" class=\"icone\" style=\"left:".$esquerda."px; top:".$altura."px;\">
				<div class=\"icone_imagem\">
					<img src=\"media/icone/".$icone[$i]['img']."\" width=\"40\" height=\"60\" alt=\"".$icone[$i]['titulo']."\" />
				</div>
				<div class=\"icone_texto\">
					<a href=\"pagina/".$icone[$i]['link']."\">".utf8_encode($icone[$i]['titulo'])."</a>
				</div>
			</div>";
			
			
			$altura += 90;
				$cnt_coluna++;
		}
	}
	
	function get_icones(){
		if(parent::getAutParam('id_tipo') == 1 || parent::getAutParam('id_tipo') == 3)
			$query = "SELECT * FROM icone INNER JOIN iconextipo AS crz ON crz.id_icone = icone.idicone WHERE crz.id_tipo = 0 OR crz.id_tipo = ".parent::getAutParam('id_tipo');
		else
			$query = "SELECT * FROM icone INNER JOIN iconextipo AS crz ON crz.id_icone = icone.idicone WHERE crz.id_tipo = 0 OR crz.id_tipo = ".parent::getAutParam('id_tipo')." AND crz.depto = ".parent::getUserParam('Departamento');
		$db = $GLOBALS['db'];
		$db->abre(1);
		$res = $db->query($query, 1);
		$db->fecha(1);
		return $res;
	}
}
