<?php
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $reporte_mensual    = $_POST['reporte_mensual'];
    $fecha_inicio       = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+10 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    #Funcion de Mensaje para El Encargado del Proceso
      #proceso = Encargado
      #2 = 2
      #3 = 2
      #4 = 3
      #5 = 2
      #6 = 3
      #7 = 4
      #8 = 3
      #9 = 3
      #10 = 3
      bandeja($id,$id_cartera,3,1);
      #Fin de Funcion

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