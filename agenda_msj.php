<?php
	require_once 'conexion.php';

	$conexion = conectar();

	$sql = "
		select
			a.nom_cartera,
			concat(b.nombre,' ',b.ap_paterno,' ',b.ap_materno) as nombres,
			c.ruta_proceso,
			a.fecha_entrega,
			a.id_proceso,
			a.promesa,
          (
           SELECT
            concat(dd.nombre,' ',dd.ap_paterno,' ',dd.ap_materno)
           FROM
            proceso_cartera aa,
            usuario dd
           WHERE
            aa.id_proceso = a.id_proceso
           AND
            aa.resp = dd.id_user
          ) as creador
		from
			proceso_cartera a,
			usuario b,
			procesos c
		where
			a.id_proceso = c.id_proceso
		and
			c.id_cat = b.id_cat
		and
			a.estatus = 0
		order by a.fecha_entrega
	";

	$rows = array();

	$resultado = $conexion->query($sql);

	while ($row = $resultado->fetch_array()) {

		$rows['data'][]=$row;
	}

	echo json_encode($rows);
?>