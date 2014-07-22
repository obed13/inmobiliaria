<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$comment_preliminar = $_POST['comment_preliminar'];
  	$cita_propiedad = $_POST['cita_propiedad'];
  	$comment_seguimiento = $_POST['comment_seguimiento'];
  	$fecha_inicio = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    if ($comment_seguimiento == "") {
      $sql = 'UPDATE proceso_cartera SET id_proceso="2",fecha_inicio="'.$fecha_inicio.'", fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE proceso_cartera SET comment_preliminar="'.$comment_preliminar.'",cita_propiedad="'.$cita_propiedad.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);
      $rutas = $conexion->query($sql2);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:index.php?msj=1");
      }
    }else{
      $fecha_entrega = strtotime ( '+2 day' , strtotime ( $fecha_inicio ) ) ;
      $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

      $sql = 'UPDATE proceso_cartera SET id_proceso="2.1",fecha_inicio="'.$fecha_inicio.'", fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE proceso_cartera SET comment_preliminar="'.$comment_preliminar.'",cita_propiedad="'.$cita_propiedad.'", comment_seguimiento="'.$comment_seguimiento.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);
      $rutas = $conexion->query($sql2);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:index.php?msj=1");
      }
    }
?>