<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$acuerdo_previo = $_POST['acuerdo_previo'];
    $acuerdo_comment = $_POST['acuerdo_comment'];
  	$fecha_inicio = date ( 'Y-m-d');
    $id = $_POST['id_user'];

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

    $fecha_entrega = strtotime ( '+3 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

  	$sql = 'UPDATE proceso_cartera SET id_proceso="4",acuerdo_previo="'.$acuerdo_previo.'",acuerdo_comment="'.$acuerdo_comment.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

  	$ruta = $conexion->query($sql);

  	if ($ruta) {
  		header("Location:../proceso.php?id=$id_cartera");
  	} else {
  		header("Location:index.php?msj=1");
  	}
?>