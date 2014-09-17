<?php
require_once '../../conexion.php';
$conexion = conectar();

$id = $_POST['id_cartera'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

$sql = "SELECT *, DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha
		FROM actividades
		WHERE id_cartera='".$id."'
		AND fecha >= '".$fechaInicio."' AND fecha <= '".$fechaFin."'
		ORDER BY fecha ASC";
$consulta = $conexion->query($sql);
$sql2 = "SELECT nom_cartera
		FROM proceso_cartera
		WHERE id_cartera='".$id."' ";
$cartera = $conexion->query($sql2);
$nom_cartera = $cartera->fetch_assoc();

$content = '
	<table border="1" style="border-collapse: collapse;">
	  <thead>
	  	<tr style="background:#A8A8A8;">
	  		<th align="center" colspan="3">Cartera: '.$nom_cartera['nom_cartera'].'</th>
	  	</tr>
	    <tr style="background:#A8A8A8;">
	    	<th align="center" width="50">Tipo</th>
	    	<th align="center" width="100">Fecha</th>
	    	<th align="center" width="500">Comentario</th>
	    </tr>
	  </thead>
	  <tbody>';
	while ($row = $consulta->fetch_assoc()) {
		if ($row['opcion'] == 1) {$opcion = 'Cita';} else {$opcion = 'Llamada';}
$content .= '
		<tr>
		<td align="center">'.$opcion.'</td>
		<td align="center">'.$row['fecha'].'</td>
		<td>'.$row['comentario'].'</td>
		</tr>
		';
	}
	$sqlnum="SELECT (SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 1 AND fecha >= '".$fechaInicio."' AND fecha <= '".$fechaFin."') as a,
	(SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 2 AND fecha >= '".$fechaInicio."' AND fecha <= '".$fechaFin."') as b FROM actividades WHERE id_cartera='".$id."' ";
	$num = $conexion->query($sqlnum);
	$numero = $num->fetch_array();
$content .= '
		<tr style="background:#E6E6FA;">
			<td>Citas: '.$numero['a'].'</td>
			<td>Llamadas: '.$numero['b'].'</td>
		</tr>
	  </tbody>
	</table>
';


require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('reporteActividades.pdf');
?>