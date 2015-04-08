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

?>
<style>
	#declarar {
		padding:10px;
		border-bottom:1px solid #CCC;
	}
	.header_recentes_saidas{
		padding:5px;
		display:block;
		font-size:16px;
		font-weight:bold;
		color:#909090;
		font-family:arial;
	}
	
	#declarar{
		font-family:arial;
		color:#212121;
		
	}
	#declarar .input{
		padding:4px;
		margin-top:10px;
		border:1px solid #CCC;
		width:100%;
	}
	
	#divdeclarar{
		width:200px;
		margin-left:30px;
	}
	
	.rotulo{
		color:#999;
		font-family:arial;
		font-weight:bold;
	}
</style>
<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<form id="declarar">
<span class="header_recentes_saidas">Declarar:</span>
	<div id="divdeclarar">		
		<input type="radio" name="tipo" value="0">
		<span class="rotulo">DEVOLUÇÃO</span>
		<input type="radio" name="tipo" value="1">
		<span class="rotulo">SAÍDA</span>
		<br />
		<input class="input" type="text" name="rg" placeholder="Rg do aluno" />
		<br />
		<input class="input" type="text" name="livro" placeholder="ISBN do livro" />
		<br />
	</div>
<div class="btnBox">
		<button class="btnFalha" type="reset">Limpar</button> <button id="btnSalvarNoticia" class="btnSucesso" type="submit">Salvar</button>
	</div>
</form>

<div id="recentes">
	<span class="header_recentes_saidas">Devoluções para hoje</span>
	
</div>
