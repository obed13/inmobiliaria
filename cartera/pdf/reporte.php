<?php
require_once '../../conexion.php';
$conexion = conectar();

$content = '
	<table border="1" style="border-collapse: collapse;">
	  <thead>
	    <tr>
	      <th align="center">Clave</th>
	      <th align="center" width="70">Inicio Exclusiva</th>
	      <th align="center" width="70">Termino Exclusiva</th>
	      <th align="center" width="90">Dias Transcurridos</th>
	      <th align="center" width="70">Dias Faltantes</th>
	      <th align="center" width="70">Fecha Esperada de Cierre</th>
	      <th align="center" width="70">Estatus</th>
	      <th align="center" width="70">Precio Pactado</th>
	      <th align="center" width="70">Comision Pactada</th>
	      <th align="center" width="50">Valor Total Comision</th>
	    </tr>
	  </thead>
	  <tbody>';
$sql="
	SELECT
		a.*,
		b.comision
	FROM
		proceso_cartera a,
		datos_inmuebles b
	WHERE
		a.id_cartera = b.id_cartera
";
$consulta=$conexion->query($sql);
while ($row=$consulta->fetch_assoc()) {
$valor = number_format($row['precio_dueno']*$row['comision']/100,2);
//$valor = $row['precio_dueno'] * $row['comision'];
$content .='
		<tr>
			<td>'.$row['nom_cartera'].'</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>';
		if ($row['promesa'] == 1) {
$content .='<td>Vendida</td>';
		}elseif ($row['promesa'] == 2) {
$content .='<td>Rentada</td>';
		}elseif ($row['promesa'] == 3) {
$content .='<td>Promesa</td>';
		}elseif ($row['promesa'] == 4) {
$content .='<td>Negociacion</td>';
		}else{
$content .='<td></td>';
		}
$content .='<td>'.$row['precio_dueno'].'</td>
			<td>'.$row['comision'].'%</td>
			<td>'.$valor.'</td>
		</tr>
';
}
$content .='</tbody>
	</table>
';


require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('reporte.pdf');
?>