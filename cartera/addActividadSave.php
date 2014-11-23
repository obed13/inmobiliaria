<?php
	require_once '../conexion.php';
	$conexion = conectar();

	$id_cartera = $_POST['id_carteraActividad'];
	$opcionActividad = $_POST['opcionActividad'] ;
	$fechaActividad = $_POST['fechaActividad'] ;
	$comentarioAcitividad = $_POST['comentarioAcitividad'] ;
	$interesado = $_POST['interesado'];
	$usuario = $_POST['usuario'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];


	$sql = "INSERT INTO actividades (id_cartera,id_user,opcion,fecha,interesado,telefono,email,comentario) VALUES ('".$id_cartera."','".$usuario."','".$opcionActividad."','".$fechaActividad."','".$interesado."','".$tel."','".$email."','".$comentarioAcitividad."') ";

	$resultado = $conexion->query($sql);

	if ($resultado) {
		$result = array('msj' => true);
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);
?>