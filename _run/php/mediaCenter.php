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
	exit ;
?>
<script type="text/javascript" >
	$(function() {
		var btnUpload = $('#upload');
		var status = $('#status');
		new AjaxUpload(btnUpload, {
			// Arquivo que fará o upload
			action : '/req/put_uploadMediaCenter',
			//Nome da caixa de entrada do arquivo
			name : 'uploadfile',
			onSubmit : function(file, ext) {
				if(!(ext && /^(jpg|png|jpeg|pdf|doc|docx|ppt|pptx|xls|xlsx|rar)$/.test(ext))) {
					// verificar a extensão de arquivo válido
					status.text('Somente arquivos JPG, PNG, PDF, DOC, PPT, XLS, GIF ou rar são permitidos');
					return false;
				}
				status.text('Enviando...');
			},
			onComplete : function(file, response) {
				//Limpamos o status
				status.text('');
				//Adicionar arquivo carregado na lista
				if(response === "success") {
					$('<li></li>').appendTo('#files').html(file).addClass('success');
					load_arquivos();
				} else {
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		load_arquivos();
	});
	function load_arquivos() {
		$.ajax({
			type : 'GET',
			url : 'req/get_ArquivosFromDBMC',
			success : function(val) {
				$('#lista_download').html(val);
			}
		});
	}
</script>
<style>
#upload {
padding: 5px;
background: #f2f2f2;
border: 1px solid #ccc;
cursor: pointer !important;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
}
.darkbg {
background: #ddd !important;
}
#status {
font-family: Arial;
padding: 5px;
}
ul#files {
list-style: none;
padding: 0;
margin: 0;
}
ul#files li {
padding: 10px;
margin-bottom: 2px;
margin-right: 10px;
color:#FFF;
font-weight:bold;
text-shadow:1px 1px 1px #339933;
font-family:verdana;
}
ul#files li img {
max-width: 180px;
max-height: 150px;
}
.success {
background: #99f099;
border: 1px solid #339933;
}
.error {
background: #f0c6c3;
border: 1px solid #cc6622;
}
#main_upload{
width:48%;
border:1px solid #CCC;
padding:5px;
}
#main_download{
padding:5px;
width:48%;
border:1px solid #CCC;
float:right;
}

.header{
font-weight: bold;
font-size: 1.3em;
font-family: Arial, Helvetica, sans-serif;
text-align: center;
color: #3366cc;
}

.nomeArquivo, .nomeArquivo a{
	font-family: Verdana;
	font-size: 14px;
	color:#282828;
	text-decoration:none;
	font-weight: bold;
}

.donoArquivo{
	font-family:arial;
	color:#C0C0C0;
	font-size:12px;
}

.dataArquivo{
	font-family:arial;
	color:#C0C0C0;
	font-size:12px;
	
}

.arquivoListado{
	margin-top:10px;
	padding:3px;
}
.arquivoListado span{
	margin-top:4px;
}
</style>
<div id="main_download">
	<h2 class="header">Download</h2>
	<ul id="lista_download">
		
	</ul>
</div>
<div id="main_upload">
	<div id="upload" class="header">
		<span id="load" >Carregar arquivos</span>
	</div>
	<span id="status" > </span>
	<ul id="files" ></ul>
</div>
