<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$revision_cond_preliminar = $_POST['revision_cond_preliminar'];
    $foto_preliminar = $_POST['foto_preliminar'];
    $elab_contrato = $_POST['elab_contrato'];
  	$fecha_inicio = $_POST['fecha_entrega'];

    $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

  	$sql = 'UPDATE proceso_cartera SET id_proceso="6",revision_cond_preliminar="'.$revision_cond_preliminar.'",foto_preliminar="'.$foto_preliminar.'",elab_contrato="'.$elab_contrato.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		header("Location:../proceso.php?id=$id_cartera");
  	} else {
  		header("Location:index.php?msj=1");
  	}
?>