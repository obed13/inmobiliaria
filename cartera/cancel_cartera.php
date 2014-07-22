<?php  
	require_once '../conexion.php';
  	$conexion = conectar();

  	$moti_cancel = $_POST['moti_cancel'];
  	$id_cartera = $_POST['id_cartera'];

  	$sql = "UPDATE proceso_cartera SET estatus='2', moti_cancel='".$moti_cancel."' WHERE id_cartera='".$id_cartera."' ";

  	$moti = $conexion->query($sql);

  	if ($moti) {
  		$result = array('msj' => true);
  	}else{
  		$result = array('msj' => false);
  	}

  	echo json_encode($result);
?>