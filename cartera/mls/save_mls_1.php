<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$a2 = $_POST['a2'];
  	$a3 = $_POST['a3'];
  	$a4 = $_POST['a4'];
  	$a5 = $_POST['a5'];
  	$a6 = $_POST['a6'];
  	$a7 = $_POST['a7'];
  	$a8 = $_POST['a8'];
  	$a9 = $_POST['a9'];
  	$a10 = $_POST['a10'];
  	$a11 = $_POST['a11'];


    if($a2 == ""){

      $sql = 'UPDATE mls SET a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a3 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a4 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a5 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a6 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a7 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a8 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a9 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a10 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($a11 == ""){

      $sql = 'UPDATE mls SET a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }

    }else{

    	  $sql = 'UPDATE mls SET id_proceso_mls="2", a2="'.$a2.'", a3="'.$a3.'", a4="'.$a4.'", a5="'.$a5.'", a6="'.$a6.'", a7="'.$a7.'", a8="'.$a8.'", a9="'.$a9.'", a10="'.$a10.'", a11="'.$a11.'" WHERE id_cartera="'.$id_cartera.'" ';
      	$sqls = 'UPDATE proceso_cartera SET recabar_doc_mls="2" WHERE id_cartera="'.$id_cartera.'" ';
        $ruta = $conexion->query($sql);
        $rutas = $conexion->query($sqls);

	    if ($ruta) {
	       header("Location:../mls.php?id=$id_cartera");
	    } else {
	       header("Location:../mls.php?id=$id_cartera&msj=1");
	    }

    }
?>