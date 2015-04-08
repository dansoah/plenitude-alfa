<?php
include_once 'var.php';
include_once '_sistema/php/plenitude.class.php';

$plenitude = new plenitude();
$usu = $GLOBALS['usu'];
$usu->reload_info();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />

		<title>Colégio Crystal</title>

		<link href="layout/css/principal.css" rel="stylesheet"/>
		<link href="layout/css/context-menu.css" rel="stylesheet"/>
		
		<script src="_sistema/js/jquery.js" type="text/javascript"></script>
		<script src="_sistema/js/jquery-ui.js" type="text/javascript"></script>
		<script src="_sistema/js/jquery-corner.js" type="text/javascript"></script>
		<script src="_sistema/js/jquery-ui-position.js" type="text/javascript"></script>
    	<script src="_sistema/js/jquery-contextmenu.js" type="text/javascript"></script>
		<script src="_sistema/js/jmasqked_input.js" type="text/javascript"></script>
		<script type="text/javascript" src="/_sistema/js/ajaxupload.3.5.js" ></script>
		
		<script src="_sistema/js/simple_functions.js"></script>
		<script src="_sistema/js/main.js"></script>
		<script src="_sistema/js/function.js"></script>
		<script src="_sistema/js/contextMenus.js"></script>
		<script src="_sistema/js/menus.js"></script>
		
		
	</head>
	<body onload="UR_Start()">
		<div id="top">
			<div id="menu_plenitude">
				<div id="click_menu">
					<img src="media/icone/menu.jpg" />
				</div>
				<div id="list_menu" style="display:none; position:absolute;">
					<ul>
						<li class="menulnk"><a href="pagina/conta">Conta</a></li>
						<li class="" class="gimme_separator"><a href="/sair">Sair</a></li>
					</ul>
				</div>
			</div>
			<div id="nome_colegio">
				<?php echo $usu->user_info['Nome']." ".$usu->user_info['Sobrenome']; ?>
			</div>
			<div id="ur"> </div>
			<?php
			if($usu->aut_info['tipo'] == 1 || ($usu->aut_info['tipo'] == 2 && ($usu->user_info['Departamento'] == 1 || $usu->user_info['Departamento'] == 2))){				
			?>
			<div id="eventos"></div>
			<div id="mais_eventos"></div>
			<?php
			}
			?>
		</div>

		<div id="desktop">
			
			<?php
				$plenitude->desenhar_icones(5);
			?>

		</div>
		<div id="rodape">
			<ul id="container_janelas">

			</ul>
		</div>
	</body>
</html>