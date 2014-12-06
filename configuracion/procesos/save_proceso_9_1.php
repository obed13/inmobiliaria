<?php
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $reporte_mensual    = $_POST['reporte_mensual'];
    $fecha_inicio       = date ( 'Y-m-d');
    $id = $_POST['id_user'];


    $sqls = 'UPDATE campana SET reporte_mensual="'.$reporte_mensual.'" WHERE id_cartera="'.$id_cartera.'" AND campana="2" ';

    $ruta = $conexion->query($sqls);

    if ($ruta) {
      header("Location:../proceso.php?id=$id_cartera&proceso=9.1");
    } else {
      header("Location:../proceso.php?id=$id_cartera&proceso=9.1&msj=1");
    }
?>