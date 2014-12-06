<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$acuerdo_previo = $_POST['acuerdo_previo'];
    $acuerdo_comment = $_POST['acuerdo_comment'];
  	$fecha_inicio = date ( 'Y-m-d');
    $id = $_POST['id_user'];


  	$sql = 'UPDATE proceso_cartera SET id_proceso="4",acuerdo_previo="'.$acuerdo_previo.'",acuerdo_comment="'.$acuerdo_comment.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		header("Location:../proceso.php?id=$id_cartera&proceso=3");
  	} else {
  		header("Location:index.php?msj=1");
  	}
?>