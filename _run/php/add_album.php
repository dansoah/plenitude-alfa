<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<script type="text/javascript" >
	$(function() {
		var btnUpload = $('#upload');
		var status = $('#status');
		new AjaxUpload(btnUpload, {
			// Arquivo que fará o upload
			action : '/req/put_AlbumGaleria',
			//Nome da caixa de entrada do arquivo
			name : 'uploadfile',
			onSubmit : function(file, ext) {
				if(!(ext && /^(zip)$/.test(ext))) {
					// verificar a extensão de arquivo válido
					status.text('Somente arquivos zip são permitidos');
					return false;
				}
				status.text('Enviando...');
			},
			onComplete : function(file, response) {
				//Limpamos o status
				status.text('');
				//Adicionar arquivo carregado na lista
				if(response !== "error") {
					alert(response);
					$('#parte_1').fadeOut('fast', function() {
						$('#parte_2').html(response, function() {
							$(this).fadeIn('fast');
						})
					});
				} else {
					status.text('Erro ao fazer upload');
				}
			}
		});
	});

</script>
<style>
	#upload {
		padding: 5px;
		background: #f2f2f2;
		border: 1px solid #ccc;
		cursor: pointer   !important;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		width: 150px;
		font-size: 18px;
		color: #FF9CAA;
		text-align: center;
		font-family: arial;
	}	#controles {
		height: 55px;
		border-bottom: 3px solid #CCC;
		clear: both;
	}
	#menu_lateral {
		float: left;
		width: 150px;
		border-right: 3px solid #CCC;
		height: 100%
	}
	#menu_lateral ul {
	}
	#menu_lateral ul li {
		display: block;
		font-size: 12px;
		font-family: arial;
		color: #484848;
		line-height: 18px;
	}
	#menu_lateral ul li a {
		color: #484848;
		padding-left: 10px;
		display: block;
		text-decoration: none;
	}
	#menu_lateral ul li a:hover {
		background-color: #3397d1;
		color: #FFF;
	}
	#conteudo {
		padding: 10px;
		margin-left: 150px;
	}
	#barra_de_baixo {
		position: fixed;
		bottom: 0px;
		background-color: #CCC;
		display: block;
		width: 100%;
		padding: 2px;
	}
	#barra_de_baixo button {
		float: right;
		margin-right: 10px;
	}
	figure:first-of-type {
		width: 150px;
		float: left;
	}
	figure {
		width: 150px;
		float: left;
		margin-left: 15px;
	}
	figure input {
		float: right;
		position: absolute;
		margin-left: -15px;
	}
</style>
<script>
	$(function load_lateral(){
		$.ajax({
			url : '/req/get_albuns',
			dataType : 'html',
			success : function(html) {
				$('#menu_lateral').html(html);
			}
		});
	});
	
	function get_pics_album(album){
		$.post('/req/getpics',{id:album},function(res){
			$('#album_show').html(res);
		});
	}
	
	$('#menu_lateral a').click(function(){
		get_pics_album($(this).attr('href'));
		return false;
	});
</script>
<div id="controles">
	<img src="/layout/img/novo.jpg" />
	<img src="/layout/img/gerenciar.jpg" />
</div>
<div id="menu_lateral">
	<ul>
		<li>
			<a href="album_22">asd</a>
		</li>
		<li>
			<a href="album_22">asd</a>
		</li>
		<li>
			<a href="album_22">asd</a>
		</li>
		<li>
			<a href="album_22">asd</a>
		</li>
	</ul>
</div>
<div id="conteudo">
	<div id="container_novo_album">
		<div id="parte_1">
			<input type="text" name="titulo" placeholder="Titulo do álbum" />
			<input type="text" name="data" placeholder="Data" />
			<br />
			<div id="upload">
				<span id="load" >Carregar arquivos</span>
			</div>
		</div>
		
		<div id="parte_2">
			
		</div>
		
		<div id="status"></div>
	</div>
	<div id="album_show"></div>
</div>
