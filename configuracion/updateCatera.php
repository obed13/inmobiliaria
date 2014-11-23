<?php
	require_once '../conexion.php';

	$conexion = conectar();
	//sleep(3);
	$nom_cartera = strtoupper($_POST['nom_cartera']);
	$id_cartera = $_POST['id_cartera'];


		$sql = "UPDATE proceso_cartera SET nom_cartera='".$nom_cartera."'  WHERE id_cartera='".$id_cartera."' ";

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