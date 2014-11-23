<?php
	  require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera     = $_POST['id_cartera'];
  	$tipo_mueble    = $_POST['tipo_inmueble'];
  	$terreno_m      = $_POST['terreno_m'];
  	$dimension_1    = $_POST['dimension_1'];
  	$dimension_2    = $_POST['dimension_2'];
    $construccion_m = $_POST['construccion_m'];
    $recamaras      = $_POST['recamaras'];
    $bano           = $_POST['bano'];
    $nivel          = $_POST['nivel'];
    $ampli          = $_POST['ampli'];
    $excendente     = $_POST['excendente'];
    $material       = $_POST['material'];
    $resp_1         = $_POST['resp_1'];
    $resp_2         = $_POST['resp_2'];
    $resp_3         = $_POST['resp_3'];
    $luz            = $_POST['luz'];
    $descripcion_1  = $_POST['descripcion_1'];
    $gravamen       = $_POST['gravamen'];
    $titular        = $_POST['titular'];
    $ve_re          = $_POST['ve_re'];
    $precio         = $_POST['precio'];
    $comision       = $_POST['comision'];
    $descripcion_2  = $_POST['descripcion_2'];
    $meses          = $_POST['meses'];
    $mes_inicio     = $_POST['mes_inicio'];
    $mes_fin        = $_POST['mes_fin'];
    $fecha_inicio   = date ( 'Y-m-d');
    $opcion         = $_POST['opcion'];
    $cantidad       = $_POST['cantidad'];
    $moneda         = $_POST['moneda'];
    $moneda2         = $_POST['moneda2'];
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
      bandeja($id,$id_cartera,2,1);
      #Fin de Funcion

      $fecha_entrega = strtotime ( '+5 day' , strtotime ( $fecha_inicio ) ) ;
      $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

      $sql = 'INSERT INTO datos_inmuebles(id_cartera,tipo_mueble,terreno_2,dimension_1,dimension_2,construccion_m,recamaras,bano,nivel,ampli,excendente,material,resp_1,resp_2,resp_3,luz,descripcion_1,gravamen,opcion,cantidad,moneda,titular,ve_re,precio,moneda2,comision,descripcion_2,meses,mes_inicio,mes_fin) VALUES ("'.$id_cartera.'","'.$tipo_mueble.'","'.$terreno_m.'","'.$dimension_1.'","'.$dimension_2.'","'.$construccion_m.'","'.$recamaras.'","'.$bano.'","'.$nivel.'","'.$ampli.'","'.$excendente.'","'.$material.'","'.$resp_1.'","'.$resp_2.'","'.$resp_3.'","'.$luz.'","'.$descripcion_1.'","'.$gravamen.'","'.$opcion.'","'.$cantidad.'","'.$moneda.'","'.$titular.'","'.$ve_re.'","'.$precio.'","'.$moneda2.'","'.$comision.'","'.$descripcion_2.'","'.$meses.'","'.$mes_inicio.'","'.$mes_fin.'") ';

      $sqls = 'UPDATE proceso_cartera SET id_proceso="3",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);
      $rutas = $conexion->query($sqls);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }

?>