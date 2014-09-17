<?php
	require_once '../conexion.php';
    $conexion = conectar();

    $id = $_POST['id'];

    $sql = "SELECT *, DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha FROM actividades WHERE id_cartera='".$id."' ORDER BY fecha ASC";

    $consulta = $conexion->query($sql);
    while ($row = $consulta->fetch_array()) {

		$rows['data'][]=$row;

	}

	echo json_encode($rows);
?>