<?php
	require_once '../../conexion.php';
    $conexion = conectar();

    $id = $_POST['id'];

    $sql = "SELECT
    			a.*
    			,DATE_FORMAT(a.fecha,'%d-%m-%Y') AS fecha
    			,concat(b.nombre,' ',b.ap_paterno) as encargado
    		FROM
    			actividades a, usuario b
    		WHERE
    			a.id_cartera='".$id."'
    		and
    			b.id_user = a.id_user
    		ORDER BY
    			a.fecha ASC";

    $consulta = $conexion->query($sql);
    while ($row = $consulta->fetch_array()) {

		$rows['data'][]=$row;

	}

	echo json_encode($rows);
?>