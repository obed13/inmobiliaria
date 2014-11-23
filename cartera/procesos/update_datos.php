<?php
	require_once '../../conexion.php';
  	$conexion = conectar();

  	$precio = $_POST['new_precio'];
  	$new_cash = $_POST['new_cash'];
    $moneda = $_POST['moneda'];
  	$contrato = $_POST['contrato'];
  	$new_contrato = $_POST['new_contrato'];
  	$id = $_POST['id_cartera'];

  	if ($precio == 'si' && $contrato == 'no') {
  		$sql = "UPDATE proceso_cartera SET  moneda='".$moneda."', precio_dueno='".$new_cash."' WHERE id_cartera='".$id."' ";
  	}elseif ($precio == 'no' && $contrato == 'si') {
  		$sql = "UPDATE proceso_cartera SET nuevo_contrato='".$contrato."', nueva_fecha='".$new_contrato."' WHERE id_cartera='".$id."' ";
  	}else{
  		$sql = "UPDATE proceso_cartera SET moneda='".$moneda."', precio_dueno='".$new_cash."', nuevo_contrato='".$contrato."', nueva_fecha='".$new_contrato."' WHERE id_cartera='".$id."' ";
  	}

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		$result = array('msj' => true);
  	}else {
  		$result = array('msj' => false);
  	}

  	echo json_encode($result);
?>