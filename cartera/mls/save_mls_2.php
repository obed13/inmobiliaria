<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$b1 = $_POST['b1'];
  	$b2 = $_POST['b2'];
  	$b3 = $_POST['b3'];
  	$b4 = $_POST['b4'];
  	$b5 = $_POST['b5'];
  	$b6 = $_POST['b6'];


    if ($b1 == "") {
      $sql = 'UPDATE mls SET b2="'.$b2.'", b3="'.$b3.'", b4="'.$b4.'", b5="'.$b5.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($b2 == ""){

      $sql = 'UPDATE mls SET b1="'.$b1.'", b3="'.$b3.'", b4="'.$b4.'", b5="'.$b5.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($b3 == ""){

      $sql = 'UPDATE mls SET b1="'.$b1.'", b2="'.$b2.'", b4="'.$b4.'", b5="'.$b5.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($b4 == ""){

      $sql = 'UPDATE mls SET b1="'.$b1.'", b2="'.$b2.'", b3="'.$b3.'", b5="'.$b5.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($b5 == ""){

      $sql = 'UPDATE mls SET b1="'.$b1.'", b2="'.$b2.'", b3="'.$b3.'", b4="'.$b4.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($b6 == ""){

      $sql = 'UPDATE mls SET b1="'.$b1.'", b2="'.$b2.'", b3="'.$b3.'", b4="'.$b4.'", b5="'.$b5.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }else{
    	$sql = 'UPDATE mls SET b1="'.$b1.'", b2="'.$b2.'", b3="'.$b3.'", b4="'.$b4.'", b5="'.$b5.'", b6="'.$b6.'" WHERE id_cartera="'.$id_cartera.'" ';
      	$ruta = $conexion->query($sql);

      	$sql2 = 'UPDATE mls SET id_proceso_mls="3" WHERE id_cartera="'.$id_cartera.'" ';
      	$rutas = $conexion->query($sql2);


	    if ($ruta) {
	       header("Location:../mls.php?id=$id_cartera");
	    } else {
	       header("Location:../mls.php?id=$id_cartera&msj=1");
	    }

    }
?>