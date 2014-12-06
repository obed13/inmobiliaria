<?php
  session_start();
  require_once 'conexion.php';
  require_once 'sesion.php';
  $conexion = conectar();
  $sql ="SELECT * FROM usuario";
  $consulta = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.: Inmobiliaria :.</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.js"></script>
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
        <div class="col-sm-9 col-md-12 main">
          <h2 class="sub-header">Agenda</h2>
          <div class="table-responsive">
          <div id="table_lista_carteras"></div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript">
$(function() {
restaFechas = function(f1,f2)
{
  var aFecha1 = f1.split('-');
  var aFecha2 = f2.split('-');
  var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
  var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
  var dif = fFecha2 - fFecha1;
  var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
  return dias;
}
//var f1 = '10/09/2014';
//var f2='15/10/2014';
//restaFechas(f1,f2);
//=============== Ajax Carteras =========================//
var f = '<?php $hoy = date("Y-m-d"); echo $hoy; ?>';

$.ajax({
  url: 'agenda_msj.php',
  type: 'POST',
  dataType: 'json',
  async: false,
  cache: false,
  success: function(data){
          var html = "";
            html ="<table border='0' class='table table-striped' id='table_cartera'>";
            html +="<thead><tr><th>Encargado</th><th>Nombre Cartera</th><th>Proceso</th><th>Fecha de Entrega</th><th>Status</th></tr></thead><tbody>";
            for (i = 0; i < data.data.length; i++) {
              var fecha = restaFechas(f,data.data[i].fecha_entrega);
              if(fecha <= 0){dias = "<div class='label alert-danger'>"+fecha+" Dias ATRASADO</div>";}else if(fecha == 1){dias = "<div class='label alert-danger'>Te Quedan "+fecha+" Dias</div>";}else if(fecha == 2){dias= "<div class='label alert-danger'>Te Quedan "+fecha+" Dias</div>";}else{dias = fecha+" Dias";}
              if (data.data[i].promesa == 4) {promesa ="<label class='label label-success'>Negociacion</label>";}else if (data.data[i].promesa == 3) {promesa ="<label class='label label-success'>Promesa</label>"; }else if (data.data[i].promesa == 2) {promesa ="<label class='label label-success'>Rentada</label>"; }else if (data.data[i].promesa == 1) {promesa ="<label label class='label-success'>Vendida</label>"; }else { promesa = ""; }
              html += "<tr>";
              html += "<td><label class='label label-warning'>" + data.data[i].nombres + "</label></td>";
              html += "<td>" + data.data[i].nom_cartera + "</td>";
              html += "<td>" + data.data[i].ruta_proceso + "</td>";
              html += "<td>" + dias + "</td>";
              html += "<td>" + promesa +"</td>";
              html += "</tr>";
            }
            html += "</tbody></table>";
            $("#table_lista_carteras").html(html);
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
$('#table_cartera').dataTable();
//=============== Fin Ajax Carteras =====================//
});
</script>