<?php
	require_once '../conexion.php';
	//sleep(3);
	$conexion = conectar();

	$cartera = strtoupper($_POST['nom_cartera']);
	$id_user = $_POST['id_user'];
	$fecha_entrega = strtotime ( '+5 day' , strtotime ( date ( 'Y-m-d' ) ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $consulta='SELECT nom_cartera FROM proceso_cartera WHERE nom_cartera ="'.$cartera.'" ';
    $con = $conexion->query($consulta);
    $respuesta = $con->fetch_array();
    if ($respuesta['nom_cartera'] == $cartera) {
    	$result = array('msj' => 3);
    }else{

    	$querys='SELECT ifnull(max(consec),0)+1 as id FROM proceso_cartera ';
	    $cons = $conexion->query($querys);
	    $consec = $cons->fetch_array();

		$sql = "INSERT INTO proceso_cartera(consec,nom_cartera,fecha,id_proceso,fecha_inicio,fecha_entrega,recabar_doc_mls,resp)
		 VALUES('".$consec['id']."','".$cartera."',now(),'2',now(),'".$fecha_entrega."','0','".$id_user."') ";

	    //$fecha = date ( 'Y-m-d' );

		$resultado = $conexion->query($sql);

		$sqls = "SELECT id_cartera FROM proceso_cartera WHERE nom_cartera='".$cartera."' ";
		$ruta = $conexion->query($sqls);
		$row = $ruta->fetch_array();

		//$sql2 = "INSERT INTO mls(id_cartera,id_proceso_mls) VALUES ('".$row['id_cartera']."','1')";
	    //$mls = $conexion->query($sql2);

		//$sql = "INSERT INTO proceso_cartera (id_cartera,id_proceso,fecha_inicio,fecha_entrega) VALUES ('".$row['id_cartera']."','2',CURDATE(),'".$fecha_entrega."')";

		if ($ruta->num_rows) {
			$result = array('msj' => 1,'id_cartera' => $row['id_cartera']);
		} else {
			$result = array('msj' => 2 );
		}
    }

	echo json_encode($result);
?>