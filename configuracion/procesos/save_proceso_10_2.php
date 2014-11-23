<?php
    require_once '../../conexion.php';
    $conexion = conectar();


    $id_cartera         = $_POST['id_cartera'];
    $acuerdo_reporte    = $_POST['acuerdo_reporte'];
    $fecha_inicio       = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+10 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqlcontrato = "SELECT nuevo_contrato,contrato_inicio,contrato_fin,nueva_fecha FROM proceso_cartera WHERE id_cartera='".$id_cartera."' ";
    $inst = $conexion->query($sqlcontrato);
    $contrato = $inst->fetch_array();

    if ($contrato['nuevo_contrato'] == 'si' && $contrato['nueva_fecha'] >= $contrato['contrato_inicio'] ) {
        header("Location:../proceso.php?id=$id_cartera&msj=2");
    } else {

        $sqls = 'UPDATE campana SET id_proceso="10.2",acuerdo_reporte="'.$acuerdo_reporte.'" WHERE id_cartera="'.$id_cartera.'" AND campana="3" ';

        $sql = 'UPDATE proceso_cartera SET id_proceso="10.2",estatus="1",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'"  WHERE id_cartera="'.$id_cartera.'" ';

         $ruta = $conexion->query($sql);
        $rutas = $conexion->query($sqls);

        if ($ruta) {
            #Funcion de Mensaje para El Encargado del Proceso
            bandeja($id,$id_cartera,3,1,4);
            #Fin de Funcion
          header("Location:../list_cartera.php");
        } else {
          header("Location:../proceso.php?id=$id_cartera&msj=1");
        }
    }

   /* if (isset($contrato['nuevo_contrato']) == 'si') {

        $query = "UPDATE proceso_cartera SET id_proceso='8',nuevo_contrato='no',estatus='0' WHERE id_cartera='".$id_cartera."' ";
        $cons = $conexion->query($query);

        $query2='SELECT ifnull(max(consec),0)+1 FROM campana WHERE id_cartera='.$id_cartera;
        $cons2 = $conexion->query($query2);
        $consec2 = $cons2->fetch_array();
        $sqlcampana = "INSERT INTO campana(id_cartera,consec,id_proceso,campana)VALUES('".$id_cartera."','".$consec2['consec']."','8','1')";
        $campana = $conexion->query($sqlcampana);
    }*/


?>