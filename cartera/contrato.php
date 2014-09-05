<?php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();
  $id = $_GET['id'];
  $msj = $_GET['msj'];

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
    if ($msj == 1) {
      $msj = "<div class='alert alert-success'>Se Guardo Exitosamente!</div>";
    } elseif ($msj == 2) {
      $msj = "<div class='alert alert-danger'>Ocurrio un Error con el Archivo!</div>";
    } elseif ($msj == 3) {
      $msj = "<div class='alert alert-danger'>El Archivo ya Existe con el Mismo Nombre!</div>";
    } elseif ($msj == 4) {
      $msj = "<div class='alert alert-danger'>El Archivo No Permite Execedees de Tamaño!</div>";
    } elseif ($msj == 5) {
      $msj = "<div class='alert alert-danger'>Ocurrio Un Error Al Mover el Archivo a la Carpeta!</div>";
    } elseif ($msj == 6) {
      $msj = "<div class='alert alert-danger'>No se Puede Guardar Intente mas Tarde!</div>";
    }

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
        <div class="col-sm-9 col-md-10 col-md-offset-2 main">
          <h3 class="sub-header">Cartera: <?php echo $cartera['nom_cartera'];?></h3>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-3  col-md-offset-2 main">
          <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Nueva Fecha de Contrato:</div>
          <div id="result"><?php echo $msj; ?></div>
          <form action="update_contrato.php" method="POST" id="form_contrato" enctype="multipart/form-data">
          <table class="table">
            <tr>
              <td align="center"><label for="fecha_inicio">Fecha Inicio:</label></td>
            </tr>
            <tr>
              <td align="center"><input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required /></td>
            </tr>
            <tr>
              <td align="center"><label for="fecha_fin">Fecha Final:</label></td>
            </tr>
            <tr>
              <td align="center">
                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required />
                <input type="hidden" name="id_cartera" value="<?php echo $id; ?>">
              </td>
            </tr>
            <tr>
              <td><label for="">Subir Nuevo Archivo de Contrato:</label></td>
            </tr>
            <tr>
              <td>
                <input type="file" name="nvo_contrato" id="nvo_contrato" class="form-control" required />
              </td>
            </tr>
          </table>
          <div class="panel-footer"><input type="submit" class="btn btn-primary" id="btn_contrato" value="Cambiar Contrato" /></div>
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

     /* $("#btn_contrato").on('click', function(e) {
        e.preventDefault();

        if ($("#fecha_inicio").val() == '' || $("#fecha_fin").val() == '' || $("#nvo_contrato").val() == '') {
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
      });*/
    });
    </script>
</body>
</html>