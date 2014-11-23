<?php
	require_once '../../conexion.php';
  	$conexion = conectar();

  	$nombre = $_POST['nombre'];
  	$paterno = $_POST['paterno'];
  	$materno = $_POST['materno'];

  	$sql = "INSERT INTO usuario(nombre,ap_paterno,ap_materno) VALUES('".$nombre."','".$paterno."','".$materno."') ";

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true);
  	}else {
  		$result = array('msj' => false);
  	}

  	echo json_encode($result);
?>