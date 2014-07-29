<?php  
	require_once '../conexion.php';
	//sleep(3);
	$conexion = conectar();
	
	$cartera = strtoupper($_POST['nom_cartera']);
	$fecha_entrega = strtotime ( '+5 day' , strtotime ( date ( 'Y-m-d' ) ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

	$sql = "INSERT INTO proceso_cartera(consec,nom_cartera,fecha,id_proceso,fecha_inicio,fecha_entrega,recabar_doc_mls) VALUES('1','$cartera',curdate(),'2',curdate(),'$fecha_entrega','3') ";
	
    $fecha = date ( 'Y-m-d' );

	$resultado = $conexion->query($sql);

	$sqls = "SELECT id_cartera FROM proceso_cartera WHERE nom_cartera='$cartera' ";
	$ruta = $conexion->query($sqls);
	$row = $ruta->fetch_array();

	$sql2 = "INSERT INTO mls(id_cartera,id_proceso_mls) VALUES ('".$row['id_cartera']."','1')";
    $mls = $conexion->query($sql2);

	//$sql = "INSERT INTO proceso_cartera (id_cartera,id_proceso,fecha_inicio,fecha_entrega) VALUES ('".$row['id_cartera']."','2',CURDATE(),'".$fecha_entrega."')";
	
	if ($ruta->num_rows) {
		$result = array('msj' => true,'id_cartera' => $row['id_cartera']);
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);
?>