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
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php include_once 'menu_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Listado</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre de Cartera</th>
                  <th>Fecha</th>
                  <th>Estatus</th>
                  <th>Estatus MLS</th>
                </tr>
              </thead>
              <tbody>
          <?php  
          $sql = "SELECT 
                    DATE_FORMAT(a.fecha, '%d-%m-%Y') fecha, 
                    a.nom_cartera, 
                    a.id_cartera,
                    a.estatus,
                    a.recabar_doc_mls
                  FROM 
                    proceso_cartera a
                  where estatus='1' ";
          $resultado = $conexion->query($sql);
          $no = 0;
          while ($row = $resultado->fetch_array()) {
            $no++;
          ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nom_cartera']; ?></td>
                  <td><?php echo $row['fecha']; ?></td>
                  <td><?php if ($row['estatus']==1) { echo "<label class='label label-success'>Completado</label>"; } ?></td>
                  <td><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; }else{echo "<label class='label label-info'>MLS Express</label>";} ?></td>
                </tr>
          <?php } ?>
              </tbody>
            </table>
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