<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$revision_cond_preliminar = $_POST['revision_cond_preliminar'];
    $foto_preliminar = $_POST['foto_preliminar'];
    $elab_contrato = $_POST['elab_contrato'];
  	$fecha_inicio = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $carpeta = "fotos/";
    opendir($carpeta);
    $destino = $carpeta.$_FILES['foto']['name'];
    if(copy($_FILES['foto']['tmp_name'], '../../'.$destino))
    {
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

      $sql = 'UPDATE proceso_cartera SET id_proceso="6",revision_cond_preliminar="'.$revision_cond_preliminar.'",foto_preliminar="'.$foto_preliminar.'",foto_archivo="'.$destino.'",elab_contrato="'.$elab_contrato.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    } else{
      header("Location:../proceso.php?id=$id_cartera&msj=2");
    }
?>