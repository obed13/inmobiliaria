<?php  
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $acuerdo_reporte    = $_POST['acuerdo_reporte'];
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

    $sqls = 'UPDATE campana SET acuerdo_reporte="'.$acuerdo_reporte.'" WHERE id_cartera="'.$id_cartera.'" ';

    $sql = 'UPDATE proceso_cartera SET id_proceso="9",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';

    $query='SELECT ifnull(max(consec),0)+1 FROM campana WHERE id_cartera="'.$id_cartera.'" AND campana="2" ';
    $cons = $conexion->query($query);
    $consec = $cons->fetch_array();
    $sqlcampana = 'INSERT INTO campana(id_cartera,consec,id_proceso,campana)VALUES("'.$id_cartera.'","'.$consec['consec'].'","9","2")';

    $ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);
    $rutacampana = $conexion->query($sqlcampana);

    if ($ruta) {
      header("Location:../proceso.php?id=$id_cartera");
    } else {
      header("Location:../proceso.php?id=$id_cartera&msj=1");
    }
?>