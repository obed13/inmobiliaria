<?php  
	require_once '../conexion.php';
  	$conexion = conectar();

  	$inicio  	= $_POST['fecha_inicio'];
  	$fin	 	= $_POST['fecha_fin'];
  	$id_cartera = $_POST['id_cartera'];

  	$sql = "UPDATE proceso_cartera SET contrato_inicio='".$inicio."', contrato_fin='".$fin."' WHERE id_cartera='".$id_cartera."' ";

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true);
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);
?>