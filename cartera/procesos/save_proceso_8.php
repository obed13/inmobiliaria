<?php  
	require_once '../../conexion.php';
  	$conexion = conectar();

    // input radio
  	$id_cartera         = $_POST['id_cartera'];
    $fecha_inicio       = date ( 'Y-m-d');
  	$bolsa_ampi         = $_POST['bolsa_ampi'];
    $portal_crm         = $_POST['portal_crm'];
    $revista            = $_POST['revista'];
    $venta_brokers      = $_POST['venta_brokers'];
    $periodico          = $_POST['periodico'];
    $web                = $_POST['web'];
    $letrero            = $_POST['letrero'];
    $redes_sociales     = $_POST['redes_sociales'];
    $evento_open_house  = $_POST['evento_open_house'];

    //input checkbox
    $bolsa_btn      = $_POST['bolsa_ampi_btn'];
    $portal_btn     = $_POST['portal_crm_btn'];
    $revista_btn    = $_POST['revista_btn'];
    $venta_btn      = $_POST['venta_brokers_btn'];
    $periodico_btn  = $_POST['periodico_btn'];
    $web_btn        = $_POST['web_btn'];
    $letrero_btn    = $_POST['letrero_btn'];
    $redes_btn      = $_POST['redes_sociales_btn'];
    $evento_btn     = $_POST['evento_open_house_btn'];

    //input date fecha
    $bolsa_fecha         = $_POST['bolsa_ampi_fecha'];
    $portal_fecha        = $_POST['portal_crm_fecha'];
    $revista_fecha       = $_POST['revista_fecha'];
    $venta_fecha         = $_POST['venta_brokers_fecha'];
    $periodico_fecha     = $_POST['periodico_fecha'];
    $web_fecha           = $_POST['web_fecha'];
    $letrero_fecha       = $_POST['letrero_fecha'];
    $redes_fecha         = $_POST['redes_sociales_fecha'];
    $evento_fecha        = $_POST['evento_open_house_fecha'];
    $id = $_POST['id_user'];



    $fecha_entrega = strtotime ( '+50 day' , strtotime ( $fecha_inicio ) ) ;
    $fecha_entrega = date ( 'Y-m-d' , $fecha_entrega );

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

//=====================================================================================================================//
    if ($bolsa_ampi == '') {
      $sql = 'UPDATE campana SET bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'",periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }

    }elseif ($portal_crm == '') {
      $sql = 'UPDATE campana SET portal_fecha="'.$portal_fecha.'",bolsa_fecha="'.$bolsa_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'",periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }

    }elseif ($revista == '') {
      $sql = 'UPDATE campana SET revista_fecha="'.$revista_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'",periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }

    }elseif ($venta_brokers == '') {
      $sql = 'UPDATE campana SET venta_fecha="'.$venta_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }elseif ($periodico == '') {
      $sql = 'UPDATE campana SET periodico_fecha="'.$periodico_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }elseif ($web == '') {
      $sql = 'UPDATE campana SET web_fecha="'.$web_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }elseif ($letrero == '') {
      $sql = 'UPDATE campana SET letrero_fecha="'.$letrero_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'",web="'.$web.'",web_fecha="'.$web_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }elseif ($redes_sociales == '') {
      $sql = 'UPDATE campana SET redes_fecha="'.$redes_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'",web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }elseif ($evento_open_house == '') {
      $sql = 'UPDATE campana SET evento_fecha="'.$evento_fecha.'",bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'",web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $rutas = $conexion->query($sqls);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);
      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
      
    }else{
      $sql = 'UPDATE campana SET bolsa_ampi="'.$bolsa_ampi.'",bolsa_fecha="'.$bolsa_fecha.'",portal_crm="'.$portal_crm.'",portal_fecha="'.$portal_fecha.'",revista="'.$revista.'",revista_fecha="'.$revista_fecha.'",venta_brokers="'.$venta_brokers.'",venta_fecha="'.$venta_fecha.'",periodico="'.$periodico.'",periodico_fecha="'.$periodico_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqls = 'UPDATE campana SET web="'.$web.'",web_fecha="'.$web_fecha.'",letrero="'.$letrero.'",letrero_fecha="'.$letrero_fecha.'",redes_sociales="'.$redes_sociales.'",redes_fecha="'.$redes_fecha.'",evento_open_house="'.$evento_open_house.'",evento_fecha="'.$evento_fecha.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sqlproceso = 'UPDATE proceso_cartera SET id_proceso="8.1" WHERE id_cartera="'.$id_cartera.'" ';
      $sqlcampana = 'UPDATE campana SET id_proceso="8.1" WHERE id_cartera="'.$id_cartera.'" ';
      $sql2 = 'UPDATE campana SET bolsa_btn="'.$bolsa_btn.'",portal_crm_btn="'.$portal_crm_btn.'",revista_btn="'.$revista_btn.'",venta_btn="'.$venta_btn.'" WHERE id_cartera="'.$id_cartera.'" ';
      $sql3 = 'UPDATE campana SET periodico_btn="'.$periodico_btn.'",web_btn="'.$web_btn.'",letrero_btn="'.$letrero_btn.'",redes_btn="'.$redes_btn.'",evento_btn="'.$evento_btn.'" WHERE id_cartera="'.$id_cartera.'" ';

      $rutas = $conexion->query($sqls);
      $campana = $conexion->query($sqlcampana);
      $rutaproceso = $conexion->query($sqlproceso);
      $ruta2 = $conexion->query($sql2);
      $ruta3 = $conexion->query($sql3);

      if ($ruta = $conexion->query($sql)) {
        header("Location:../proceso.php?id=$id_cartera");
      } else {
        header("Location:../proceso.php?id=$id_cartera&msj=1");
      }
    }
//=====================================================================================================================//

?>