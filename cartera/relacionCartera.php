<?php
	require_once '../conexion.php';

	$conexion = conectar();

  $id_cartera = $_POST['id_cartera'];
  $relacion = $_POST['relacionCartera'];

	$sql = "UPDATE proceso_cartera SET id_relacion='".$relacion."' WHERE id_cartera='".$id_cartera."' ";
	$int = $conexion->query($sql);

  if ($int) {
    $result = array('msj' => true);
  }else{
    $result = array('msj' => false);
  }

	echo json_encode($result);
?>