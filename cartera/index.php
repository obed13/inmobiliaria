<?php 
  session_start(); 
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.: Inmobiliaria :.</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap-cerulean.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/opa-icons.css">
</head>
<body>

   <?php include_once 'menu_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <!--<div class="col-sm-3 col-md-2 sidebar">
          <?php //include_once 'menu.php'; ?>
        </div>-->
        <div class="col-xs-12 col-md-12 main">
          <h2 class="sub-header">Cartera</h2>  
            <div class="sortable row-fluid ui-sortable">
              <div class="row">
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="6 new members." class="well span3 top-block" href="cartera_add.php">
                <span class="icon32 icon-color icon-contacts"></span>
                <div>Crear Cartera</div>
                <div></div>
                <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                <!--<div>507</div>-->
                <!--<span class="notification">6</span>-->
              </a>
              </div>
              <?php  
                $sql = "SELECT id_cartera FROM proceso_cartera where estatus = 0";

                $inst = $conexion->query($sql);
                $num = $inst->num_rows;
                $row = $inst->fetch_array();
              ?>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="<?php if ($row['id_cartera']) { echo $num." Cartera"; } ?>" class="well span3 top-block" href="list_cartera.php">
                <span class="icon32 icon-color icon-clipboard"></span>
                <div>Listado Cartera</div>
                <?php if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
              </a>
              </div>
              <?php  
                $sql2 = "SELECT id_cartera FROM proceso_cartera where estatus = 1";

                $inst2 = $conexion->query($sql2);
                $num2 = $inst2->num_rows;
                $row2 = $inst2->fetch_array();
              ?>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="<?php if ($row['id_cartera']) { echo $num2." Cartera Completadas"; } ?>" class="well span3 top-block" href="list_success.php">
                <span class="icon32 icon-color icon-check"></span>
                <div>Completadas</div>
                <?php if ($row2['id_cartera']) { echo "<div>".$num2."</div>"; } ?>
              </a>
              </div>
              <?php  
                $sql3 = "SELECT id_cartera FROM proceso_cartera where estatus = 2";

                $inst3 = $conexion->query($sql3);
                $num3 = $inst3->num_rows;
                $row3 = $inst3->fetch_array();
              ?>
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" title="<?php if ($row['id_cartera']) { echo $num3." Cartera Canceladas"; } ?>" class="well span3 top-block" href="list_cancel.php">
                <span class="icon32 icon-color icon-cancel"></span>
                <div>Canceladas</div>
                <?php if ($row3['id_cartera']) { echo "<div>".$num3."</div>"; } ?>
              </a>
              </div>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>