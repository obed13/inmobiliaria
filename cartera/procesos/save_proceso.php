<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();

  	$id = $_POST['id'];
  	$id_cartera = $_POST['id_cartera'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

  	$sql = "INSERT INTO proceso_cartera(id_cartera,id_proceso,fecha_inicio,fecha_entrega) VALUES ('".$id_cartera."','2',now(),'".$fecha_entrega."')";
    $ruta = $conexion->query($sql);
    
    $sql2 = "INSERT INTO mls(id_cartera) VALUES ('".$id_cartera."')";
    $mls = $conexion->query($sql2);

  	if ($ruta) {
  		header("Location:../proceso.php?id=$id");
  	}else {
  		header("Location:index.php?msj=1");
  	}
?>