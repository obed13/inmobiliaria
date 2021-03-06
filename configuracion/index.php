<?php
  session_start();
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();
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

    <title>Listado de Usuarios</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

          <h2 class="sub-header">Bienvenido Administrador</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre de Usuario</th>
                  <th>Correo</th>
                  <th>Categoria</th>
                  <th colspan="2">Accion</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $sql = "select
                    a.id_user,
                    concat(a.nombre,' ',a.ap_paterno) as nombres,
                    a.correo,
                    b.id_cat,
                    b.nom_cat
                  from
                    usuario a,
                    categoria b
                  where
                    a.id_cat = b.id_cat";
          $resultado = $conexion->query($sql);
          $no = 0;
          while ($row = $resultado->fetch_array()) {
            $no++;
          ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nombres']; ?></td>
                  <td><?php echo $row['correo']; ?></td>
                  <td>
                    <?php
                      if ($row['id_cat'] == 1) {
                        echo "<label class='label label-success'>Administrador</label>";
                      }elseif ($row['id_cat'] == 2) {
                        echo "<label class='label label-warning'>Ventas</label>";
                      }elseif ($row['id_cat'] == 3) {
                        echo "<label class='label label-warning'>SClientes</label>";
                      }elseif ($row['id_cat'] == 4) {
                        echo "<label class='label label-warning'>Tramites</label>";
                      } ?>
                  </td>
                  <td><a href="edit.php?id=<?php echo $row['id_user']; ?>" class="btn btn-info">Editar</a></td>
                  <td><a href="detele.php?id=<?php echo $row['id_user']; ?>" class="btn btn-danger">Eliminar</a> </td>
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