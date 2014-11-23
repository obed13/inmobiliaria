<?php
	require_once '../conexion.php';
	$conexion = conectar();

	$id_cartera = $_POST['id_carteraPromesa'];
	$promesa = $_POST['promesa'] ;
	$fechaEsperada = $_POST['fechaEsperada'] ;
	$fechaCierre = $_POST['fechaCierre'] ;
	$coment_promesa = $_POST['coment_promesa'];

	if($fechaEsperada == ""){
		$fechaEsperada = "0000-00-00";
	}
	if($fechaCierre == ""){
		$fechaCierre = "0000-00-00";
	}
	if($coment_promesa == ""){
		$coment_promesa = " ";
	}

	if($promesa == 1){
		$sqls = "UPDATE proceso_cartera SET estatus='1' WHERE id_cartera='".$id_cartera."' ";
		$result = $conexion->query($sqls);
	}elseif($promesa == 2){
		$sqls2 = "UPDATE proceso_cartera SET estatus='1' WHERE id_cartera='".$id_cartera."' ";
		$result = $conexion->query($sqls2);
	}

	$sql = "UPDATE proceso_cartera SET promesa='".$promesa."',fechaEsperada='".$fechaEsperada."',fechaCierre='".$fechaCierre."',coment_promesa='".$coment_promesa."' WHERE id_cartera='".$id_cartera."' ";

	$resultado = $conexion->query($sql);

	if ($resultado) {
		$result = array('msj' => true );
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);
?>