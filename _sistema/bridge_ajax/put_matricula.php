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

//var_dump($_POST);



$db->abre(1);

	/*
	 * INSERINDO ALUNO
	 */
	
	//Insert principal (tabela de alunos)
	$insert_aluno = "INSERT INTO `plenitude_alfa`.`aluno`
	(
	`Nome`,
	`Sobrenome`,
	`Data_Nasc`,
	`RG`,
	`CPF`,
	`Endereco`,
	`CEP`,
	`Bairro`,
	`Cidade`,
	`Estado`,
	`Pais`,
	`Telefone_1`,
	`Telefone_2`,
	`Email`,
	`Observacoes`)
	VALUES
	(
	'".mysql_real_escape_string($_POST['aluno_nome'])."',
	'".mysql_real_escape_string($_POST['aluno_sobrenome'])."',
	'".mysql_real_escape_string($_POST['aluno_dataNasc'])."',
	'".mysql_real_escape_string($_POST['aluno_rg'])."',
	'".mysql_real_escape_string($_POST['aluno_cpf'])."',
	'".mysql_real_escape_string($_POST['aluno_endereco'])."',
	'".mysql_real_escape_string($_POST['aluno_cep'])."',
	'".mysql_real_escape_string($_POST['aluno_bairro'])."',
	'".mysql_real_escape_string($_POST['aluno_cidade'])."',
	'".mysql_real_escape_string($_POST['aluno_estado'])."',
	'".mysql_real_escape_string($_POST['aluno_pais'])."',
	'".mysql_real_escape_string($_POST['aluno_tel_1'])."',
	'".mysql_real_escape_string($_POST['aluno_tel_2'])."',
	'".mysql_real_escape_string($_POST['aluno_email'])."',
	'".mysql_real_escape_string($_POST['aluno_obs'])."'
	);
	";
	
	$db->query($insert_aluno, 1);
	
	//echo $insert_aluno;
	
	$last_id = mysql_insert_id();
	//gerando senha
	$pwd_aluno = $usu->create_pwd(rand(10,15),'sha512',true);
	
	//insert secundário (autenticação)
	$insert_aut = "INSERT INTO autenticar (`usuario`,`senha`,`tipo`,`referencia`,`status`) VALUES ('".mysql_real_escape_string($_POST['aluno_email'])."','".$pwd_aluno[0]."',1,'".$last_id."','A')";
	
	$db->query($insert_aut,1);
	
	/*
	 * INSERINDO RESPONSÁVEL
	 */
	//Insert principal (tabela de responsavels)
	$insert_responsavel = "INSERT INTO `plenitude_alfa`.`responsavel`
	(
	`Nome`,
	`Sobrenome`,
	`Data_Nasc`,
	`RG`,
	`CPF`,
	`Endereco`,
	`CEP`,
	`Bairro`,
	`Cidade`,
	`Estado`,
	`Pais`,
	`Telefone_1`,
	`Telefone_2`,
	`Email`,
	`Observacoes`)
	VALUES
	(
	'".mysql_real_escape_string($_POST['responsavel_nome'])."',
	'".mysql_real_escape_string($_POST['responsavel_sobrenome'])."',
	'".mysql_real_escape_string($_POST['responsavel_dataNasc'])."',
	'".mysql_real_escape_string($_POST['responsavel_rg'])."',
	'".mysql_real_escape_string($_POST['responsavel_cpf'])."',
	'".mysql_real_escape_string($_POST['responsavel_endereco'])."',
	'".mysql_real_escape_string($_POST['responsavel_cep'])."',
	'".mysql_real_escape_string($_POST['responsavel_bairro'])."',
	'".mysql_real_escape_string($_POST['responsavel_cidade'])."',
	'".mysql_real_escape_string($_POST['responsavel_estado'])."',
	'".mysql_real_escape_string($_POST['responsavel_pais'])."',
	'".mysql_real_escape_string($_POST['responsavel_tel_1'])."',
	'".mysql_real_escape_string($_POST['responsavel_tel_2'])."',
	'".mysql_real_escape_string($_POST['responsavel_email'])."',
	'".mysql_real_escape_string($_POST['responsavel_obs'])."'
	);
	";
	
	$db->query($insert_responsavel, 1);
	
	//echo $insert_responsavel;
	
	$last_id = mysql_insert_id();
	//gerando senha
	$pwd_responsavel = $usu->create_pwd(rand(10,15),'sha512',true);
	
	//insert secundário (autenticação)
	$insert_aut = "INSERT INTO autenticar (`usuario`,`senha`,`tipo`,`referencia`,`status`) VALUES ('".mysql_real_escape_string($_POST['responsavel_email'])."','".$pwd_responsavel[0]."',3,'".$last_id."','A')";
	
	$db->query($insert_aut,1);
$db->fecha(1);
?>
<style>
	h1{
		margin-top:20px;
		font-family:verdana;
		font-size:30px;
		text-align:center;
		color:#CCC;
	}
	#result{
		color:#2c2c2c;
		font-size:14px;
	}
	.cooldiv{
		border:1px solid #E6E6E6;
		width:90%;
		height:130px;
		margin-left:auto;
		margin-right:auto;
		margin-top:20px;
		padding:10px;
	}
</style>
<div id="result">
	<h1>Pronto!</h1>
	<div id="aluno" class="cooldiv">
		O(a) aluno(a) <b><?php echo $_POST['aluno_nome']; ?></b> foi cadastrado com sucesso.<br />Nome de usuário para login: <b><?php echo $_POST['aluno_email'];?></b><br />Senha para login: <b><?php echo $pwd_aluno[1];?></b><br />
	</div>
	<div id="responsavel" class="cooldiv">
		O(a) Responsável <b><?php echo $_POST['aluno_nome']; ?></b> foi cadastrado com sucesso.<br />Nome de usuário para login: <b><?php echo $_POST['responsavel_email'];?></b><br />Senha para login: <b><?php echo $pwd_responsavel[1];?></b><br />
	</div>
</div>
