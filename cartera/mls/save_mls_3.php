<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera = $_POST['id_cartera'];
  	$c1 = $_POST['c1'];
  	$c2 = $_POST['c2'];
  	$c3 = $_POST['c3'];
  	$c4 = $_POST['c4'];
  	$c5 = $_POST['c5'];


    if ($c1 == "") {
      $sql = 'UPDATE mls SET c2="'.$c2.'", c3="'.$c3.'", c4="'.$c4.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($c2 == ""){

      $sql = 'UPDATE mls SET c1="'.$c1.'", c3="'.$c3.'", c4="'.$c4.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($c3 == ""){

      $sql = 'UPDATE mls SET c1="'.$c1.'", c2="'.$c2.'", c4="'.$c4.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($c4 == ""){

      $sql = 'UPDATE mls SET c1="'.$c1.'", c2="'.$c2.'", c3="'.$c3.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }elseif($c5 == ""){

      $sql = 'UPDATE mls SET c1="'.$c1.'", c2="'.$c2.'", c3="'.$c3.'", c4="'.$c4.'" WHERE id_cartera="'.$id_cartera.'" ';
      
      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../mls.php?id=$id_cartera");
      } else {
        header("Location:../mls.php?id=$id_cartera&msj=1");
      }
    }else{
    	$sql = 'UPDATE mls SET c1="'.$c1.'", c2="'.$c2.'", c3="'.$c3.'", c4="'.$c4.'", c5="'.$c5.'" WHERE id_cartera="'.$id_cartera.'" ';
      	$ruta = $conexion->query($sql);

      	$sql2 = 'UPDATE proceso_cartera SET recabar_doc_mls="1" WHERE id_cartera="'.$id_cartera.'" ';
      	$rutas = $conexion->query($sql2);


	    if ($ruta) {
	       header("Location:../list_cartera.php");
	    } else {
	       header("Location:../mls.php?id=$id_cartera&msj=1");
	    }

    }
?>