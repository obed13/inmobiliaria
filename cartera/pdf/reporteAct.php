<?php
require_once '../../conexion.php';
$conexion = conectar();

$id = $_POST['id_cartera'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

$sql = "SELECT *, DATE_FORMAT(a.fecha,'%d-%m-%Y') AS fecha, concat(b.nombre,' ',b.ap_paterno) as nombres
		FROM actividades a, usuario b
		WHERE a.id_cartera='".$id."'
		AND a.id_user = b.id_user
		AND a.fecha >= '".$fechaInicio."' AND a.fecha <= '".$fechaFin."'
		ORDER BY a.fecha ASC";
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
	  		<th align="center" colspan="8">Cartera: '.$nom_cartera['nom_cartera'].'</th>
	  	</tr>
	    <tr style="background:#A8A8A8;">
	    	<th align="center" width="50">status</th>
	    	<th align="center" width="50">Tipo</th>
	    	<th align="center" width="100">Fecha</th>
	    	<th align="center" width="150">Comentario</th>
	    	<th align="center" width="100">Encargado</th>
	    	<th align="center" width="100">Interesado</th>
	    	<th align="center" width="100">Telefono</th>
	    	<th align="center" width="100">Email</th>
	    </tr>
	  </thead>
	  <tbody>';
	while ($row = $consulta->fetch_assoc()) {
		if ($row['opcion'] == 1) {$opcion = 'Cita';} else {$opcion = 'Llamada';}
		if ($row['id_tipo_cat'] == 1) {$act = 'Vendida';} elseif ($row['id_tipo_cat'] == 2) {$act = 'Rentada';}elseif ($row['id_tipo_cat'] == 3) {$act = 'Promesa';}elseif ($row['id_tipo_cat'] == 4) {$act = 'Negociacion';}
$content .= '
		<tr>
		<td align="center">'.$act.'</td>
		<td align="center">'.$opcion.'</td>
		<td align="center">'.$row['fecha'].'</td>
		<td>'.$row['comentario'].'</td>
		<td align="center">'.$row['nombres'].'</td>
		<td align="center">'.$row['interesado'].'</td>
		<td align="center">'.$row['telefono'].'</td>
		<td align="center">'.$row['email'].'</td>
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
$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('reporteActividades.pdf');
?>