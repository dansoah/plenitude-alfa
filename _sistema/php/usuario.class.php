<?php
class usuario{

	public static $aut_info;
	public static $user_info;
	public static $tipo_info;
	
	public function check_online(){
		$usuario = @$_SESSION['usuario'];
		$senha = @$_SESSION['senha'];
		
		if(!is_null($usuario) && !is_null($senha)){
			if(self::check_session()){
				return true;
			}else{
				return false; //login non bate!
			}
		}else{
			return false; //usuario e senha não estão em session
		}
	}
	
	public function check_session(){
		$usuario = @$_SESSION['usuario'];
		$senha = @$_SESSION['senha'];
		return $this->logar($usuario,$senha);
	}
	
	public function getAutParam($param){
		self::check_session();
		self::reload_info();
		return($this->aut_info[$param]);
	}
	
	public function getUserParam($param){
		self::check_session();
		return($this->user_info[$param]);
	}
	public function logar($usuario,$senha){
		
		$query = "SELECT * FROM autenticar AS aut
		INNER JOIN tipo_usuario AS tipo ON aut.tipo = tipo.id_tipo
		WHERE (aut.usuario = '".$usuario."' AND aut.senha = '".$senha."') AND aut.status <> 'b' ";
		$db = $GLOBALS['db'];
		$db->abre(1);
			$res = $db->query($query,1);
		$db->fecha(1);
		if(count($res)==1 && $res != ''){
			$this->aut_info = $res[0];
			$_SESSION['usuario'] = $usuario;
			$_SESSION['senha'] = $senha;
			return true;
		}else{
			return false;
		}
	}
	public function reload_info(){//requer session setada
	self::check_session();
		$query = "SELECT * FROM ".$this->aut_info['tabela']." WHERE id_".$this->aut_info['tabela']." = ".$this->aut_info['referencia'];
		$db = $GLOBALS['db'];
		$db->abre(1);
			$res = $db->query($query,1);
		$db->fecha(1);
		$this->user_info = $res[0];
	}
	
	public function create_pwd($chars,$hash = false,$return_hash_not_hash = false){
		$str = "";
		for($i=0;$i<=$chars;$i++){
			$str .= chr(rand(33,126));
		}
		$str = utf8_encode($str);
		if($hash != false)
			$str_hash = hash($hash,$str);
		
		if($return_hash_not_hash){
			$endless[1] = $str;
			$endless[0] = $str_hash;
		}else{
			$endless = $str;
		}
		
		return $endless;
	}
}
