<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$revision_cond_preliminar = $_POST['revision_cond_preliminar'];
    $foto_preliminar = $_POST['foto_preliminar'];
    $criterios_elab_contrato = $_POST['criterios_elab_contrato'];
  	$fecha_inicio = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    $sqlfotos = "SELECT id_cartera FROM fotos WHERE id_cartera='".$id_cartera."' ";
    $verificar = $conexion->query($sqlfotos);
    $row = $verificar->num_rows;
//echo $row;
    if($row > 0){
      if(isset($id_cartera))
      {
        #Funcion de Mensaje para El Encargado del Proceso
        bandeja($id,$id_cartera,3,1);
        #Fin de Funcion

        $sql = 'UPDATE proceso_cartera SET id_proceso="6",revision_cond_preliminar="'.$revision_cond_preliminar.'",foto_preliminar="'.$foto_preliminar.'",criterios_elab_contrato="'.$criterios_elab_contrato.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
        $ruta = $conexion->query($sql);

        if ($ruta) {
          header("Location:../proceso.php?id=$id_cartera");
        } else {
          header("Location:../proceso.php?id=$id_cartera&msj=1");
        }
      } else{
        header("Location:../proceso.php?id=$id_cartera&msj=2");
      }
    }else{
      header("Location:../proceso.php?id=$id_cartera&msj=3");
    }
?>