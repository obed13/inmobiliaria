<?php
	require_once 'conexion.php';

	$conexion = conectar();
	//sleep(3);
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT id_user,id_cat,nombre,ap_paterno FROM usuario WHERE correo='$email' AND password='$password' ";

	$result = $conexion->query($sql);

	if ($row = $result->fetch_array()) 
	{
		$uid = $row['id_user'];
		$id_cat = $row['id_cat'];
		$nombre = $row['nombre'].' '.$row['ap_paterno'];

		session_start();

		$_SESSION['uid'] = $uid;
		$_SESSION['id_cat'] = $id_cat;
		$_SESSION['name'] = $nombre;
		$_SESSION['autenticado'] = 'SI';

		$result = array('auth' => true);
	}
	else 
	{
		$result = array('auth' => false );
	}

	echo json_encode($result);
?>