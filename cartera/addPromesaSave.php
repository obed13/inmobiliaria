<?php
	require_once '../conexion.php';
	$conexion = conectar();

	$id_cartera = $_POST['id_carteraPromesa'];
	$promesa = $_POST['promesa'] ;
	$fechaEsperada = $_POST['fechaEsperada'] ;
	$fechaCierre = $_POST['fechaCierre'] ;


	$sql = "UPDATE proceso_cartera SET promesa='".$promesa."',fechaEsperada='".$fechaEsperada."',fechaCierre='".$fechaCierre."' WHERE id_cartera='".$id_cartera."' ";

	$resultado = $conexion->query($sql);

	if ($resultado) {
		$result = array('msj' => true);
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);
?>