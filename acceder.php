<?php  
	session_start(); 
  	require_once 'conexion.php';
  	require_once 'sesion.php';
  	$conexion = conectar();

  	$id = $_GET['id'];

  	$sql = "UPDATE post SET id_accion='2' WHERE id_post='".$id."' ";

  	$ins = $conexion->query($sql);

  	$sql2 = "SELECT id_cartera FROM  post WHERE id_post='".$id."' ";

  	$proceso = $conexion->query($sql2);


  	if ($cartera = $proceso->fetch_array()) {
  		header("Location: cartera/proceso.php?id=".$cartera['id_cartera']);
  	}else{
  		header("Location: bandeja.php?msj=1 ");
  	}
?>