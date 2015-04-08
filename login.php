<?php
if(@$_POST['usuario'] != NULL && @ $_POST['senha']!=NULL){
	include_once 'var.php';
	$usu = $GLOBALS['usu'];
	if($usu->logar($_POST['usuario'],$_POST['senha']))
		header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Fazer login</title>
	</head>
	<body>
	<style>
		body {
			background-color: #CCC;
			background-image: url('/layout/img/bg_login.jpg');
		}
		.logo {
			position: absolute;
			right: 20px;
			bottom: 10px;
			font-size: 50px;
			font-family: verdana;
			font-weight: bolder;
			color: #2d2d2d;
			text-shadow: 1px 1px 1px #000;
		}
		.login_header {
			font-size: 25px;
			font-family: verdana;
			font-weight: bolder;
			color: #2d2d2d;
			text-shadow: 1px 1px 1px #000;
			text-align: center;
		}
		input {
			border: 1px solid #000000;
			padding: 5px;
			font-family: arial;
			width:300px;
			max-width:300px;
		}
		.segundo_input {
			margin-top: 5px;
		}
		button {
			padding: 3px;
			font-family: verdana;
			border: 1px solid #000;
			font-weight: bolder;
			color: #FFF;
			text-shadow: 1px 1px 1px #000;
			background-color: #2d2d2d;
			margin-top: 3px;
			float:right;
			margin-right:-3px;
		}		.loginFRM{
			margin-left:auto;
			margin-right:auto;
			width:300px;
		}
	</style>
	<div class="logo">
		Plenitude
	</div>
	<form action="/entrar" method="POST" class="loginFRM">
		<h1 class="login_header">Login</h1>
		<input type="text" name="usuario" placeholder="Nome de usuário"/>
		<br />
		<input type="password" name="senha" class="segundo_input" placeholder="Senha de acesso"/>
		<br />
		<button type="submit">
			entrar
		</button>
	</form>
</body>
</html>