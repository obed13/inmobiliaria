<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();


  	$id_cartera      = $_POST['id_cartera'];
  	$archivo         = $_FILES['archivo'];
    $precio_dueno    = $_POST['precio_dueno'];
    $precio_sugerido = $_POST['precio_sugerido'];
  	$fecha_inicio    = date ( 'Y-m-d');
    $id = $_POST['id_user'];

    $fecha_entrega = strtotime ( '+3 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

    if ($_FILES['archivo']['name'] == '') {

      #Funcion de Mensaje para El Encargado del Proceso
      bandeja($id,$id_cartera,5,1);
      #Fin de Funcion

      $sql = 'UPDATE proceso_cartera SET id_proceso="5",precio_dueno="'.$precio_dueno.'",precio_sugerido="'.$precio_sugerido.'",fecha_inicio="'.$fecha_inicio.'",fecha_entrega="'.$fecha_entrega.'" WHERE id_cartera="'.$id_cartera.'" ';

      $ruta = $conexion->query($sql);

      if ($ruta) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }elseif ($precio_dueno =='' && $precio_sugerido =='') {

      if ($_FILES["archivo"]["error"] > 0){
        header("Location:../proceso.php?id=$id_cartera&msj=2"); // ocurrio un error
      } else {
        //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
        //y que el tamano del archivo no exceda los 100kb
        $limite_kb = 10000;

        if (isset($_FILES['archivo']['type']) && $_FILES['archivo']['size'] <= $limite_kb * 1024){
          //esta es la ruta donde copiaremos la imagen
          //recuerden que deben crear un directorio con este mismo nombre
          //en el mismo lugar donde se encuentra el archivo subir.php
          $ruta = "archivos/" . $_FILES['archivo']['name'];
          //comprovamos si este archivo existe para no volverlo a copiar.
          //pero si quieren pueden obviar esto si no es necesario.
          //o pueden darle otro nombre para que no sobreescriba el actual.
          if (!file_exists($ruta)){
            //aqui movemos el archivo desde la ruta temporal a nuestra ruta
            //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
            //almacenara true o false
            $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], '../../'.$ruta);
            if ($resultado){

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
              
              $sql = 'UPDATE proceso_cartera SET id_proceso="5",archivo="'.$ruta.'" WHERE id_cartera="'.$id_cartera.'" ';
              $ruta = $conexion->query($sql);

              if ($ruta) {
                header("Location:../proceso.php?id=$id_cartera");
              } else {
                header("Location:index.php?msj=6"); // no se pudo guardar
              }
            } else {
              header("Location:../proceso.php?id=$id_cartera&msj=5"); // error al mover el archivo
            }
          } else {
            header("Location:../proceso.php?id=$id_cartera&msj=3"); // archivo ya existe
          }
        } else {
          header("Location:../proceso.php?id=$id_cartera&msj=4"); // archivo no permitido execede de tamano
        }
      }
    }else{
      header("Location:../proceso.php?id=$id_cartera&msj=1"); // campos vacios
    }
?>