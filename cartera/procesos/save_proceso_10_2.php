<?php  
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $acuerdo_reporte    = $_POST['acuerdo_reporte'];
    $fecha_inicio       = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+10 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqls = 'UPDATE campana SET id_proceso="10.2",acuerdo_reporte="'.$acuerdo_reporte.'" WHERE id_cartera="'.$id_cartera.'" AND campana="3" ';

    $sql = 'UPDATE proceso_cartera SET id_proceso="10.2",estatus="1",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';


    $ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);

    if ($ruta) {
      header("Location:../list_cartera.php");
    } else {
      header("Location:../proceso.php?id=$id_cartera&msj=1");
    }
?>