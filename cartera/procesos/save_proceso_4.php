<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera      = $_POST['id_cartera'];
  	$archivo         = $_FILES['archivo'];
    $precio_dueno    = $_POST['precio_dueno'];
    $precio_sugerido = $_POST['precio_sugerido'];
  	$fecha_inicio    = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+3 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $carpeta = "archivos/";
    opendir($carpeta);
    $destino = $carpeta.$_FILES['archivo']['name'];

    if(isset($_FILES['archivo']['tmp_name']))
    {
      copy($_FILES['archivo']['tmp_name'], '../../archivos/');
    } else{
      header("Location:../proceso.php?id=$id_cartera&msj=2");
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
      bandeja($id,$id_cartera,2,1);
      #Fin de Funcion
      $sqls = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$ruta.'", precio_dueno="'.$precio_dueno.'",precio_sugerido="'.$precio_sugerido.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);

      $sql = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$ruta.'" WHERE id_cartera="'.$id_cartera.'" ';
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=6"); // no se pudo guardar
      }
?>