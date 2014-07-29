<?php  
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $acuerdo_reporte    = $_POST['acuerdo_reporte'];
    $fecha_inicio       = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+10 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqls = 'UPDATE campana SET acuerdo_reporte="'.$acuerdo_reporte.'" WHERE id_cartera="'.$id_cartera.'" AND campana="2" ';

    $sql = 'UPDATE proceso_cartera SET id_proceso="10",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';

    $query='SELECT ifnull(max(consec),0)+1 FROM campana WHERE id_cartera="'.$id_cartera.'" AND campana="3" ';
    $cons = $conexion->query($query);
    $consec = $cons->fetch_array();
    $sqlcampana = 'INSERT INTO campana(id_cartera,consec,id_proceso,campana)VALUES("'.$id_cartera.'","'.$consec['consec'].'","10","3")';

    $ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);
    $rutacampana = $conexion->query($sqlcampana);

    if ($ruta) {
      header("Location:../proceso.php?id=$id_cartera");
    } else {
      header("Location:../proceso.php?id=$id_cartera&msj=1");
    }
?>