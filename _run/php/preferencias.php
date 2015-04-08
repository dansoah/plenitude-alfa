<script type="text/javascript" src="/_sistema/js/ajaxupload.3.5.js" ></script>
<script>
	$(function() {
		var btnUpload = $('#upload');
		var status = $('#status');
		new AjaxUpload(btnUpload, {

			// Arquivo que fará o upload
			action : '/req/put_uploadImgBG',
			//Nome da caixa de entrada do arquivo
			name : 'uploadfile',
			onSubmit : function(file, ext) {
				if(!(ext && /^(jpg|png|jpeg)$/.test(ext))) {
					// verificar a extensão de arquivo válido
					status.text('Somente JPG OU PNG é permitido');
					return false;
				}
				status.text('Enviando...');
			},
			onComplete : function(file, response) {
				//Limpamos o status
				
				//Adicionar arquivo carregado na lista
				if(response !== "fail") {
					var link = '/media/bg/'+response;
					$('#upload').removeClass('normal');
					$('#upload').removeClass('fail');
					$('#upload').addClass('sucesso');
					$('#upload').html('<img src="'+link+'"/>');
					$('#upload').find('img').attr('src',link);
					$('#upload').find('img').fadeIn('fast');
					$('input[name=img]').val(response);
					status.text('Enviado com sucesso');	
					load_bg();	
				} else {
					$('#upload').removeClass('normal');
					$('#upload').removeClass('sucesso');
					$('#upload').addClass('fail');
					$('#upload').html('Falhou!');
					status.text('Falha ao enviar seu arquivo');
				}
			}
		});
	});

</script>

<div id="upload">
	Novo plano de fundo
</div>
