<?php 
	error_reporting(E_ALL ^ E_NOTICE);
  	session_start(); 
  	require_once '../conexion.php';
    require_once '../sesion.php';
  	$conexion = conectar();

  	$id = $_GET['id'];

  	$sql = "SELECT id_cartera,nom_cartera,id_proceso FROM proceso_cartera WHERE id_cartera='$id' ";
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
	<title>.: Proceso :.</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
	<?php include_once 'menu_bar.php'; ?>
	
	<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Cartera: <?php echo $cartera['nom_cartera'];?></h2>
          <?php include($contenido); ?>
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