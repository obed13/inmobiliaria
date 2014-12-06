<?php
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
    $fecha_inicio = date ( 'Y-m-d');
  	$a4 = $_POST['a4'];
  	$a6 = $_POST['a6'];
  	$c2 = $_POST['c2'];
  	$c5 = $_POST['c5'];
    $id = $_POST['id_user'];

    if ($a4 == "") {
      $sql = 'UPDATE mls SET a6="'.$a6.'", c2="'.$c2.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $ins =  $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }elseif($a6 == ""){
      $sql = 'UPDATE mls SET a4="'.$a4.'", c2="'.$c2.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $ins =  $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }elseif ($c2 == "") {
      $sql = 'UPDATE mls SET a4="'.$a4.'", a6="'.$a6.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $ins =  $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }elseif ($c5 == "") {
      $sql = 'UPDATE mls SET a4="'.$a4.'", a6="'.$a6.'", c2="'.$c2.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      $ins =  $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }else{

      $sql = 'UPDATE mls SET a4="'.$a4.'", a6="'.$a6.'", c2="'.$c2.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      //$sqls = 'UPDATE proceso_cartera SET id_proceso="8", fecha_inicio="'.$fecha_inicio.'", fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';
      //$sql2 = 'UPDATE proceso_cartera SET recabar_doc_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      //$ins =  $conexion->query($sql2);
      $ruta = $conexion->query($sql);
      //$rutas = $conexion->query($sqls);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera&proceso=7.1");
      } else {
        header("Location:../proceso.php?id=$id_cartera&proceso=7.1&msj=1");
      }
    }
?>