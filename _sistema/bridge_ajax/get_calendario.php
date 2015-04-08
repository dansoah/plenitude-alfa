<?php

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	header('location:/');
	exit ;
}

$ano = $_POST['ano'];
$mes = $_POST['mes'];


$cont = 0;
$dia = date("d");
$dias = array();
$totalDias = date("t");
$primeiroDia = date("D", mktime(0, 0, 0, $mes, 1, $ano));

for ($d = 0; $d < $totalDias; $d++)
	$dias[$d] = array_push($dias, $d + 1);

switch($primeiroDia) {
	case "Sun" :
		$pos = 0;
		break;

	case "Mon" :
		$pos = 1;
		break;

	case "Tue" :
		$pos = 2;
		break;

	case "Wed" :
		$pos = 3;
		break;

	case "Thu" :
		$pos = 4;
		break;

	case "Fri" :
		$pos = 5;
		break;

	case "Sat" :
		$pos = 6;
		break;
}//Fim do switch

switch($mes) {
	case 1 :
		$mes2 = "Janeiro";
		break;

	case 2 :
		$mes2 = "Fevereiro";
		break;

	case 3 :
		$mes2 = "Março";
		break;

	case 4 :
		$mes2 = "Abril";
		break;

	case 5 :
		$mes2 = "Maio";
		break;

	case 6 :
		$mes2 = "Junho";
		break;

	case 7 :
		$mes2 = "Julho";
		break;

	case 8 :
		$mes2 = "Agosto";
		break;

	case 9 :
		$mes2 = "Setembro";
		break;

	case 10 :
		$mes2 = "Outubro";
		break;

	case 11 :
		$mes2 = "Novembro";
		break;

	case 12 :
		$mes2 = "Dezembro";
		break;
}//Fim do switch

echo "<table>";
echo "<tr>
<td class=\"diasemana calendario_td\">Domingo</td>
<td class=\"diasemana calendario_td\">Segunda</td>
<td class=\"diasemana calendario_td\">Terça</td>
<td class=\"diasemana calendario_td\">Quarta</td>
<td class=\"diasemana calendario_td\">Quinta</td>
<td class=\"diasemana calendario_td\">Sexta</td>
<td class=\"diasemana calendario_td\">Sábado</td>
</tr>";

for ($linha = 0; $linha < 6; $linha++) {
	echo "</tr>";
	for ($coluna = 0; $coluna < 7; $coluna++) {
		$pos2 = $cont - $pos;

		if (empty($dias[$pos2]))
			echo "<td ><div class='dia vazio'>&nbsp;</div></td>";
		else {
			if ($dias[$pos2] == $dia)
				echo "<td class=\"calendario_td\" ><div class='dia atual'>" . $dias[$pos2] . "</div><div class='etc'></div></td>";
			else
				echo "<td class=\"calendario_td\"><div class='dia'>" . $dias[$pos2] . "</div><div class='etc'><div class='evento' style='display:none;'>4<div class='big'> </div></div></div></td>";
		}//Fim do else

		$cont++;
	}//Fim do for
	echo "</tr>";
}//Fim do for
