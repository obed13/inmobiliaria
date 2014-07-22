<?php  
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $reporte_mensual    = $_POST['reporte_mensual'];
    $fecha_inicio       = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+10 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqls = 'UPDATE campana SET id_proceso="10.2",reporte_mensual="'.$reporte_mensual.'" WHERE id_cartera="'.$id_cartera.'" AND campana="3" ';

    $sql = 'UPDATE proceso_cartera SET id_proceso="10.2",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';

    $ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);

    if ($ruta) {
      header("Location:../proceso.php?id=$id_cartera");
    } else {
      header("Location:../proceso.php?id=$id_cartera&msj=1");
    }
?>