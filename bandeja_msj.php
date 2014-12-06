<?php
	require_once 'conexion.php';

	$conexion = conectar();

	$sql = "
		select
			a.id_post,
			a.post mensaje,
			DATE_FORMAT(a.fecha, '%d-%m-%Y') fecha,
			a.id_accion,
			c.nom_accion,
			b.id_user,
			concat(b.nombre,' ',b.ap_paterno)as destinatario,
			a.id_cartera,
			d.nom_cartera
		from
			post a,
			usuario b,
			cat_accion c,
			proceso_cartera d
		where
			a.destinatario = b.id_cat
		and
			a.id_accion = c.id_accion
		and
			a.id_cartera = d.id_cartera
		and
			d.estatus = 0
	";

	$rows = array();

	$resultado = $conexion->query($sql);

	while ($row = $resultado->fetch_array()) {

		$rows['data'][]=$row;
	}

	echo json_encode($rows);
?>