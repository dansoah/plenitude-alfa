<?php
class database {
	public static $bancos;
	function novoDB($host, $user, $senha, $banco, $id) {
		$this -> bancos[$id]['host'] = $host;
		$this -> bancos[$id]['user'] = $user;
		$this -> bancos[$id]['senha'] = $senha;
		$this -> bancos[$id]['banco'] = $banco;
	}

	private function existeDB($id) {
		if(array_key_exists($id, $this -> bancos))
			return true;
		else
			return false;
	}

	function abre($id) {
		if(self::existeDB($id)) {
			$identificador = mysql_connect($this -> bancos[$id]['host'], $this -> bancos[$id]['user'], $this -> bancos[$id]['senha']) or die(mysql_error());
			$this -> bancos[$id]['identificador'] = $identificador;
			if($identificador) {
				$select = mysql_select_db($this -> bancos[$id]['banco'], $identificador) or die(mysql_error());
				if($select)
					return true;
				else
					echo mysql_error();
			} else {
				echo mysql_error();
				return false;
			}
		}
	}

	function query($query, $banco) {
		if(!self::existeDB($banco)) {
			echo "banco de dados \"" . $banco . "\"inexistente!";
			exit ;
		}
		$exp = explode(" ", $query);
		switch(strtolower($exp[0])) {
			case"select" :
				$sql = mysql_query($query) or die($query . "says: " . mysql_error());
				$total = mysql_num_rows($sql);
				//Pegando nomes de colunas
				$cols = self::getColunas($query, $banco);
				//montando array
				$row = "";
				for($i = 0; $i <= $total - 1; $i++) {//se der pau, aqui era $total-2
					mysql_data_seek($sql, $i);
					$res = mysql_fetch_assoc($sql);
					for($j = 0; $j <= count($cols) - 1; $j++) {
						$row[$i][$cols[$j]] = $res[$cols[$j]];
					}
				}
				return ($row);
				break;

			default :
				if(mysql_query($query, $this -> bancos[$banco]['identificador']))
					return true;
				else
					return false;
				break;
		}
	}

	function queryLinhas($query, $banco) {
		$qry = mysql_query($query, $this -> bancos[$banco]['identificador']);
		$total = mysql_num_rows($qry);
		return $total;
	}

	private function getColunas($query, $banco) {
		$sql = mysql_query($query, $this -> bancos[$banco]['identificador']);
		$cols = "";
		$i = 0;
		$qtd_campos = mysql_num_fields($sql);
		for($i = 0; $i <= $qtd_campos - 1; $i++) {
			$obj = mysql_fetch_field($sql, $i);
			$cols[$i] = $obj -> name;
		}
		return ($cols);
	}

	function fecha($id) {
		if(self::existeDB($id)) {
			mysql_close($this -> bancos[$id]['identificador']);
		}
	}

}
