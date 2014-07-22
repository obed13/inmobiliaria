<?php 
  session_start(); 
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();
  $id = $_GET['id'];
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
        <div class="col-sm-9 col-sm-offset-3 col-md-3  col-md-offset-2 main">
          <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Nuevo Contrato:</div>
          <div id="result"></div>
          <form action="update_contrato.php" method="POST" id="form_contrato">
          <table class="table">
            <tr>
              <td align="center"><label for="fecha_inicio">Fecha Inicio:</label></td>
            </tr>
            <tr>
              <td align="center"><input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio"></td>
            </tr>
            <tr>
              <td align="center"><label for="fecha_fin">Fecha Final:</label></td>
            </tr>
            <tr>
              <td align="center">
                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                <input type="hidden" name="id_cartera" value="<?php echo $id; ?>">
              </td>
            </tr>
          </table>
          <div class="panel-footer"><input type="submit" class="btn btn-primary" id="btn_contrato" value="Cambiar Contrato"></div>
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

      $("#btn_contrato").on('click', function(e) {
        e.preventDefault();
        /* Act on the event */
        if ($("#fecha_inicio").val() == '' || $("#fecha_fin").val() == '') {
          $("#result").html("<div class='alert alert-danger'>Hay un Campo Vacio!!</div>");
        }else{ 
          var datos = $("#form_contrato").serialize();

          $.ajax({
            url: 'update_contrato.php',
            type: 'POST',
            dataType: 'json',
            data: datos,
            success: function (data) {
              if(data.msj == true) {
                $("#result").html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
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