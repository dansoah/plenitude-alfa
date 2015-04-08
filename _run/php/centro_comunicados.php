<link href="/layout/css/btnbox.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="/_sistema/js/ajaxupload.3.5.js" ></script>
<script type="text/javascript" src="/_sistema/js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '/_sistema/js/tinymce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});

</script>
<!-- /TinyMCE -->

<script>
$(function(){
	$('#btnSalvarNoticia').click(function(){
		alert('click');
		$.post('/req/put_comunicado',{
			titulo: $('input[name=titulo]').val(),
			conteudo: $('#campo_noticia').val()
		},function(data){
			alert(data);
			$('#nova').fadeOut('slow',function(){
				$('#salvar').fadeIn('slow',function(){
					if(data==='sucesso'){
						
						$('#salvoSucesso').fadeIn();
					}else{
						$('#salvoFalha').fadeIn();
					}
				});
			});
		});
	});
});
	
</script>
<style>
	.sucesso{
		background-color:#f7ffe2;
		border:1px solid #b7cf77;
		color:#86a13f;
	}
	.falha{
		background-color:#ff9caa;
		border:1px solid #ba717b;
		color:#d74257;
	}
	.normal{
		border: 1px dashed #ccc;
		color: #e7e7e7;
		background-color: #FFF;
	}
	#titulo {
		margin-top: 20px;
		padding: 15px;
		width: 80%;
		font-family: Helvetica;
		color: #212121;
		font-weight: bolder;
		margin-left:auto;
	margin-right:auto;
		border:1px solid #CCC;
	}
	#noticia {
		margin-top: 20px;
	}


</style>
<div id="nova">

	<input type="hidden" name="img" />
	<input type="text" name="titulo" id="titulo" placeholder="titulo"/>
	<div id="noticia">
		<textarea id="campo_noticia" name="elm1" rows="15" cols="80" style="width: 100%" class="tinymce">

		</textarea>
	</div>
	<div class="btnBox">
		<button class="btnFalha" type="reset">Limpar</button> <button id="btnSalvarNoticia" class="btnSucesso" type="submit">Salvar</button>
	</div>
</div>
<div id="salvar">
	<div id="salvoSucesso" style="display:none;">
		Salvo com sucesso!<br />
		Esta janela não tem mais utilidade, então se quiser fechá-la, fique à vontade :)
	</div>
	<div id="salvoFalha" style="display:none;">
		Não foi salvo!<br />
		Esta janela não tem mais utilidade, então se quiser fechá-la, fique à vontade :)
	</div>
</div>
