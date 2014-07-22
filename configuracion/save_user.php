<?php  
	
	require_once '../conexion.php';

	$conexion = conectar();
	//sleep(3);
	$nombre = strtoupper($_POST['nombre']);
	$paterno = strtoupper($_POST['paterno']);
	$materno = strtoupper($_POST['materno']);
	$cat = $_POST['cat'];
	$email = $_POST['email'];
	$pass = md5($_POST['pass']);

	$sql = "INSERT INTO usuario(id_cat,nombre,ap_paterno,ap_materno,correo,password) VALUES('".$cat."','".$nombre."','".$paterno."','".$materno."','".$email."','".$pass."') ";

	$result = $conexion->query($sql);

	if ($result) 
	{
		$result = array('msj' => true);
	}
	else 
	{
		$result = array('msj' => false);
	}

	echo json_encode($result);
?>