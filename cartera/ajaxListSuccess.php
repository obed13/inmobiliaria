<?php
	require_once '../conexion.php';

	$conexion = conectar();

	$sql = "
        SELECT 
          DATE_FORMAT(a.fecha, '%d-%m-%Y') fecha, 
          a.nom_cartera, 
          a.id_cartera,
          a.estatus,
          a.recabar_doc_mls
        FROM 
          proceso_cartera a
        where estatus='1'
    ";
	$rows = array();

	$resultado = $conexion->query($sql);

	while ($row = $resultado->fetch_array()) {

		$rows['data'][]=$row;

	}

	echo json_encode($rows);
?>