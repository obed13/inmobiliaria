<?php
    require_once '../conexion.php';
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
    $lugar          = $_POST['lugar'];
    $titular        = $_POST['titular'];
    $ve_re          = $_POST['ve_re'];
    $precio         = $_POST['precio'];
    $comision       = $_POST['comision'];
    $descripcion_2  = $_POST['descripcion_2'];
    $meses          = $_POST['meses'];
    $mes_inicio     = $_POST['mes_inicio'];
    $mes_fin        = $_POST['mes_fin'];



      $sql = 'UPDATE datos_inmuebles SET tipo_mueble="'.$tipo_mueble.'",terreno_2="'.$terreno_m.'",dimension_1="'.$dimension_1.'",dimension_2="'.$dimension_2.'",
      construccion_m="'.$construccion_m.'",recamaras="'.$recamaras.'",bano="'.$bano.'",nivel="'.$nivel.'",ampli="'.$ampli.'",excendente="'.$excendente.'",material="'.$material.'",
      resp_1="'.$resp_1.'",resp_2="'.$resp_2.'",resp_3="'.$resp_3.'",luz="'.$luz.'",descripcion_1="'.$descripcion_1.'",lugar="'.$lugar.'",titular="'.$titular.'",ve_re="'.$ve_re.'",
      precio="'.$precio.'",comision="'.$comision.'",descripcion_2="'.$descripcion_2.'",meses="'.$meses.'",mes_inicio="'.$mes_inicio.'",mes_fin="'.$mes_fin.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:inmueble.php?id=$id_cartera");
      } else {
        header("Location:inmueble.php?id=$id_cartera&msj=1");
      }

?>