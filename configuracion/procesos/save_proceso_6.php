<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$recabar_firmas = $_POST['recabar_firmas'];
    $firma_aviso_privacidad = $_POST['firma_aviso_privacidad'];
    $contrato_inicio = $_POST['contrato_inicio'];
    $contrato_fin = $_POST['contrato_fin'];
    $elab_contrato = $_POST['elab_contrato'];
  	$fecha_inicio = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $carpeta = "archivos/";
    opendir($carpeta);
    $destino = $carpeta.$_FILES['archivo']['name'];
    if(copy($_FILES['archivo']['tmp_name'], '../../'.$destino))
    {

    	$sql = 'UPDATE proceso_cartera SET elab_contrato="'.$elab_contrato.'",recabar_firmas="'.$recabar_firmas.'",archivo_firma="'.$destino.'",firma_aviso_privacidad="'.$firma_aviso_privacidad.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE proceso_cartera SET contrato_inicio="'.$contrato_inicio.'",contrato_fin="'.$contrato_fin.'" WHERE id_cartera="'.$id_cartera.'" ';


      $ruta = $conexion->query($sql);
    	$rutas = $conexion->query($sql2);

    	if ($ruta) {
    		header("Location:../proceso.php?id=$id_cartera&proceso=5");
    	} else {
    		header("Location:../proceso.php?id=$id_cartera&proceso=5&msj=1");
    	}
    } else{
      header("Location:../proceso.php?id=$id_cartera&proceso=5&msj=2");
    }
?>