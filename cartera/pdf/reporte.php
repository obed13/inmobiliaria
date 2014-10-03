<?php
require_once '../../conexion.php';
$conexion = conectar();
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);
	return $dias;
}

$content = '
	<style type="text/css">
	tr:nth-child(odd){ background-color:#eee; }
	</style>
	<table border="1" style="border-collapse: collapse;">
	  <thead>
	    <tr style="background:#E6E6FA;">
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
	      <th align="center" width="50">Cartera</th>
	      <th align="center" width="50">Cliente</th>
	      <th align="center" width="50">Labor Venta</th>
	    </tr>
	  </thead>
	  <tbody>';
$sql="
	SELECT
		a.*,
		datediff(a.contrato_fin, a.contrato_inicio) as diferencia,
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
			<td>'.$row['contrato_inicio'].'</td>
			<td>'.$row['contrato_fin'].'</td>
			<td align="center">'.dias_transcurridos($row['contrato_inicio'],date('Y-m-d')).'</td>
			<td align="center">'.$row['diferencia'].'</td>
			<td>'.$row['fechaEsperada'].'</td>';
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
$content .='<td align="right">'.$row['precio_dueno'].'</td>
			<td align="center">'.$row['comision'].'%</td>
			<td align="right">'.$valor.'</td>';
			if(isset($row['codigoUsuario']) != ''){
$content .='<td align="center">'.$row['codigoUsuario'].'</td>';
			}else{
$content .='<td></td>';
		}
			if(isset($row['codigoUsuario']) != ''){
$content .='<td align="center">'.$row['codigoUsuario'].'</td>';
			}else{
$content .='<td></td>';
		}
			if(isset($row['codigoUsuario']) != ''){
$content .='<td align="center">'.$row['codigoUsuario'].'</td>';
			}else{
$content .='<td></td>';
		}
$content .='</tr>
';
}
$content .='</tbody>
	</table>
';


require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('reporte.pdf');

/*
SELECT
		a.*,
		datediff(a.contrato_fin, a.contrato_inicio) as diferencia,
		b.comision,
		c.codigoUsuario
	FROM
		proceso_cartera a,
		datos_inmuebles b,
		usuariorelacion c
	WHERE
		a.id_cartera = b.id_cartera
	AND
		a.id_usuarioRelacion = c.id_usuarioRelacion
 */
?>