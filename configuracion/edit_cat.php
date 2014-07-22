<?php 
  session_start(); 
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();

  $id_cat = $_GET['id'];
  $sql = "
          select
            b.id_cat,
            b.nom_cat
          from
            categoria b
          where b.id_cat = '".$id_cat."'
        ";
  $user_proceso = $conexion->query($sql);
  while ($row = $user_proceso->fetch_array()) {
    $nombre     = $row['nom_cat'];
    $id_cat = $row['id_cat'];
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

    <title>Dashboard Template for Bootstrap</title>

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
        <?php include_once '../menu_bar.php'; ?>
      </div>
    </div>
  </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-2 main">

          <h2 class="sub-header">Editar Categoria</h2>
          <form role="form">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre Categoria:</label>
              <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $nombre; ?>">
              <input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $id_cat; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
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