<?php
	require_once '../conexion.php';
  	$conexion = conectar();

  	$inicio  	= $_POST['fecha_inicio'];
  	$fin	 	= $_POST['fecha_fin'];
  	$id_cartera = $_POST['id_cartera'];

    if ($_FILES["nvo_contrato"]["error"] > 0){
        header("Location:contrato.php?id=$id_cartera&msj=2"); // ocurrio un error
      } else {
        //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
        //y que el tamano del archivo no exceda los 100kb
        $limite_kb = 100000;

        if (isset($_FILES['nvo_contrato']['type']) && $_FILES['nvo_contrato']['size'] <= $limite_kb * 1024){
          //esta es la ruta donde copiaremos la imagen
          //recuerden que deben crear un directorio con este mismo nombre
          //en el mismo lugar donde se encuentra el archivo subir.php
          $ruta = "archivos/" . $_FILES['nvo_contrato']['name'];
          $destino = "../archivos/" . $_FILES['nvo_contrato']['name'];
          //comprovamos si este archivo existe para no volverlo a copiar.
          //pero si quieren pueden obviar esto si no es necesario.
          //o pueden darle otro nombre para que no sobreescriba el actual.
          if (!file_exists($destino)){
            //aqui movemos el archivo desde la ruta temporal a nuestra ruta
            //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
            //almacenara true o false
            $resultado = @move_uploaded_file($_FILES["nvo_contrato"]["tmp_name"], '../'.$ruta);
            if ($resultado){
              $sql = "UPDATE proceso_cartera SET contrato_inicio='".$inicio."', contrato_fin='".$fin."',archivo_firma='".$ruta."' WHERE id_cartera='".$id_cartera."' ";
              $ruta = $conexion->query($sql);

              if ($ruta) {
                header("Location:contrato.php?id=$id_cartera&msj=1");
              } else {
                header("Location:contrato.php??id=$id_cartera&msj=6"); // no se pudo guardar
              }
            } else {
              header("Location:contrato.php?id=$id_cartera&msj=5"); // error al mover el archivo
            }
          } else {
            header("Location:contrato.php?id=$id_cartera&msj=3"); // archivo ya existe
          }
        } else {
          header("Location:contrato.php?id=$id_cartera&msj=4"); // archivo no permitido execede de tamano
        }
      }



  	/*if ($ruta) {
  		$result = array('msj' => true);
	} else {
		$result = array('msj' => false );
	}

	echo json_encode($result);*/
?>