$(function(){
    $.contextMenu({
        selector: '#desktop', 
        callback: function(key, options) {
            switch(key){
            	case 'plano':
            	break;
            }
        },
        items: {        	
            "plano": {name: "Alterar plano de fundo", icon: "rr",className:'teste'},          
        }
    });
});

$(function() {
		var btnUpload = $('.teste');
		var status = $('#status');
		new AjaxUpload(btnUpload, {
			// Arquivo que fará o upload
			action : '/req/put_uploadNewBG',
			//Nome da caixa de entrada do arquivo
			name : 'uploadfile',
			onSubmit : function(file, ext) {
				if(!(ext && /^(jpg|jpeg)$/.test(ext))) {
					// verificar a extensão de arquivo válido
					alert('Somente arquivos JPG são permitidos');
					return false;
				}
				status.text('Enviando...');
			},
			onComplete : function(file, response) {
				alert(response);
				//Limpamos o status
				status.text('');
				//Adicionar arquivo carregado na lista
				if(response === "success") {
					load_bg();
				} else {
					alert('Não foi possível alterar seu plano de fundo!'+response)
				}
			}
		});
	});
	