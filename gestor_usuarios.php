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
</head>
<body>

   <?php include_once 'menu_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php //include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Bienvenido Administrador</h2>
            <div class="col-md-4 col-md-offset-4" style="border:1px solid #212121;border-radius:.5em;">
            <form action="save_post.php" method="POST" name="form_post" id="form_post">
              <label for="nom_producto">Nueva Cartera:</label>
              <br>
              <input type="text" class="form-control" name="nom_cartera" id="nom_cartera" placeholder="Cartera Nueva">
              <br>
              <input type="submit" class="btn btn-primary col-md-4 col-md-offset-4" id="btn-submit" value="Aceptar">
              <br>
              <br>
              <div id="result"></div>
              <br>
            </form>
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