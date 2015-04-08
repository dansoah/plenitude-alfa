<style>
	.header_cmm {
		font-family: 'sans-serif';
		font-size: 14px;
		font-weight: bolder;
		color: #212121;
		display: block;
		border-bottom: 2px solid #CCC;
		cursor: pointer;
		text-indent: 15px;
	}
	.content_cmm {
		clear: both;
		text-indent: 15px;
		text-align: justify;
		padding: 15px;
		padding-top: 5px;
		display: none;
	}
	.footer_cmm {
		float: right;
		color: #CCC;
		font-family: arial;
		font-size: 12px;
		margin-top: 10px;
	}
	.content {
		max-width: 500px;
	}
	.comunicado_li {
		margin-top: 15px;
	}
</style>
<script>
	$(document).ready(function() {
		load_comm();
	});
	function load_comm() {
		$.ajax({
			url : '/req/get_comunicados',
			dataType : 'html',
			success : function(html) {
				$('.asdf').append(html);
				$('.comunicado_li').bind('click', function() {
					$(this).children('.content_cmm').slideToggle();
				});
			}
		});
	}
</script>
<div class="content">
	<ul class="asdf">
		<li class="comunicado_li">
			<span class="header_cmm">dsfasdadasd</span>
			<p class="content_cmm">
				asdasdsadasd
			</p>
			<span class="footer_cmm">sdasdsads</span>
		</li>
	</ul>
</div>