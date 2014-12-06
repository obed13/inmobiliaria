<?php
	require_once '../conexion.php';
	$conexion = conectar();

	$id_cartera = $_GET['id'];


	$sql = "UPDATE proceso_cartera SET estatus='0', promesa='0',fechaEsperada='0000-00-00',fechaCierre='0000-00-00' WHERE id_cartera='".$id_cartera."' ";

	$resultado = $conexion->query($sql);

	if ($resultado) {
		//$result = array('msj' => true );
		header("Location:list_success.php");
	} else {
		//$result = array('msj' => false );
		header("Location:list_success.php?msj=1");
	}

	//echo json_encode($result);
?>