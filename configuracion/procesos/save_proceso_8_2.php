<?php  
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $acuerdo_reporte    = $_POST['acuerdo_reporte'];
    $fecha_inicio       = date ( 'Y-m-d');
    $id = $_POST['id_user'];


    $sqls = 'UPDATE campana SET acuerdo_reporte="'.$acuerdo_reporte.'" WHERE id_cartera="'.$id_cartera.'" ';

    $ruta = $conexion->query($sqls);

    if ($ruta) {
      header("Location:../proceso.php?id=$id_cartera&proceso=8.2");
    } else {
      header("Location:../proceso.php?id=$id_cartera&proceso=8.2&msj=1");
    }
?>