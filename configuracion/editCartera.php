<?php
  session_start();
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();

  $id = $_GET['id'];
  $sql = " SELECT a.id_cartera, a.nom_cartera FROM proceso_cartera a WHERE a.id_cartera='".$id."' ";
  $cartera = $conexion->query($sql);

  if ($row = $cartera->fetch_array()) {
    $id_cartera = $row['id_cartera'];
    $nom_cartera = $row['nom_cartera'];
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

    <title>.: Editar Cartera :.</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
        <div class="col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-2 main">

          <h2 class="sub-header">Bienvenido Administrador</h2>
          <form role="form" action="update.php" name="form_edit" id="form_edit" method="POST">
            <div class="form-group">
              <label for="nom_cartera">Nombre de Cartera:</label>
              <input type="text" class="form-control" name="nom_cartera" id="nom_cartera" value="<?php echo $nom_cartera; ?>">
              <input type="hidden" name="id_cartera" value="<?php echo $id_cartera; ?>" >
            </div>
            <button type="submit" id="submit_edit" class="btn btn-primary">Editar</button>
            <div id="result"></div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
    $(function() {
      $("#submit_edit").on('click', function(e) {
        e.preventDefault();
        /* Act on the event */
        if ($("#nombre_edit").val() == "" || $("#paterno_edit").val() == "" || $("#materno_edit").val() == "" || $("#cat_edit").val() == "" || $("#email_edit").val() == "") {
            $("#result").html("<div class='alert alert-danger'>Hay un Campo Vacio que es Obligatorio!!</div>");
        }

        var datos = $("#form_edit").serialize();

        $.ajax({
          url: 'updateCatera.php',
          type: 'POST',
          dataType: 'json',
          data: datos,
          success: function (data) {
            if(data.msj == true) {
              $("#result").html("<div class='alert alert-success'>Se Modifico Exitosamente!</div>");
              //$("#result").html("<div class='alert alert-success'>Logeado!</div>");
            }else{
              $("#result").html("<div class='alert alert-danger'>Intente mas tarde!</div>");
            }
          },
          beforeSend: function(){
            $("#result").html("<div class='alert-info form-control'><img src='../img/ajax-loader.gif' /> Loading...</div>");
          }
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          $("#result").html("<div class='alert alert-danger'>Error!!</div>");
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

      });
    });
    </script>
  </body>
</html>