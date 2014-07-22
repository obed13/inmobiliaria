<?php 
  session_start(); 
  require_once '../conexion.php';
  $conexion = conectar();

  $id_cartera = $_GET['id'];
  $sql = "
          select
            a.id_cartera,
            a.nom_cartera
          from
            proceso_cartera a
          where a.id_cartera = '".$id_cartera."'
        ";
  $proceso = $conexion->query($sql);
  while ($row = $proceso->fetch_array()) {
    $id_cartera  = $row['id_cartera'];
    $nom_cartera = $row['nom_cartera'];
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
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <?php include_once 'menu_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-2 main">
          <h2 class="sub-header">Se Cancelara la Cartera: <?php echo $nom_cartera; ?></h2>
          <div id="result"></div>
          <form action="cancel_cartera.php" id="form_cancel" method="POST" role="form">
            <div class="panel panel-danger">
              <!-- Default panel contents -->
              <div class="panel-heading">Motivo de Cancelacion:</div>
              <table class="table">
                <tr>
                  <td align="center">
                    <textarea name="moti_cancel" id="moti_cancel" cols="40" rows="5" required></textarea>
                    <input type="hidden" name="id_cartera" value="<?php echo $id_cartera; ?>">
                  </td>
                </tr>
              </table>
              <div class="panel-footer"><input type="submit" id="subit_cancel" class="btn btn-danger" value="Cancelar Cartera"></div>
            </div>
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
      $("#subit_cancel").on('click', function(e) {
        e.preventDefault();
        /* Act on the event */
        if ($("#moti_cancel").val() == "") {
          $("#result").html("<div class='alert alert-danger'>No puedes Cancelar sin un comentario de Por que??</div>");
        }else{
          var datos = $("#form_cancel").serialize();

          $.ajax({
            url: 'cancel_cartera.php',
            type: 'POST',
            dataType: 'json',
            data: datos,
            success: function(data){
              if (data.msj == true) {
                window.location ="list_cartera.php";
              }else{
               $("#result").html("<div class='alert alert-danger'>Favor de intentarlo luego</div>"); 
              }
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