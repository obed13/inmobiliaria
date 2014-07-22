<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$recabar_firmas = $_POST['recabar_firmas'];
    $firma_aviso_privacidad = $_POST['firma_aviso_privacidad'];
    $contrato_inicio = $_POST['contrato_inicio'];
    $contrato_fin = $_POST['contrato_fin'];
  	$fecha_inicio = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

  	$sql = 'UPDATE proceso_cartera SET id_proceso="7",recabar_firmas="'.$recabar_firmas.'",firma_aviso_privacidad="'.$firma_aviso_privacidad.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
    $sql2 = 'UPDATE proceso_cartera SET contrato_inicio="'.$contrato_inicio.'",contrato_fin="'.$contrato_fin.'" WHERE id_cartera="'.$id_cartera.'" ';
    $sql3 = "INSERT INTO mls(id_cartera,id_proceso_mls,a1)VALUES('".$id_cartera."','1','1')";
    
    $ruta = $conexion->query($sql);
  	$ruta = $conexion->query($sql2);
    $ruta = $conexion->query($sql3);

  	if ($ruta) {
  		header("Location:../proceso.php?id=$id_cartera");
  	} else {
  		header("Location:../proceso.php?id=$id_cartera&msj=1");
  	}
?>