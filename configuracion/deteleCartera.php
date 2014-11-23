<?php
	require_once '../conexion.php';

	$conexion = conectar();

	$id = $_GET['id'];

	$sql1 = "DELETE FROM mls WHERE id_cartera='".$id."' ";
	$sql2 = "DELETE FROM post WHERE id_cartera='".$id."' ";
	$sql3 = "DELETE FROM fotos WHERE id_cartera='".$id."' ";
	$sql4 = "DELETE FROM campana WHERE id_cartera='".$id."' ";
	$sql5 = "DELETE FROM actividades WHERE id_cartera='".$id."' ";
	$sql6 = "DELETE FROM proceso_cartera WHERE id_cartera='".$id."' ";
	$sql7 = "DELETE FROM datos_inmuebles WHERE id_cartera='".$id."' ";

	$consulta1 = $conexion->query($sql1);
	$consulta2 = $conexion->query($sql2);
	$consulta3 = $conexion->query($sql3);
	$consulta4 = $conexion->query($sql4);
	$consulta5 = $conexion->query($sql5);
	$consulta6 = $conexion->query($sql6);
	$consulta7 = $conexion->query($sql7);

	if ($sql6) {
		header("Location:carteras.php?msj=1");
	} else {
		header("Location:carteras.php?msj=2");
	}

?>