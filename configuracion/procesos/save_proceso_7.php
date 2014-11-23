<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera             = $_POST['id_cartera'];
    $poner_lona             = $_POST['poner_lona'];
    $crm                    = $_POST['crm'];
  	$fecha_inicio           = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+3 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqlcount = "SELECT id_cartera FROM campana WHERE id_cartera='".$id_cartera."' ";
    $inst = $conexion->query($sqlcount);
    $existe = $inst->num_rows;
    if ($existe == 0) {
      $sql = "INSERT INTO campana(id_cartera,consec,id_proceso,campana)VALUES('".$id_cartera."','1','8','1')";
      $ruta = $conexion->query($sql);
    }
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
      bandeja($id,$id_cartera,4,1);
      #Fin de Funcion

      //$sql = 'UPDATE proceso_cartera SET id_proceso="7.1",recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET id_proceso="7.1",poner_lona="'.$poner_lona.'",crm="'.$crm.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

      //$ruta = $conexion->query($sql);
      $rutas = $conexion->query($sqls);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
?>