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

$oque = $_POST['oque'];

$db->abre(1);
$livros = $db->query("SELECT * FROM livro WHERE titulo LIKE '%".mysql_real_escape_string($oque)."%'",1);
$db->fecha(1); 

if(count($livros)>0){
	for($i=0;$i<=count($livros)-1;$i++){
	if(!is_array($livros))
		break;
?>
<div class="livro">
	<div class="img_livro"></div>
	<div class="resto_livro">
		<span class="titulo_livro"><?php echo utf8_encode($livros[$i]['titulo']); ?></span>
		<br />
		<span class="autor_livro"><?php echo utf8_encode($livros[$i]['autor']); ?></span> - <span class="ano_livro"> <?php echo $livros[$i]['ano']; ?></span>
		<br />
		<p class="sinopse_livro">
			<?php echo utf8_encode($livros[$i]['sinopse']); ?>
		</p>
		Estoque total: <?php echo $livros[$i]['estoque_total']; ?>
		<br />
		Em estoque: <?php echo $livros[$i]['estoque_atual']; ?><br />
	</div>
</div>
<?php
}
}else{
echo "Nada disponível!";
}
?>
