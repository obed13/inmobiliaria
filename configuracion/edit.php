<?php
  session_start();
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();

  $id_user = $_GET['id'];
  $sql = "
          select
            a.id_user,
            a.id_cat,
            a.nombre,
            a.ap_paterno,
            a.ap_materno,
            a.correo,
            a.password
          from
            usuario a
          where a.id_user = '".$id_user."'
        ";
  $user_proceso = $conexion->query($sql);
  while ($row = $user_proceso->fetch_array()) {
    $nombre     = $row['nombre'];
    $ap_paterno = $row['ap_paterno'];
    $ap_materno = $row['ap_materno'];
    $correo     = $row['correo'];
    $id_cat     = $row['id_cat'];
    $id         = $row['id_user'];
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

    <title>.: Editar Usuario :.</title>

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
              <label for="nombre_edit">Nombre:</label>
              <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
              <label for="paterno_edit">Apellido Paterno:</label>
              <input type="text" class="form-control" name="paterno_edit" id="paterno_edit" value="<?php echo $ap_paterno; ?>">
            </div>
            <div class="form-group">
              <label for="materno_edit">Apellido Materno:</label>
              <input type="text" class="form-control" name="materno_edit" id="materno_edit" value="<?php echo $ap_materno; ?>">
            </div>
            <div class="form-group">
              <label for="cat_edit">Categoria:</label>
              <select name="cat_edit" id="cat_edit" class="form-control">
                <?php include_once 'categoria.php'; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="email_edit">Correo:</label>
              <input type="email" class="form-control" name="email_edit" id="email_edit" value="<?php echo $correo; ?>">
            </div>
            <div class="form-group">
              <label for="pass_edit">Password</label>
              <input type="password" class="form-control" name="pass_edit" id="pass_edit" placeholder="Password">
              <input type="hidden" name="id_user" id="id_user" value="<?php echo $id; ?>">
            </div>
            <button type="submit" id="submit_edit" class="btn btn-primary">Guardar</button>
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
          url: 'update.php',
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