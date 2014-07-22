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
          <?php// include_once 'menu.php'; ?>
        </div>-->
        <div class="col-sm-9 col-md-12 main">
          <h2 class="sub-header">Bandeja</h2>
          <div class="table-responsive">
            <div id="bandeja"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(function() {
    	$.ajax({
    		url: 'bandeja_msj.php',
    		type: 'POST',
    		dataType: 'json',
    		success: function (data) {
				var html = "";
            	html ="<table class='table table-striped'>";
	            html +="<thead><tr>";
	            html +="<th>Nombre</th><th>Mensaje</th><th>Cartera</th><th>Fecha de Entrega</th><th colspan='2'>Status</th>";
	            html +="</tr></thead>";
	            for (i = 0; i < data.data.length; i++) {
	              html += "<tbody><tr>";
	              html += "<td>" + data.data[i].destinatario + "</td>";
	              html += "<td>" + data.data[i].mensaje + "</td>";
                html += "<td>" + data.data[i].nom_cartera + "</td>";
	              html += "<td>" + data.data[i].fecha + "</td>";
                if (data.data[i].id_accion == 1) {
                  html += "<td><div class='label label-danger'>" + data.data[i].nom_accion + "</div></td>";
                }else{
                  html += "<td><div class='label label-success'>" + data.data[i].nom_accion + "</div></td>";
                }
                if (data.data[i].id_destinatario == '<?php echo $_SESSION["uid"]; ?>' && data.data[i].id_accion == 1) {
                  html += "<td><a href='acceder.php?id="+data.data[i].id_post+"' class='btn btn-primary'>Ver</a></td>";
                }
	              html += "</tr></tbody>";
	            } 
	            html += "</table>";  
	            $("#bandeja").html(html);
			}
    	})
    	.done(function() {
    		console.log("success");
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    });
    </script>
</body>
</html>