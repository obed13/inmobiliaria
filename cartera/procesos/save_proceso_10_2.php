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


    $sqlcontrato = "SELECT * FROM proceso_cartera WHERE id_cartera='".$id_cartera."' ";
    $inst = $conexion->query($sqlcontrato);
    $contrato = $inst->fetch_array();

    if ($contrato['nuevo_contrato'] == 'si') {
        $query='SELECT ifnull(max(consec),0)+1 FROM proceso_cartera WHERE id_cartera='.$id_cartera;
        $cons = $conexion->query($query);
        $consec = $cons->fetch_array();
        $sqlnuevo = "INSERT INTO proceso_cartera(id_cartera,consec,nom_cartera,fecha,id_proceso,fecha_inicio,fecha_entrega,comment_preliminar,cita_propiedad,comment_seguimiento,acuerdo_previo
            ,acuerdo_comment) 
                    VALUES ('".$contrato['id_cartera']."','".$consec['consec']."','".$contrato['nom_cartera']."','".$contrato['fecha']."',8,'".$contrato['fecha_inicio']."','".$contrato['fecha_entrega']."'
                        ,'".$contrato['comment_preliminar']."','".$contrato['cita_propiedad']."','".$contrato['comment_seguimiento']."','".$contrato['acuerdo_previo']."','".$contrato['acuerdo_comment']."')";
        $sqlnuevo2 = "INSERT INTO proceso_cartera (precio_dueno,nuevo_precio,precio_sugerido,archivo,revision_cond_preliminar,foto_preliminar,elab_contrato
            ,recabar_firmas,firma_aviso_privacidad,contrato_inicio,contrato_fin,nuevo_contrato,nueva_fecha,recabar_doc_mls,poner_lona,crm) VALUES ('".$contrato['precio_dueno']."','no','".$contrato['precio_sugerido']."','".$contrato['archivo']."','".$contrato['revision_cond_preliminar']."','".$contrato['foto_preliminar']."'
                        ,'".$contrato['elab_contrato']."','".$contrato['recabar_firmas']."','".$contrato['firma_aviso_privacidad']."','".$contrato['contrato_inicio']."','".$contrato['contrato_fin']."'
                        ,'no','".$contrato['nueva_fecha']."','".$contrato['recabar_doc_mls']."','".$contrato['poner_lona']."','".$contrato['crm']."')";

        $access = $conexion->query($sqlnuevo);

        $query2='SELECT ifnull(max(consec),0)+1 FROM campana WHERE id_cartera='.$id_cartera;
        $cons2 = $conexion->query($query2);
        $consec2 = $cons2->fetch_array();
        $sqlcampana = "INSERT INTO campana(id_cartera,consec,id_proceso,campana)VALUES('".$id_cartera."','".$consec2['consec']."','8','1')";
        $campana = $conexion->query($sqlcampana);
    }

    $ruta = $conexion->query($sql);
    $rutas = $conexion->query($sqls);

    if ($ruta) {
      header("Location:../list_cartera.php");
    } else {
      header("Location:../proceso.php?id=$id_cartera&msj=1");
    }
?>