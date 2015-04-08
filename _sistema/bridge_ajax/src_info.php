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

$oque = $_POST['oque'];
$onde = $_POST['onde'];

if($oque == "")
	exit;
$oque = str_replace(" ","%",$oque);
$db->abre(1);
switch($onde){
	case 1:
		$table = "responsavel";
		$query = "SELECT * FROM responsavel WHERE Nome LIKE '%".mysql_real_escape_string($oque)."%' OR Sobrenome LIKE '%".mysql_real_escape_string($oque)."%'";
		break;
	case 2:
		$table = "funcionario";
		$query = "SELECT * FROM funcionario WHERE Nome LIKE '%".mysql_real_escape_string($oque)."%' OR Sobrenome LIKE '%".mysql_real_escape_string($oque)."%'";
		break;
	default:
		$table = "aluno";
		$query = "SELECT * FROM aluno WHERE Nome LIKE '%".mysql_real_escape_string($oque)."%' OR Sobrenome LIKE '%".mysql_real_escape_string($oque)."%'";
		
		
}

$res = $db->query($query,1);
$db->fecha(1);
if(count($res) >= 1){
	for($i=0;$i<=count($res)-1;$i++){
		if(!is_array($res))
		break;
		if(!array_key_exists($i, $res))
		break;
	?>
	
	<div class = "srcRES">
		<div class="nome">
			<?php echo $res[$i]['Nome']." ".$res[$i]['Sobrenome']; ?>
		</div>
		<div class="info">
			Código: <?php echo $res[$i]['id_'.$table.'']; ?><br />
			Data de nascimento: <?php echo $res[$i]['Data_Nasc']; ?><br />
			RG: <?php echo $res[$i]['RG']; ?><br />
			CPF: <?php echo $res[$i]['CPF']; ?><br />
			Endereço: <?php echo $res[$i]['Endereco']; ?> <?php echo $res[$i]['Bairro']; ?> - <?php echo $res[$i]['Cidade']; ?> - <?php echo $res[$i]['CEP']; ?> - <?php echo $res[$i]['Estado']; ?> <?php echo $res[$i]['Pais']; ?>
			Telefone linha 1: <?php echo $res[$i]['Telefone_1']; ?><br />
			Telefone linha 2: <?php echo $res[$i]['Telefone_2']; ?><br />
		</div>
	</div>
	<?php
	}
}