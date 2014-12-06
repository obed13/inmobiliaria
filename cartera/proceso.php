<?php
	error_reporting(E_ALL ^ E_NOTICE);
  	session_start();
  	require_once '../conexion.php';
    require_once '../sesion.php';
  	$conexion = conectar();

  	$id = $_GET['id'];

  	$sql = "
      SELECT 
        a.id_cartera
        ,a.nom_cartera
        ,a.id_proceso 
        ,b.id_cat
        ,c.nom_cat
        ,concat(d.nombre, ' ', d.ap_paterno) as nombre
      FROM 
        proceso_cartera a
        ,procesos b
        ,categoria c
        ,usuario d
      WHERE 
        a.id_cartera='$id'
      and
        a.id_proceso = b.id_proceso
      and
        b.id_cat = c.id_cat
      and
        c.id_cat = d.id_cat
    ";
  	$proceso = $conexion->query($sql);
  	$cartera = $proceso->fetch_array();
  	$op = $cartera['id_proceso'];
	  include_once 'ruta_proceso.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>.: Proceso :.</title>
	<link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/estilo.css">
<!-- JavaScript -->
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.deskform.js"></script>

</head>
<body>
	<?php include_once 'menu_bar.php'; ?>
  <script>
    $(document).ready(function() {
      $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
      });
    });
  </script>
	<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-md-10 col-md-offset-2 main">
          <h3 class="sub-header">Cartera: <?php echo $cartera['nom_cartera'];?> <i class="pull-right">Encargado: <?php echo $cartera['nom_cat'];?></i></h3>
          <?php include($contenido); ?>
        </div>
      </div>
    </div>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>