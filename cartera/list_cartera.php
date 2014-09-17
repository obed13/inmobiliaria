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
                  <th>Cartera</th>
                  <th>Dias para Proceso</th>
                  <th>Estatus</th>
                  <th>Estatus MLS</th>
                  <th colspan="4">Accion</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $sql = "
            select
              a.id_cartera,
              a.nom_cartera,
              DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y') fecha,
              datediff(a.fecha_entrega, a.fecha_inicio) as dias,
              a.id_proceso,
              a.recabar_doc_mls,
              a.firma_aviso_privacidad,
              a.nuevo_contrato,
              a.estatus,
              a.fecha_entrega
            from
              proceso_cartera a
            where
              not exists (select bb.estatus from proceso_cartera bb where a.id_cartera=bb.id_cartera and bb.estatus >= 1 )
          ";
          $resultado = $conexion->query($sql);
          $no = 0;
          while ($row = $resultado->fetch_array()) {
            $no++;
            $fecha=$row['fecha_entrega'];
            $hoy = date("Y-m-d");
            //$segundos=substr($fecha, -2);
            //$now = substr($hoy, -2);
            //$resta = $segundos - $now;
            $datetime1 = new DateTime($hoy);
            $datetime2 = new DateTime($fecha);
            $interval = $datetime1->diff($datetime2);
            $resta = $interval->format('%a');
          ?>
                <tr>
                  <td><?php echo $no; ?><input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $row['id_cartera']; ?>"></td>
                  <td><?php echo $row['nom_cartera']; ?></td>
                  <td><?php if($resta <= 0){ echo "<div class='label alert-danger'>".$resta." Dias ATRASADO</div>"; }elseif ($resta == 1){ echo "<div class='label alert-danger'>Te quedan ".$resta." Dias</div>"; }elseif ($resta == 2){ echo "<div class='label alert-danger'>Te quedan ".$resta." Dias</div>"; } else{ echo $resta." Dias"; } ?></td>
                  <td><?php if ($row['estatus']==1) { echo "<label class='label label-success'>Completado</label>"; }elseif ($row['estatus']==2) { echo "<label class='label label-danger'>Cancelado</label>"; }else{echo "<label class='label label-warning'>En Tramite</label>";} ?></td>
                  <td><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; } ?></td>
                  <td><a href="cartera.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-primary">Cartera</a></td>
                  <td><a href="javascript:void(0)" id="btn_dialog" class="btn btn-warning">Promesa</a></td>
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
<!--  Inicio Dialogo -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Estatus</h4>
      </div>
      <div class="modal-body">
        <form action="addPromesaSave.php" method="POST" id="formPromesa">
    <label for="promesa">Tipo de Estatus:</label>
    <br>
    <select name="promesa" id="promesa" class="form-control" required >
      <option value="">-- Seleccione --</option>
      <option value="1">Vendida</option>
      <option value="2">Rentada</option>
      <option value="3">Promesa</option>
      <option value="4">Negociacion</option>
    </select>
    <br>
    <label for="fechaEsperada">Fecha Esperada de Cierre:</label>
    <br>
    <input type="date" name="fechaEsperada" id="fechaEsperada" class="form-control" required >
    <br>
    <label for="fechaCierre">Fecha de Cierre:</label>
    <br>
    <input type="date" name="fechaCierre" id="fechaCierre" class="form-control" required >
    <input type="hidden" name="id_carteraPromesa" id="id_carteraPromesa">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" id="btnPromesa" value="Agregar">
        </form>
      </div>
      <div id="result"></div>
    </div>
  </div>
</div>
<!-- Fin Dialogo -->
<!--  Inicio Dialogo Actividad -->
<div class="modal fade actividad" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Actividad</h4>
      </div>
      <div class="modal-body">
        <form action="addActividadSave.php" method="POST" id="formActividad">
    <label for="tipoActividad">Tipo:</label>
    <br>
    <select name="tipoActividad" id="tipoActividad" class="form-control" required >
      <option value="">-- Seleccione --</option>
      <option value="1">Venta</option>
      <option value="2">Servico a Clientes</option>
    </select>
    <br>
    <label for="opcionActividad">Opcion:</label>
    <br>
    <select name="opcionActividad" id="opcionActividad" class="form-control" required >
      <option value="">-- Seleccione --</option>
      <option value="1">Cita</option>
      <option value="2">Llamada</option>
    </select>
    <br>
    <label for="fechaActividad">Fecha:</label>
    <br>
    <input type="date" name="fechaActividad" id="fechaActividad" class="form-control" required >
    <br>
    <label for="comentarioAcitividad">Comentario:</label>
    <br>
    <textarea name="comentarioAcitividad" id="comentarioAcitividad" cols="40" rows="5"></textarea>
    <input type="hidden" name="id_carteraActividad" id="id_carteraActividad">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" id="btnActividad" value="Agregar">
        </form>
      </div>
      <div id="resultActividad"></div>
    </div>
  </div>
</div>
<!-- Fin Dialogo Actividad -->
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.js"></script>
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
  url: 'ajaxListCartera.php',
  type: 'POST',
  dataType: 'json',
  async: false,
  cache: false,
  success: function(data){
          var html = "";
            var num = 0;
            html ="<table border='0' class='table table-striped' id='table_cartera'>";
            html +="<thead><tr><th>#</th><th>Cartera</th><th>Dias para Proceso</th><th>Estatus</th><th>Estatus MLS</th><th colspan='4'>Accion</th></tr></thead><tbody>";
            for (i = 0; i < data.data.length; i++) {
              var fecha = restaFechas(f,data.data[i].fecha_entrega);
              if(fecha <= 0){dias = "<div class='label alert-danger'>"+fecha+" Dias ATRASADO</div>";}else if(fecha == 1){dias = "<div class='label alert-danger'>Te Quedan "+fecha+" Dias</div>";}else if(fecha == 2){dias= "<div class='label alert-danger'>Te Quedan "+fecha+" Dias</div>";}else{dias = fecha+" Dias";}
              if (data.data[i].estatus==1) { estatus = "<label class='label label-success'>Completado</label>"; }if (data.data[i].estatus==2) { estatus = "<label class='label label-danger'>Cancelado</label>"; }else{ estatus = "<label class='label label-warning'>En Tramite</label>";}
              if (data.data[i].recabar_doc_mls==3) { recabar_doc_mls = "<label class='label label-info'>MLS Express</label>"; }else if (data.data[i].recabar_doc_mls==2) { recabar_doc_mls = "<label class='label label-danger'>MLS (No Terminado)</label>"; }else if (data.data[i].recabar_doc_mls==1) { recabar_doc_mls = "<label class='label label-success'>MLS</label>"; }else { recabar_doc_mls = ""; }
              num++;
              html += "<tr class='lista' id_cartera='"+data.data[i].id_cartera+"' nom_cartera='"+data.data[i].nom_cartera+"' fecha='"+data.data[i].fecha+"' dias='"+data.data[i].dias+"' id_proceso='"+data.data[i].id_proceso+"' recabar_doc_mls='"+data.data[i].recabar_doc_mls+"' firma_aviso_privacidad='"+data.data[i].firma_aviso_privacidad+"' nuevo_contrato='"+data.data[i].nuevo_contrato+"' estatus='"+data.data[i].estatus+"' fecha_entrega='"+data.data[i].fecha_entrega+"' >";
              html += "<td>" + num + "</td>";
              html += "<td>" + data.data[i].nom_cartera + "</td>";
              html += "<td>" + dias + "</td>";
              html += "<td>" + estatus + "</td>";
              html += "<td>" + recabar_doc_mls + "</td>";
              html += "<td><a href='cartera.php?id=" + data.data[i].id_cartera + "' class='btn btn-primary'>Cartera</a></td>";
              html += "<td><a href='javascript:void(0)' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-warning'>Promesa</a></td>";
              html += "<td><a href='javascript:void(0)' data-toggle='modal' data-target='.actividad' class='btn btn-info'>Actividad</a></td>";
              html += "<td><a href='pdf/index.php?id=" + data.data[i].id_cartera + "' target='_blank' class='btn btn-danger'>Reporte</a></td>";
              html += "</tr>";
            }
            html += "</tbody></table>";
            $("#table_lista_carteras").html(html);
            $(".lista").on('click', function() {

            id_cartera   = $(this).attr("id_cartera");

            $("#id_carteraPromesa").val(id_cartera);
            $("#id_carteraActividad").val(id_cartera);

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

//=============== Fin Ajax Carteras =====================//
//===============   Ajax   ==============================//
$('#btnPromesa').on('click', function(e) {
  e.preventDefault();
  /* Act on the event */

  if ($('#promesa').val() == '') {
    $('#result').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }else if ($('#fechaEsperada').val() == '') {
    $('#result').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }else if ($('#fechaCierre').val() == '') {
    $('#result').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }  else{
    var datos = $('#formPromesa').serialize();

    $.ajax({
      url: 'addPromesaSave.php',
      type: 'POST',
      dataType: 'json',
      data: datos,
    })
    .done(function(data) {
      console.log("success");
      if (data.msj == true) {
        $("#result").html("<div class='alert alert-success'>Se Agrego a la Orden</div>");
        $("#result").fadeOut('5000');
        $("#promesa").val('');
        $("#fechaEsperada").val('');
        $("#fechaCierre").val('');
      }else{
        $("#result").html("<div class='alert alert-danger'>No Se Agrego a la Orden</div>");
        $("#result").fadeOut('5000');
        $("#promesa").val('');
        $("#fechaEsperada").val('');
        $("#fechaCierre").val('');
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  }
});
//=============== Fin Ajax ==============================//
//=============== Ajax Actividad ==============================//
$('#btnActividad').on('click', function(e) {
  e.preventDefault();
  /* Act on the event */
  if ($('#tipoActividad').val() == '') {
    $('#resultActividad').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }else if ($('#opcionActividad').val() == '') {
    $('#resultActividad').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }else if ($('#fechaActividad').val() == '') {
    $('#resultActividad').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  }else if ($('#comentarioAcitividad').val() == '') {
    $('#resultActividad').html("<div class='alert alert-danger'>Hay Campos Vacios!!!</div>");
  } else{

    var datos = $('#formActividad').serialize();

    $.ajax({
      url: 'addActividadSave.php',
      type: 'POST',
      dataType: 'json',
      data: datos,
    })
    .done(function(data) {
      console.log("success");
      if (data.msj == true) {
        $("#resultActividad").html("<div class='alert alert-success'>Se Agrego a la Orden</div>");
        $("#resultActividad").fadeOut('5000');
        $("#tipoActividad").val('');
        $("#opcionActividad").val('');
        $("#fechaActividad").val('');
        $("#comentarioAcitividad").val('');
      }else{
        $("#resultActividad").html("<div class='alert alert-danger'>No Se Agrego a la Orden</div>");
        $("#resultActividad").fadeOut('5000');
        $("#tipoActividad").val('');
        $("#opcionActividad").val('');
        $("#fechaActividad").val('');
        $("#comentarioAcitividad").val('');
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  }
});
//=============== Fin Ajax Actividad ==============================//
  });
</script>