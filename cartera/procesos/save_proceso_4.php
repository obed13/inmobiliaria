<?php
	  require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera      = $_POST['id_cartera'];
  	$archivo         = $_FILES['archivo'];
    $precio_dueno    = $_POST['precio_dueno'];
    $precio_sugerido = $_POST['precio_sugerido'];
    $moneda = $_POST['moneda'];
  	$fecha_inicio    = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+3 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $carpeta = "archivos/";
    //opendir($carpeta);
    $destino = $carpeta.$_FILES['archivo']['name'];
//echo $_FILES['archivo']['name'].' '.$_FILES['archivo']['tmp_name'];
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], '../../'.$destino)) {

     #Funcion de Mensaje para El Encargado del Proceso
      bandeja($id,$id_cartera,2,1);
      #Fin de Funcion
      $sql = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$destino.'", moneda="'.$moneda.'", precio_dueno="'.$precio_dueno.'",precio_sugerido="'.$precio_sugerido.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $ruta = $conexion->query($sql);

      //$sql = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$ruta.'" WHERE id_cartera="'.$id_cartera.'" ';
      //$ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=6"); // no se pudo guardar
      }
    } else{
      #Funcion de Mensaje para El Encargado del Proceso
      bandeja($id,$id_cartera,2,1);
      #Fin de Funcion
      $sql = 'UPDATE proceso_cartera SET id_proceso="5",precio_dueno="'.$precio_dueno.'", moneda="'.$moneda.'", precio_sugerido="'.$precio_sugerido.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $ruta = $conexion->query($sql);

      //$sql = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$ruta.'" WHERE id_cartera="'.$id_cartera.'" ';
      //$ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=6"); // no se pudo guardar
      }
    }

//var_dump($_POST,$_FILES);
?>