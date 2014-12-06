<?php
	date_default_timezone_set('America/Los_Angeles');

	function conectar()
	{
		$conexion = new mysqli('localhost','root','','inmobiliaria');
		$conexion->query(" SET NAMES 'utf8' ");

		return $conexion;
	}

	function bandeja($user,$id_cartera,$destinatario,$accion,$fin='')
	{
		$conexion=conectar();

      	$sqlmsj = "SELECT * FROM post WHERE id_cartera='".$id_cartera."' ";
      	$msj = $conexion->query($sqlmsj);
      	$tema = "Tienes un Proceso por Realizar";
      	$fecha = date('Y-m-d');
      	if ($msj->num_rows > 0) {
      		if ($fin == 4) {
      			$sqlpost = "UPDATE post SET id_accion='".$fin."' WHERE id_cartera='".$id_cartera."' ";
        		$rutapost = $conexion->query($sqlpost);
      		} else {
      			$sqlpost = "UPDATE post SET id_user='".$user."',id_accion='".$accion."',id_cartera='".$id_cartera."',destinatario='".$destinatario."',fecha='".$fecha."' WHERE id_cartera='".$id_cartera."' ";
        		$rutapost = $conexion->query($sqlpost);
      		}

      	}else{
      		$sqlpost = "INSERT INTO post(id_user,id_accion,id_cartera,post,destinatario,fecha) VALUES ('".$user."','".$accion."','".$id_cartera."','".$tema."','".$destinatario."','".$fecha."')";
        	$rutapost = $conexion->query($sqlpost);
      	}
	}

?>