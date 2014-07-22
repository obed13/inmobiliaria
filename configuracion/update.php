<?php  
	
	require_once '../conexion.php';

	$conexion = conectar();
	//sleep(3);
	$nombre = strtoupper($_POST['nombre_edit']);
	$paterno = strtoupper($_POST['paterno_edit']);
	$materno = strtoupper($_POST['materno_edit']);
	$cat = $_POST['cat_edit'];
	$email = $_POST['email_edit'];
	$pass = md5($_POST['pass_edit']);
	$id_user = $_POST['id_user'];


	if ($pass == '') {
		$sql = "UPDATE usuario SET id_cat='".$cat."', nombre='".$nombre."', ap_paterno='".$paterno."', ap_materno='".$materno."', correo='".$email."'  WHERE id_user='".$id_user."' ";
	}else{
		$sql = "UPDATE usuario SET id_cat='".$cat."', nombre='".$nombre."', ap_paterno='".$paterno."', ap_materno='".$materno."', correo='".$email."', password='".$pass."'  WHERE id_user='".$id_user."' ";	
	}
	

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