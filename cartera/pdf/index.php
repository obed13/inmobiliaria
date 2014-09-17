<?php
require_once '../../conexion.php';
$conexion = conectar();
$cartera = $_GET['id'];

$sql = 'SELECT
	b.ruta_proceso proceso,
	a.*
FROM
	proceso_cartera a,
	procesos b
WHERE
	a.id_cartera = "'.$cartera.'"
and
	a.id_proceso = b.id_proceso ';
$consulta = $conexion->query($sql);
$row = $consulta->fetch_assoc();

$content = '
	<table border="1" style="border-collapse: collapse;">
	  <thead>
	  	<tr style="background:#A8A8A8;">
	  		<th colspan="4" align="center">Reporte de Cartera</th>
	  	</tr>
	  </thead>
	  <tbody>
	  	<tr>
	    	<th style="background:#E6E6FA;">Propiedad:</th>
	      	<td>'.$row['nom_cartera'].'</td>
	      	<th style="background:#E6E6FA;">Fecha:</th>
	      	<td>'.$row['fecha'].'</td>
	    </tr>
	    <tr>
	    	<th style="background:#E6E6FA;">Proceso:</th>
	      	<td>'.$row['proceso'].'</td>
	      	<th style="background:#E6E6FA;">Fecha de Entrega de Proceso:</th>
	      	<td>'.$row['fecha_entrega'].'</td>
	    </tr>
	    <tr>
	    	<th style="background:#E6E6FA;">Comentario Preliminar:</th>
	      	<td>'.$row['comment_preliminar'].'</td>
	      	<th style="background:#E6E6FA;">Cita Propiedad :</th>
	      	<td>'.$row['cita_propiedad'].'</td>
	    </tr>
	    <tr>
	    	<th style="background:#E6E6FA;">Comentario Seguimiento:</th>
	      	<td>'.$row['comment_seguimiento'].'</td>
	      	<th style="background:#E6E6FA;">Acuerdo Previo a Contrato:</th>';
	    	if ($row['acuerdo_previo'] == 1) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='</tr>
	    <tr>
			<th style="background:#E6E6FA;">Comentario:</th>
	      	<td>'.$row['acuerdo_comment'].'</td>
	      	<th style="background:#E6E6FA;">Precio del Dueño:</th>
	      	<td>'.$row['precio_dueno'].'</td>
	    </tr>
	    <tr>
			<th style="background:#E6E6FA;">Precio Sugerido:</th>
	      	<td>'.$row['precio_sugerido'].'</td>
	      	<th style="background:#E6E6FA;">Archivo de Constancia:</th>';
	      	if ($row['archivo']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Tomar Fotos preliminares:</th>';
			if ($row['foto_preliminar']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
			<th style="background:#E6E6FA;">Revision de Condiciones Preliminares:</th>';
			if ($row['revision_cond_preliminar']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Criterios para Elaborar C. P. S.:</th>
			<td>'.$row['criterios_elab_contrato'].'</td>
			<th style="background:#E6E6FA;">Elaborar C. de P. de S.:</th>';
			if ($row['elab_contrato']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Recabar Firmas para Contrato:</th>';
			if ($row['recabar_firmas']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='<th style="background:#E6E6FA;">Firma de Aviso de Privacidad:</th>';
			if ($row['firma_aviso_privacidad']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Fecha de Contrato Inicio:</th>
			<td>'.$row['contrato_inicio'].'</td>
			<th style="background:#E6E6FA;">Fecha de Contrato Fin:</th>
			<td>'.$row['contrato_fin'].'</td>';
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Poner Lona y Fotos Finales:</th>';
			if ($row['poner_lona']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='<th style="background:#E6E6FA;">Dar de Alta en CRM y MLS AMPIRED:</th>';
			if ($row['crm']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Documentacion MLS:</th>';
			if ($row['recabar_doc_mls'] == 1) {
$content .='<td>MLS <img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}elseif ($row['recabar_doc_mls'] == 3) {
$content .='<td>MLS Express <img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
    	$sqlcapana = "SELECT * FROM datos_inmuebles WHERE id_cartera='".$cartera."'  ";
	   	$campana = $conexion->query($sqlcapana);
		$rows = $campana->fetch_assoc();
$content .='<th style="background:#E6E6FA;">Datos Inmuebles:</th>';
			if ($rows['tipo_mueble']) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
	   	$sqlcapana = "SELECT * FROM campana WHERE id_cartera='".$cartera."' AND campana='1' ";
	   	$campana = $conexion->query($sqlcapana);
		$rows = $campana->fetch_assoc();
$content .='
		</tr></tbody>
		</table>
		<br>
		<table border="1" style="border-collapse: collapse;">
		<tbody>
		<tr>
			<th style="background:#E6E6FA;">Campaña Inicial:</th>';
			if ($rows['evento_open_house'] == 1) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
			<th style="background:#E6E6FA;">Reporte Bimestral de Actividades:</th>
			<td width="250">'.$rows['reporte_mensual'].'</td>
		</tr>
		<tr>
			';
$content .='<th style="background:#E6E6FA;">Acuerdos Resultado de Reporte Bimestral:</th>
			<td width="250">'.$rows['acuerdo_reporte'].'</td>
			';
		$sqlcapana2 = "SELECT * FROM campana WHERE id_cartera='".$cartera."' AND campana='2' ";
	   	$campanas = $conexion->query($sqlcapana2);
		$rowss = $campanas->fetch_assoc();
$content .='
			<th style="background:#E6E6FA;">Campaña Intermedio:</th>';
			if ($rowss['evento_open_house'] == 1) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Reporte Bimestral de Actividades:</th>
			<td>'.$rowss['reporte_mensual'].'</td>
			<th style="background:#E6E6FA;">Acuerdos Resultado de Reporte Bimestral:</th>
			<td>'.$rowss['acuerdo_reporte'].'</td>
			';
			$sqlcapana2 = "SELECT * FROM campana WHERE id_cartera='".$cartera."' AND campana='3' ";
	   		$campanaa = $conexion->query($sqlcapana2);
			$rowsss = $campanaa->fetch_assoc();
$content .='
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Campaña Final:</th>';
			if ($rowsss['evento_open_house'] == 1) {
$content .='<td><img src="../../img/file_icons/ico_ok.png" alt=""></td>';
	    	}else{
$content .='<td><img src="../../img/file_icons/salir.gif" alt=""></td>';
	    	}
$content .='
			<th style="background:#E6E6FA;">Reporte Bimestral de Actividades:</th>
			<td>'.$rowsss['reporte_mensual'].'</td>
		</tr>
		<tr>
			<th style="background:#E6E6FA;">Acuerdos Resultado de Reporte Bimestral:</th>
			<td>'.$rowsss['acuerdo_reporte'].'</td>
			';
$content .='</tr>  </tbody>
	</table>
';

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('reporte.pdf');
?>