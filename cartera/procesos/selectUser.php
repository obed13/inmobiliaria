<?php
	error_reporting(E_ALL ^ E_NOTICE);
  	session_start();
  	require_once '../../conexion.php';
    require_once '../../sesion.php';
  	$conexion = conectar();

  	$sqlcat = "SELECT * FROM usuario";
	$consulta = $conexion->query($sqlcat);
	while ($row = $consulta->fetch_array()) {
		$rows['data'][]=$row;
	}

	echo json_encode($rows);
?>