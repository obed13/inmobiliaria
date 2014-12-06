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
          <h2 class="sub-header">Bienvenido </h2>
            <div class="col-md-4 col-md-offset-4" style="border:1px solid #212121;border-radius:.5em;">
            <form action="save_cartera.php" method="POST" name="form_post" id="form_post">
              <label for="nom_producto">Nueva Cartera:</label>
              <br>
              <input type="text" class="form-control" name="nom_cartera" id="nom_cartera" placeholder="Cartera Nueva">
              <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['uid']; ?>">
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
    <script>
    $(function() {
      $("#btn-submit").on('click', function(e) {
        e.preventDefault();
        /* Act on the event */
        if ($("#nom_cartera").val() == '' ) {
          $("#result").html("<div class='alert alert-danger'>Favor de Verificar El Campo Esta Vacio!!</div>")
        }else{
          var datos = $("#form_post").serialize();

          $.ajax({
            url: 'save_cartera.php',
            type: 'POST',
            dataType: 'json',
            data: datos,
            success: function (data) {
            if(data.msj == 1) {
              $("#nom_cartera").val('');
              $("#result").html("<div class='alert alert-success'>Se Guardo Exitosamente!</div><br /><a href='proceso.php?id="+ data.id_cartera +"' class='btn btn-warning'>ir a Proceso</a>");
            }else if(data.msj == 3) {
              $("#nom_cartera").val('');
              $("#result").html("<div class='alert alert-warning'>Este <b>Nombre YA EXISTE</b> Favor de Cambiarlo!</div>");
            }else{
              $("#result").html("<div class='alert alert-danger'>No se pudo Guardar!</div>");
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
          
        }
      });
    });
    </script>
</body>
</html>