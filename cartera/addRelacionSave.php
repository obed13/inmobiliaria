<?php
	require_once '../conexion.php';
  	$conexion = conectar();

  	$nombre = $_POST['nombre'];
  	$paterno = $_POST['paterno'];
  	$materno = $_POST['materno'];
  	$codigoUsuario = $_POST['codigo'];

  	$sql = "INSERT INTO usuariorelacion(nombre,paterno,materno,codigoUsuario) VALUES('".$nombre."','".$paterno."','".$materno."','".$codigoUsuario."') ";

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true);
  	}else {
  		$result = array('msj' => false);
  	}

  	echo json_encode($result);
?>