<?php
	  require_once '../../conexion.php';
  	$conexion = conectar();

  	$user = $_POST['tipoUser'];
  	$id = $_POST['id_carteraAdd'];

  	$sql = "UPDATE proceso_cartera SET id_usuarioRelacion='$user' WHERE id_cartera='$id' ";

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true);
  	}else {
  		$result = array('msj' => false);
  	}

  	echo json_encode($result);
?>