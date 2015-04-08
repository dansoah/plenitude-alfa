<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	header('location:/');
	exit ;
}
include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu -> check_online())
	exit ;
?>
<script>
	var cntClickNext = 0;

	var last = "#cadastro_aluno";
	var novo = "";

	var cmd = Array('#cadastro_aluno', '#cadastro_responsavel', '#cadastro_curso');

	$(document).ready(function() {
		$(".rg").mask("99.999.999-**");
		$(".cpf").mask("999.999.999-99");
		$(".cep").mask("99999-999");
		$(".data").mask("99/99/9999");
		$(".telefone").mask("(99) 999999999");
		
		$('#btnNext').click(function() {
			btn_clicado();
			if(cntClickNext <= 1) {
				cntClickNext = cntClickNext + 1;
				changer(cmd[cntClickNext]);
			}else{
				return false;
			}
			
			
		});
		
		$('#btnAnterior').click(function() {
			btn_clicado();
			if(cntClickNext >= 1) {
				cntClickNext = cntClickNext - 1;
				changer(cmd[cntClickNext]);
			}else{
				return false;
			}
		});
		
		$('#frmMatricula').submit(function(){
			envia_form();
		});
		
		$('#btnSalvar').click(function(){
			envia_form();
		});
		
	});
	function changer(novo) {
		$(last).fadeOut('100', function() {
			$(novo).fadeIn('100');
			last = novo;
		});
	}
	
	function btn_clicado(){
		

	}
	function envia_form(){
		var form = $('#form_matricula');
		form.fadeOut('100',function(){
			$('#loading').fadeIn('fast');
		});
		
		$.post('/req/put_matricula',{
			aluno_nome: $('input[name=aluno_nome]').val(),
			aluno_sobrenome: $('input[name=aluno_sobrenome]').val(),
			aluno_dataNasc: $('input[name=aluno_dataNasc]').val(),
			aluno_rg: $('input[name=aluno_rg]').val(),
			aluno_cpf: $('input[name=aluno_cpf]').val(),
			aluno_endereco: $('input[name=aluno_endereco]').val(),
			aluno_bairro: $('input[name=aluno_bairro]').val(),
			aluno_cep: $('input[name=aluno_cep]').val(),
			aluno_cidade: $('input[name=aluno_cidade]').val(),
			aluno_estado: $('input[name=aluno_estado]').val(),
			aluno_pais: $('input[name=aluno_pais]').val(),
			aluno_tel_1: $('input[name=aluno_tel_1]').val(),
			aluno_tel_2: $('input[name=aluno_tel_2]').val(),
			aluno_email: $('input[name=aluno_email]').val(),
			aluno_obs: $('textarea#aluno_obs').val(),
			responsavel_nome: $('input[name=responsavel_nome]').val(),
			responsavel_sobrenome: $('input[name=responsavel_sobrenome]').val(),
			responsavel_dataNasc: $('input[name=responsavel_dataNasc]').val(),
			responsavel_rg: $('input[name=responsavel_rg]').val(),
			responsavel_cpf: $('input[name=responsavel_cpf]').val(),
			responsavel_endereco: $('input[name=responsavel_endereco]').val(),
			responsavel_bairro: $('input[name=responsavel_bairro]').val(),
			responsavel_cep: $('input[name=responsavel_cep]').val(),
			responsavel_cidade: $('input[name=responsavel_cidade]').val(),
			responsavel_estado: $('input[name=responsavel_estado]').val(),
			responsavel_pais: $('input[name=responsavel_pais]').val(),
			responsavel_tel_1: $('input[name=responsavel_tel_1]').val(),
			responsavel_tel_2: $('input[name=responsavel_tel_2]').val(),
			responsavel_email: $('input[name=responsavel_email]').val(),
			responsavel_obs: $('textarea#responsavel_obs').val(),
			turma: $('select[name=turma]').val(),
			curso: $('select[name=curso]').val()
		},function(data){
			$('#loading').html(data);
		  	
		  }
		);
	}
</script>
<div id="loading" style="display:none;">
	<img src="/layout/img/carregando.gif" />
</div>
<div id="form_matricula">
	<form name="frmMatricula">
		<div id="campos">
		<div id="cadastro_aluno">
			<div class="frmRow">
				<input type='text' name='aluno_nome' placeholder="Nome" maxlength="45" size="30"/>
				<input type='text' name='aluno_sobrenome' placeholder="Sobrenome" maxlength="85" size="50"/>
			</div>
			<div class="frmRow">
				<input type='text' name='aluno_dataNasc' class="data" placeholder="Data de nascimento" maxlength="11" size="20"/>
				<input type='text' name='aluno_rg' class="rg" placeholder="RG" maxlength="9" size="9" />
				<input type='text' name='aluno_cpf' class="cpf" id="cpf" placeholder="CPF" maxlength="11" size="11" />
			</div>
			<div class="frmRow">
				<input type='text' name='aluno_endereco' placeholder="Endereço" maslenght="85" size="60"/>
				<input type='text' name='aluno_bairro' placeholder="Bairro" maxlength="45" size="30" />
				<input type='text' name='aluno_cep' class="cep" placeholder="CEP" maxlength="8" size="9" />
			</div>
			<div class="frmRow">
				<input type='text' name='aluno_cidade' placeholder="Cidade" maslenght="45" size="30"/>
				<input type='text' name='aluno_estado' placeholder="Estado" maxlength="45" size="30" />
				<input type='text' name='aluno_pais' placeholder="Pais" maxlength="45" size="30" />
			</div>
			<div class="frmRow">
				<input type='text' name='aluno_tel_1' class="telefone" placeholder="Telefone 1" maslenght="45" size="30"/>
				<input type='text' name='aluno_tel_2' class="telefone" placeholder="Telefone 2" maxlength="45" size="30" />
				<input type='text' name='aluno_email' placeholder="E-mail" maxlength="45" size="30" />
			</div>
			<div class="frmRow">
				<textarea name='obs' id="aluno_obs" placeholder='Observações' cols="70" rows="10"></textarea>
			</div>
		</div>
		<div id="cadastro_responsavel" style="display:none;">
			<div class="frmRow">
				<input type='text' name='responsavel_nome' placeholder="Nome" maxlength="45" size="30"/>
				<input type='text' name='responsavel_sobrenome' placeholder="Sobrenome" maxlength="85" size="50"/>
			</div>
			<div class="frmRow">
				<input type='text' name='responsavel_dataNasc' class="data" placeholder="Data de nascimento" maxlength="11" size="20"/>
				<input type='text' name='responsavel_rg' class="rg" placeholder="RG" maxlength="9" size="9" />
				<input type='text' name='responsavel_cpf' class="cpf" placeholder="CPF" maxlength="11" size="11" />
			</div>
			<div class="frmRow">
				<input type='text' name='responsavel_endereco' placeholder="Endereço" maslenght="85" size="60"/>
				<input type='text' name='responsavel_bairro' placeholder="Bairro" maxlength="45" size="30" />
				<input type='text' name='responsavel_cep' class="cep" placeholder="CEP" maxlength="8" size="9" />
			</div>
			<div class="frmRow">
				<input type='text' name='responsavel_cidade' placeholder="Cidade" maslenght="45" size="30"/>
				<input type='text' name='responsavel_estado' placeholder="Estado" maxlength="45" size="30" />
				<input type='text' name='responsavel_pais' placeholder="Pais" maxlength="45" size="30" />
			</div>
			<div class="frmRow">
				<input type='text' name='responsavel_tel_1' class="telefone" placeholder="Telefone 1" maslenght="45" size="30"/>
				<input type='text' name='responsavel_tel_2' class="telefone" placeholder="Telefone 2" maxlength="45" size="30" />
				<input type='text' name='responsavel_email' placeholder="E-mail" maxlength="45" size="30" />
			</div>
			<div class="frmRow">
				<input type="hidden" name="observacoes" />
				<textarea name='obs' id="responsavel_obs" placeholder='Observações' cols="70" rows="10"></textarea>
			</div>
		</div>
		<div id="cadastro_curso" style="display:none">
			<?php
			$db->abre(1);
			$cursos = $db->query("SELECT * FROM curso",1);
			$turma = $db->query("SELECT * FROM turma",1);
			$db->fecha(1);
			?>
			
			<select name='curso'>
				<option value='-1'>Curso</option>
				<?php
				for($i=0;$i<=count($cursos);$i++){
					echo "<option value=\"".$cursos[$i]['idcurso']."\">".$cursos[$i]['nome']."</option>";
				}
				?>
			</select>
			<select name='turma'>
				<option value='-1'>Turma</option>
				<?php
				for($i=0;$i<=count($turma);$i++){
					echo "<option value=\"".$turma[$i]['idturma']."\">".$turma[$i]['nome']."</option>";
				}
				?>
			</select>
		</div>
		</div>
		<!-- BOTÕES -->
		<div id="botoes">
			<button type="button" id="btnAnterior" class="active">
				Anterior
			</button>
			<button type="button" id="btnNext" class="active">
				Próximo
			</button>
			<button type="button" id="btnSalvar" class="active">
				Salvar
			</button>
		</div>
	</form>
</div>
<style>
	.frmRow {
		margin-top: 10px;
		margin-left: 5px;
	}
	button{
		border:0;
		background-color: #CCC;
	}
	#campos{
		height:400px;
	}
	#botoes{
		width:300px;
		float:right;
		margin-top:30px;
		text-align: right;
		margin-right:10px;		
	}
	.active{
		border:1px solid #2f2f2f;
		background-color:#FFF;
	}
	.inactive{
		border:1px solid #CCC;
		color:#CCC;
		background-color:#FCFCFC;
	}
	.frmRow input{
		padding:5px;
		margin-top:5px;
		margin-left:5px;
	}
</style>
