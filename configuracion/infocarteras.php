<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();

  if (isset($_GET['msj']) == 1) {
    $msj = "<div class='alert alert-danger'>Se Elimino Correctamente!!!</div>";
  }
  if (isset($_GET['msj']) == 2){
    $msj = "<div class='alert alert-danger'>No Se Elimino Correctamente!!!</div>";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Listado Carteras</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../css/ui-lightness/jquery-ui.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.js"></script>
    <script>
    $(document).ready(function() {
      $('#table_cartera').dataTable();
    });
    </script>
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
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <h2 class="sub-header">Bienvenido Administrador</h2> <?php echo $msj; ?>
          <div class="table-responsive">
            <table class="table table-striped" id="table_cartera">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cartera</th>
                  <th >Accion</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $sql = "
            select
              a.id_cartera,
              a.nom_cartera
            from
              proceso_cartera a
          ";
          $resultado = $conexion->query($sql);
          $no = 0;
          while ($row = $resultado->fetch_array()) {
            $no++;
          ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nom_cartera']; ?></td>
                  <td><a href="editInfoCartera.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-info">Editar</a></td>
                </tr>
          <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>