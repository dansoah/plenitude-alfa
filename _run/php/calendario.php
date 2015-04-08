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
<script src="jQuery.js"></script>
<script>
	$(document).ready(function() {
		$('select[name=mes]').change(function() {
			reload_calendario();
		});
		$('input[name=ano]').blur(function() {
			reload_calendario();
		});
		
		$('.evento').bind('mouseenter',function(){
			$(this).child('.big').fadeIn('fast');
		});
		$('.evento').mouseleave(function(){
			$(this).child('.big').fadeOut('fast');
		});
	});

	function reload_calendario() {
		$.post('/req/get_calendario', {
			mes : $('select[name=mes]').val(),
			ano : $('input[name=ano]').val()
		}, function(data) {
			$('#conteudo').html(data);
		});
	}
</script>
<style>
	.calendario_td{
		width: 70px;
		height: 100px;
	}
	.campo {
		padding: 5px;
		border: 1px solid #CCC;
		width: 450px;
		margin-top: 10px;
		text-align:center;
	}
	.field {
		border: 0;
	}

	.campo select, .campo input {
		width: 100px;
	}
	
	#conteudo{
		margin-top:15px;
		width:450px;
	}
	
	.dia{
		border:1px solid #C2C2C2;
		width:100%;
		height:100%;
		font-size:28px;
		color:#CCC;
		font-family:"Courier New";
		z-index:0;
	}
	.vazio{
		background-color:#CCC;
		width:100%;
		height:100%;
	}
	
	.diasemana{
		height:30px;
		text-align:center;
		font-family: "Verdana";
		font-size:14px;
		vertical-align:middle;
		color:#616161;
		border:1px solid #C2C2C2;
	}
	.etc{
		width:65px;
		height:74px;
		margin-top:-72px;
		z-index:1;
		padding:2px;
	}
	.atual{
		border:1px solid #3399FF;
	}
	.big{
		border:1px solid #000;
		height:200px;
		width:400px;
		display:none;
	}
</style>
<div id="calendario">
	<div class="controles">
		<div id="mes" class="campo">
			<select class="field" name="mes">
				<option value="1">Janeiro</option>
				<option value="2">Fevereiro</option>
				<option value="3">Março</option>
				<option value="4">Abril</option>
				<option value="5">Maio</option>
				<option value="6">Junho</option>
				<option value="7">Julho</option>
				<option value="8">Agosto</option>
				<option value="9">Setembro</option>
				<option value="10">Outubro</option>
				<option value="11">Novembro</option>
				<option value="12">Dezembro</option>
			</select> / <input type="text" name="ano" maxlength="4" class="field" placeholder="ano" value="<?php echo date("Y"); ?>"/>
		</div>
	</div>

	<div id="conteudo"></div>
</div>
