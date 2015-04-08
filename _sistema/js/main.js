/* variaveis */
var ultimo_icone_clicado = null;
var icone_foi_clicado = false;
var largura = 0;
var altura = 0;
var paginas;
var core_windows;
$(function() {
	largura = $(document).width();
	altura = $(document).height();
	altura -= 30;

	$('.icone').draggable({
		start : function() {
			icone = $(this).find('.icone_texto');
			icone.addClass('icone_texto_selecionado');
			ultimo_icone_clicado = this;
		}
	});
	$('.janela').draggable();
	$('.janela').resizable();
	$('#eventos').corner('br 5px');
	$('.btnJanela').corner('');

	/* Montando */
	resizeDesktop(altura, largura);
	load_bg();

	/* Gerando eventos por data */
	setInterval($(function() {
		$.ajax({
			type : 'GET',
			url : '/req/get_countEventos',
			success : function(html) {
				$('#eventos').html(html);
			},
			statusCode : {
				404 : function() {
					alert("Página não encontrada");
				}
			}
		});
		
		$.ajax({
			type : 'GET',
			url : '/req/get_TodosEventos',
			success : function(html) {
				$('#mais_eventos').html(html);				
			},
			statusCode : {
				404 : function() {
					alert("Página não encontrada");
				}
			}
		});
	}), 100000);
	
	/* eventos */
	
	$(window).resize(function() {
		resizeDesktop($(document).height() - 30, $(document).width());
	});
	$('.icone').click(function() {
		$(this).find('.icone_texto').addClass('icone_texto_selecionado');
		if(ultimo_icone_clicado != this) {
			$(ultimo_icone_clicado).find('.icone_texto').removeClass('icone_texto_selecionado');
			ultimo_icone_clicado = this;
		}
		icone_foi_clicado = true;
	});
	$('.icone a').click(function() {
		var pai = $(this).parent('.icone_texto').parent('.icone');
		$(this).parent('.icone_texto').addClass('icone_texto_selecionado');
		if(ultimo_icone_clicado != pai) {
			ultimo_icone_clicado = pai;
			icone_foi_clicado = true;
		}
		return false;
	});
	
	/*********************** EXIBIÇÃO DE EVENTOS***********************/
	$('#eventos').click(function(){
		$('#mais_eventos').fadeToggle();
	});
	/*********************** ABRIR JANELA *****************************/

	$('.icone').dblclick(function() {
		var id = $(this).find('a').attr('href');
		pagina = id.split('/');
		spawnWindow(pagina[pagina.length - 1]);
		return false;
	});
	$('.menulnk').click(function() {
		var id = $(this).find('a').attr('href');
		pagina = id.split('/');
		$('#list_menu').hide();
		spawnWindow(pagina[pagina.length - 1]);
		return false;
	});
	$('#desktop').click(function() {
		if(icone_foi_clicado) {
			icone_foi_clicado = false;
		} else {
			$(ultimo_icone_clicado).find('.icone_texto').removeClass('icone_texto_selecionado');
			ultimo_icone_clicado = null;
		}
	});
});
function spawnWindow(id) {
	var titulo, altura, largura, pagina;
	$.ajax({
		type : 'GET',
		url : 'central/' + id + '.xml',
		dataType : 'xml',
		success : function(xml) {
			//alert('success: ');

			if($(xml).find('pagina').length > 0) {
				titulo = $(xml).find('titulo').text();
				altura = $(xml).find('altura').text();
				largura = $(xml).find('largura').text();
				pagina = $(xml).find('load').text();
				//alert('titulo: '+titulo+' - altura: '+altura+' - largura: '+largura+' - pagina: '+pagina);
				drawWindow(titulo, largura, altura, pagina);
			} else {
				alert('Página indisponível no momento');
			}
		},
		statusCode : {
			404 : function() {
				alert("XML não encontrado: " + id + ".xml");
			}
		}
	});
}

function load_bg() {
	var end;
	$.ajax({
		type : 'GET',
		url : '/req/get_myBackground',
		success : function(html) {
			$('#desktop').css('background-image', 'url(media/bg/' + html + ')');
		},
		statusCode : {
			404 : function() {
				alert("Página não encontrada");
			}
		}
	});

}

function drawDialog(titulo, conteudo) {

}

function resizeDesktop(altura, largura) {
	$('#desktop').css('width', largura);
	$('#desktop').css('height', altura);
}

function drawWindow(titulo, largura, altura, pagina) {
	/*** Montando janela ***/
	$('<div>').attr('class', 'janela').attr('id', titulo).appendTo('#desktop');
	$('#' + titulo).css('display', 'none');
	$('#' + titulo).css('width', largura);
	$('#' + titulo).css('height', altura);

	$('#' + titulo).append('<div class=\'janela_topo\'><\/div>');

	var topo = $('#' + titulo).find('.janela_topo');
	topo.append('<div class=\'janela_titulo\'>' + titulo + '<\/div>');
	topo.append('<div class=\'janela_botoes\'><\/div>');

	$('#' + titulo).append('<div class=\'janela_conteudo\'>a<\/div>');

	var divBotao = $('#' + titulo).find('.janela_botoes');

	divBotao.append('<button type=\"button\" class=\'btnJanela btnJanelaMinimizar\'>-<\/button>');
	divBotao.append('<button type=\"button\" class=\'btnJanela btnJanelaMaximizar\'>^<\/button>');
	divBotao.append('<button type=\"button\" class=\'btnJanela btnJanelaFechar\'>*<\/button>');
	divConteudo = $('#' + titulo).find('.janela_conteudo');
	divConteudo.css('height', altura - 18);
	/************ COLOCANDO CONTEUDO ***********/
	divConteudo.load('pagina/' + pagina);
	/*********** MONTANDO EVENTOS *************/

	$('#' + titulo).bind({
		mouseenter : function() {
			$(this).css('opacity', '1');
			$(this).css('z-index', 5);
		},
		mouseleave : function() {
			$(this).css('opacity', '0.7');
			$(this).css('z-index', 4);
		}
	});

	$('.janela_conteudo').bind({
		mouseenter : function() {
			$(this).parent('.janela').draggable('disable');
		},
		mouseleave : function() {
			$(this).parent('.janela').draggable('enable');
		}
	});

	$('.btnJanela').bind({
		mouseenter : function() {
			$(this).addClass('btnJanelaHover');
		},
		mouseleave : function() {
			$(this).removeClass('btnJanelaHover');
		}
	});

	$('.btnJanelaFechar').bind('click', function() {
		var janela = $(this).parent('.janela_botoes').parent('.janela_topo').parent('.janela');
		janela.remove();
		
	});
	$('.btnJanelaMaximizar').bind('click', function() {

		var janela = $(this).parent('.janela_botoes').parent('.janela_topo').parent('.janela');
		$(janela).css('width',  $(document).width() - 17);
		$(janela).css('max-width',  $(document).width() - 17);
		$(janela).css('height',  $(document).height() - 46);
		$(janela).css('max-height',  $(document).height() - 46);

		var conteudo = $(janela).find('.janela_conteudo');
		$(conteudo).css('width',  $(document).width() - 17);
		$(conteudo).css('max-width',  $(document).width() - 17);
		$(conteudo).css('height',  $(document).height() - 56);
		$(conteudo).css('max-height',  $(document).height() - 56);

		$(janela).attr('max', 'true');
		//alert('maximizar 1');
		$(janela).uncorner();
		$(janela).draggable('destroy');
		//alert('maximizar 2');
	});
	$('.btnJanelaMinimizar').bind('click', function() {

		var janela = $(this).parent('.janela_botoes').parent('.janela_topo').parent('.janela');
		$(janela).fadeOut('slow', function() {
			var nomeJanela = $(janela).attr('id');
			$('<li id=\'' + nomeJanela + '_mini\' class=\'janela_minimizada janela_minimizada_normal\'>' + nomeJanela + '<\/li>').appendTo('#container_janelas').corner('top').fadeIn('fast');
			$('#' + nomeJanela + '_mini').bind({
				mouseenter : function() {
					$(this).removeClass('janela_minimizada_normal');
					$(this).addClass('janela_minimizada_hover');
				},
				mouseleave : function() {
					$(this).removeClass('janela_minimizada_hover');
					$(this).addClass('janela_minimizada_normal');
				},
				click : function() {
					$('#' + nomeJanela + '_mini').fadeOut('fast', function() {
					$('#' + nomeJanela).fadeIn('fast');
					}).remove();

				}
			});
		});
	});
	/******* EFEITOS *******************/
	$('#' + titulo).draggable();
	/*Permite arrastar*/
	$('#' + titulo).corner('top');
	/*borda arredondada*/

	/******* EXIBINDO ***************/
	$('#' + titulo).fadeIn('fast');
}

function dump(obj) {
	var out = '';
	for(var i in obj) {
		out += i + ": " + obj[i] + "\n";
	}

	alert(out);
}