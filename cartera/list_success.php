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
  <link rel="stylesheet" href="../css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../css/ui-lightness/jquery-ui.css">
  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap.js"></script>
</head>
<body>
    <?php include_once 'menu_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Listado</h2>
          <div class="table-responsive">
            <div id="table_lista_carteras"></div>
            <!--<table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre de Cartera</th>
                  <th>Fecha</th>
                  <th>Estatus</th>
                  <th>Estatus MLS</th>
                  <th>Reporte</th>
                  <th>Restaurar</th>
                </tr>
              </thead>
              <tbody>
          <?php  
          $sql = "SELECT 
                    DATE_FORMAT(a.fecha, '%d-%m-%Y') fecha, 
                    a.nom_cartera, 
                    a.id_cartera,
                    a.estatus,
                    a.recabar_doc_mls
                  FROM 
                    proceso_cartera a
                  where estatus='1' ";
          $resultado = $conexion->query($sql);
          $no = 0;
          while ($row = $resultado->fetch_array()) {
            $no++;
          ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nom_cartera']; ?></td>
                  <td><?php echo $row['fecha']; ?></td>
                  <td><?php if ($row['estatus']==1) { echo "<label class='label label-success'>Completado</label>"; } ?></td>
                  <td><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; } ?></td>
                  <td><a href='pdf/index.php?id=<?php echo $row['id_cartera']; ?>' target='_blank' class='btn btn-danger btn-sm'>Reporte</a></td>
                  <td><a href="#" id="status" class='btn btn-warning btn-sm'>Status</a></td>
                </tr>
          <?php } ?>
              </tbody>
            </table>-->
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<script type="text/javascript">
$(function() {
  $.ajax({
    url: 'ajaxListSuccess.php',
    type: 'POST',
    dataType: 'json',
    async: false,
    cache: false,
    success: function(data){
          var html = "";
          var num = 0;
          html ="<table border='0' class='table table-striped' id='table_cartera'>";
          html +="<thead><tr><th>#</th><th>Cartera</th><th>Fecha</th><th>Estatus</th><th>Estatus MLS</th><th>Reporte</th><th>Restaurar</th></tr></thead><tbody>";
          for (i = 0; i < data.data.length; i++) {
            if (data.data[i].estatus == 1) {promesa ="<label class='label label-success'>Completado</label>"; }
            if (data.data[i].recabar_doc_mls==3) { recabar_doc_mls = "<label class='label label-info'>MLS Express</label>"; }else if (data.data[i].recabar_doc_mls==2) { recabar_doc_mls = "<label class='label label-danger'>MLS (No Terminado)</label>"; }else if (data.data[i].recabar_doc_mls==1) { recabar_doc_mls = "<label class='label label-success'>MLS</label>"; }else { recabar_doc_mls = ""; }
            num++;
            html += "<tr class='lista' id_cartera='"+data.data[i].id_cartera+"' nom_cartera='"+data.data[i].nom_cartera+"' fecha='"+data.data[i].fecha+"' recabar_doc_mls='"+data.data[i].recabar_doc_mls+"' estatus='"+data.data[i].estatus+"'  >";
            html += "<td>" + num + "</td>";
            html += "<td>" + data.data[i].nom_cartera + "</td>";
            html += "<td>" + data.data[i].fecha + "</td>";
            html += "<td>" + promesa +"</td>";
            html += "<td>" + recabar_doc_mls + "</td>";
            html += "<td><a href='pdf/index.php?id=" + data.data[i].id_cartera + "' target='_blank' class='btn btn-danger btn-sm'>Reporte</a></td>";
            html += "<td><a href='status.php?id=" + data.data[i].id_cartera + "'' id='status' class='btn btn-warning btn-sm'>Status</a></td>";
            html += "</tr>";
          }
          html += "</tbody></table>";
          $("#table_lista_carteras").html(html);
          $(".lista").on('click', function() {

          id_cartera   = $(this).attr("id_cartera");

          //$("#id_carteraPromesa").val(id_cartera);

        });
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
//====================================================================================
  $("#status").on('click', function(e) {
    e.preventDefault();
    /* Act on the event */
    $.ajax({
      url: 'status.php',
      type: 'POST',
      dataType: 'json',
      data: {id_cartera: id_cartera},
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
});
</script>