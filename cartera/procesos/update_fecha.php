<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();

  	$fechaInicio = $_POST['fecha_inicio'];
  	$fechaFin = $_POST['fecha_entrega'];
  	$id = $_POST['id_cartera'];

  	$sql = "UPDATE proceso_cartera SET fecha_entrega='$fechaFin' WHERE id_cartera='$id' ";

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true, 'fecha_entrega' => $fechaFin);
  	}else {
  		$result = array('msj' => false,);
  	}

  	echo json_encode($result);
?>