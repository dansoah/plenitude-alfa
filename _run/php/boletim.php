<style>
	table.tbBoletim{
		border:1px solid #000;
	}
	table.tbBoletim td{
		border:1px solid #000;
		padding:3px;
		vertical-align: middle;
		text-align: center;
	}
	table.tbBoletim td.materia{
		color: #00A8FF;
	}
</style>
<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	exit;

include_once 'var.php';
$usu = $GLOBALS['usu'];
$db = $GLOBALS['db'];
$usu->reload_info();
if(!$usu->check_online())
	exit;

$ano = 2012;

$db->abre(1);


$info = $db->query("SELECT curso,turma FROM alunoXcursoXturmaXano WHERE aluno='".$usu->user_info['id_aluno']."' AND ano='".$ano."'", 1);
$info = $info[0];
//echo "SELECT curso,turma FROM alunoXcursoXturmaXano WHERE aluno='".$usu->user_info['id_aluno']."' AND ano='".$ano."'";

$periodos = $db->query("SELECT * FROM periodo", 1);

$materias = $db->query("SELECT idmateria,nome FROM materia INNER JOIN cursoXmateria AS rel ON rel.materia = materia.idmateria WHERE rel.curso = '".$info['curso']."'", 1);
//echo "SELECT idmateria,nome FROM materia INNER JOIN cursoXmateria AS rel ON rel.materia = materia.idmateria WHERE rel.curso = '".$info['curso']."'";

for($k=0;$k<=count($materias)-1;$k++){
	if($k==0)
		$in = $materias[$k]['idmateria'];
	else
		$in .= ','.$materias[$k]['idmateria'];
}

$notas = $db->query("SELECT nota,periodo,materia,faltas FROM boletim WHERE materia IN(".$in.") AND aluno='".$usu->user_info['id_aluno']."' AND ano='".$ano."'", 1);
$db->fecha(1);
//var_dump($notas);
for($i=0;$i<=count($notas)-1;$i++){
	$final[$notas[$i]['materia']][$notas[$i]['periodo']]['nota'] = $notas[$i]['nota'];
	$final[$notas[$i]['materia']][$notas[$i]['periodo']]['faltas'] = $notas[$i]['faltas'];
}

echo"<table class=\"tbBoletim\">
<tr>
<td rowspan=\"3\">Materia</td>
<td colspan=\"".((count($periodos)) * 2 )."\">Periodo</td>
</tr>
<tr>";
for($i=0;$i<=count($periodos)-1;$i++){
echo"
<td colspan=\"2\">
".utf8_encode($periodos[$i]['nome'])."
</td>";
}
echo "</tr>";
echo"<tr>";
for($i=0;$i<=count($periodos)-1;$i++){
echo"
<td>
Nota
</td>
<td>
Faltas
</td>";
}
echo "</tr>";
for($i=0;$i<=count($materias)-1;$i++){
	echo "<tr>";
	echo"<td>".$materias[$i]['nome']."</td>";
	for($j=0;$j<=count($periodos)-1;$j++){
		$aux_1 = $i+1;
		$aux_2 = $j+1;
		echo "<td>".@$final[$aux_1][$aux_2]['nota']."</td><td>".@$final[$aux_1][$aux_2]['faltas']."</td>";
	}
	echo "</tr>";
}
echo"</table>";
exit;
?>
<style>
	table.tbBoletim{
		border:1px solid #7BA300;
	}
	table.tbBoletim td{
		border:1px solid #7BA300;
		padding:3px;
		vertical-align: middle;
		text-align: center;
	}
	table.tbBoletim td.materia{
		color: #00A8FF;
	}
</style>
<table class="tbBoletim">
	<tr>
		<td rowspan="2">Matéria</td>
		<?php
		$total_temporadas = count($temporadas)-1;
		for($i=0;$i<=$total_temporadas;$i++){
		?>
		<td colspan="4"><?php echo $temporadas[$i]['desc']; ?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td>Nota</td>
		<td>Faltas</td>
		<td>Aulas dadas</td>
		
		<td>Nota</td>
		<td>Faltas</td>
		<td>Aulas dadas</td>
		
		<td>Nota</td>
		<td>Faltas</td>
		<td>Aulas dadas</td>
	</tr>
	<?php
		for($i=0;$i<=count($materias)-1;$i++){
	?>
	<tr>
		<td class="materia"><?php echo $materias[$i]; ?></td>
		<td><?php echo rand(0,8); ?></td>
		<td><?php echo rand(0,30); ?></td>
		<td><?php echo rand(50,65); ?></td>
		
		<td><?php echo rand(0,8); ?></td>
		<td><?php echo rand(0,30); ?></td>
		<td><?php echo rand(50,65); ?></td>
		
		<td><?php echo rand(0,8); ?></td>
		<td><?php echo rand(0,30); ?></td>
		<td><?php echo rand(50,65); ?></td>
		<td></td>
	</tr>
	<?php
		}
	?>
</table>

