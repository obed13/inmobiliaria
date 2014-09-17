<?php
	require_once '../conexion.php';

	$conexion = conectar();

	$sql = "
        select
          a.id_cartera,
          a.nom_cartera,
          DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y') as fecha,
          datediff(a.fecha_entrega, a.fecha_inicio) as dias,
          a.id_proceso,
          a.recabar_doc_mls,
          a.firma_aviso_privacidad,
          a.nuevo_contrato,
          a.estatus,
          a.fecha_entrega
        from
          proceso_cartera a
        where
          not exists (select bb.estatus from proceso_cartera bb where a.id_cartera=bb.id_cartera and bb.estatus >= 1 )
    ";
	$rows = array();

	$resultado = $conexion->query($sql);

	while ($row = $resultado->fetch_array()) {

		$rows['data'][]=$row;

	}

	echo json_encode($rows);
?>