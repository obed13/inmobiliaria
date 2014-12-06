<?php
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $reporte_mensual    = $_POST['reporte_mensual'];
    $fecha_inicio       = date ( 'Y-m-d');
    $id = $_POST['id_user'];


    $sqls = 'UPDATE campana SET reporte_mensual="'.$reporte_mensual.'" WHERE id_cartera="'.$id_cartera.'" ';

    //$sql = 'UPDATE proceso_cartera SET id_proceso="8.2",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';

    //$ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);

    if ($rutas) {
      header("Location:../proceso.php?id=$id_cartera&proceso=8.1");
    } else {
      header("Location:../proceso.php?id=$id_cartera&proceso=8.1&msj=1");
    }
?>