<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera             = $_POST['id_cartera'];
    $poner_lona             = $_POST['poner_lona'];
    $crm                    = $_POST['crm'];
  	$fecha_inicio           = date ( 'Y-m-d');
    $id = $_POST['id_user'];

      //$sql = 'UPDATE proceso_cartera SET id_proceso="7.1",recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET poner_lona="'.$poner_lona.'",crm="'.$crm.'" WHERE id_cartera="'.$id_cartera.'" ';

      //$ruta = $conexion->query($sql);
      $rutas = $conexion->query($sqls);

      if ($rutas) {
        header("Location:../proceso.php?id=$id_cartera&proceso=7");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
?>