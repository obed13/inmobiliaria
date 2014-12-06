<?php
  session_start();
  require_once 'conexion.php';
  require_once 'sesion.php';
  $conexion = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.: Inmobiliaria :.</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/opa-icons.css">
</head>
<body>
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Inmobiliaria</a>
      </div>
      <div class="navbar-collapse collapse">
        <?php include_once 'menu_bar.php'; ?>
      </div>
    </div>
  </div>

    <div class="container-fluid">
      <div class="row">
        <!--<div class="col-sm-3 col-md-2 sidebar">
          <?php //include_once 'menu.php'; ?>
        </div>-->
        <div class="col-xs-12 col-md-12 main">
          <h2 class="sub-header">Bienvenido</h2>  
            <div class="sortable row-fluid">
            <div class="row">
              <?php  
                $sql = "SELECT id_cartera FROM proceso_cartera";

                $inst = $conexion->query($sql);
                $num = $inst->num_rows;
                $row = $inst->fetch_array();
              ?>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="<?php if ($row['id_cartera']) { echo $num." Cartera Creadas"; } ?>" class="well span3 top-block " href="cartera/">
                <span class="icon32 icon-color icon-contacts"></span>
                <div>Cartera</div>
                <?php if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                <!--<div>507</div>-->
                <!--<span class="notification">6</span>-->
              </a>
              </div>

                <?php
                  $sql = "select
                            a.id_post,
                            a.post mensaje,
                            DATE_FORMAT(a.fecha, '%d-%m-%Y') fecha,
                            a.id_accion,
                            c.nom_accion,
                            b.id_user,
                            concat(b.nombre,' ',b.ap_paterno)as destinatario,
                            a.id_cartera,
                            d.nom_cartera
                          from
                            post a,
                            usuario b,
                            cat_accion c,
                            proceso_cartera d
                          where
                            a.destinatario = b.id_cat
                          and
                            a.id_accion = c.id_accion
                          and
                            a.id_cartera = d.id_cartera
                          and
                            d.estatus = 0";

                  $inst = $conexion->query($sql);
                  $con = $inst->num_rows;
                  $row2 = $inst->fetch_array();

                ?>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="<?php if ($row2['destinatario']) { echo $con." mensajes"; } ?>" class="well span3 top-block " href="bandeja.php">
                <span class="icon32 icon-color icon-envelope-closed"></span>
                <div>Bandeja</div>
                <?php if ($row2['destinatario']) { echo "<div>".$con."</div>"; } ?>
                <!--<div>25</div>-->
                <?php 
                  if ($row2['destinatario'] == $_SESSION['uid']) { 
                    if ($row2['id_accion'] == 1) {
                      echo "<span class='notification red'>".$con."</span>";
                    } 
                  } 
                ?>
                <!--<span class="notification red">12</span>-->
              </a>
              </div>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="Agenda" class="well span3 top-block " href="agenda.php">
                <span class="icon32 icon-color icon-book"></span>
                <div>Agenda</div>
                <!--<div>507</div>-->
                <!--<span class="notification">6</span>-->
              </a>
              </div>
              <div class="col-xs-12 col-md-3"></div>
            </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/funciones.min.js"></script>
</body>
</html>