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
                <div>Listado Disponible</div>
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
              <div class="col-xs-12 col-md-3">
              <a data-rel="tooltip" class="well span3 top-block"data-toggle='modal' data-target='.reporte' href="javascript:void(0)">
                <span class="icon32 icon-color icon-pdf"></span>
                <div>Reporte de Carteras</div>
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
<!--  Inicio Dialogo Reporte -->
<div class="modal fade reporte" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reporte de Mes</h4>
      </div>
      <div class="modal-body">
          <form action="pdf/reporte.php" method="GET" id="reporteAct" name="reporteAct" target="_blank" >
            <label for="mes">Mes:</label>
            <br>
            <select name="mes" id="mes" class="form-control" required>
              <option value="01">Enero</option>
              <option value="02">Febrero</option>
              <option value="03">Marzo</option>
              <option value="04">Abril</option>
              <option value="05">Mayo</option>
              <option value="06">Junio</option>
              <option value="07">Julio</option>
              <option value="08">Agosto</option>
              <option value="09">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>
            <br>
            <label for="ano">Año:</label>
            <br>
            <select name="ano" id="ano" class="form-control" required>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" value="Aceptar">
          </form>
      </div>
    </div>
  </div>
</div>