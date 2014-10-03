<?php 
  session_start(); 
  require_once '../conexion.php';
  require_once '../sesion.php';
  $conexion = conectar();
  $id = $_GET['id'];

  $sql = "
    select
      a.id_cartera,
      a.nom_cartera,
      datediff(a.fecha_entrega, a.fecha_inicio) as dias,
      a.id_proceso,
      a.recabar_doc_mls,
      a.firma_aviso_privacidad,
      a.nuevo_contrato,
      a.estatus,
      a.id_usuarioRelacion
    from
      proceso_cartera a
    where
      a.id_cartera = ".$id."
  ";
  $resultado = $conexion->query($sql);
  $sqlrelacion = "SELECT * FROM usuariorelacion";
  $consulta = $conexion->query($sqlrelacion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.: Inmobiliaria :.</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap-cerulean.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/opa-icons.css">
</head>
<body>

    <?php
      include_once 'menu_bar.php';

      while ($row = $resultado->fetch_array()) {
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-12 main">
          <h3 class="sub-header"><a href="list_cartera.php"><span class="icon32 icon-color icon-arrowthick-w" title="Regresar"></span></a> Cartera: <?php echo $row['nom_cartera']; ?> <i class="pull-right">Estatus: <?php if ($row['estatus']==1) { echo "<label class='label label-success'>Completado</label>"; }elseif ($row['estatus']==2) { echo "<label class='label label-danger'>Cancelado</label>"; }else{echo "<label class='label label-warning'>En Tramite</label>";}?></i></h3>  
            <div class="sortable row-fluid ui-sortable">
              <div class="row">

                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="proceso.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-gear"></span>
                    <div>Proceso</div>
                    <div></div>
                  </a>
                </div>

                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="cancel.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-cancel"></span>
                    <div>Cancelar</div>
                    <div></div>
                  </a>
                </div>
              <?php if ($row['recabar_doc_mls'] == 3 || $row['recabar_doc_mls'] == 2) { ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="mls.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-script"></span>
                    <div>MLS</div>
                    <div><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; } ?></div>
                  </a>
                </div>
              <?php } if ($row['nuevo_contrato'] == 'si') { ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="contrato.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-compose"></span>
                    <div>Contrato</div>
                    <div></div>
                  </a>
                </div>
              <?php } if ($row['id_proceso'] >= 2.1) { ?>
              	<div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="inmueble.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-profile"></span>
                    <div>Datos de Inmueble</div>
                    <div></div>
                  </a>
                </div>
              <?php } ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block"data-toggle='modal' data-target='.reporte' href="javascript:void(0)">
                    <span class="icon32 icon-color icon-pdf"></span>
                    <div>Reporte de Actividades</div>
                    <div></div>
                  </a>
                </div>
                <?php if (isset($row['id_usuarioRelacion']) == 0) { ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block"data-toggle='modal' data-target='.relacion' href="javascript:void(0)">
                    <span class="icon32 icon-color icon-user"></span>
                    <div>Referente de Cartera</div>
                    <div></div>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
        </div>
      </div>
    </div>
<!--  Inicio Dialogo Reporte -->
<div class="modal fade reporte" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reporte de Visitas</h4>
      </div>
      <div class="modal-body">
          <form action="pdf/reporteAct.php" method="POST" id="reporteAct" name="reporteAct" target="_blank" >
            <label for="fechaInicio">De:</label>
            <br>
            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
            <br>
            <label for="fechaFin">Al:</label>
            <br>
            <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
            <input type="hidden" name="id_cartera" value="<?php echo $row['id_cartera']; ?>">
            <br>
            <input type="submit" class="btn btn-primary" value="Aceptar">
          </form>
      </div>
    </div>
  </div>
</div>
<!--  Inicio Dialogo Relacion Cartera -->
<div class="modal fade relacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Relacion con Cartera</h4>
      </div>
      <div class="modal-body">
          <form action="relacionCartera.php" method="POST" id="relacion" name="relacion" >
          <input type="hidden" name="id_cartera" value="<?php echo $row['id_cartera']; ?>">
<?php } ?>
            <label for="relacionCartera">Usuario Relacionado:</label>
            <br>
            <select name="relacionCartera" id="relacionCartera" class="form-control" required>
              <option value="">....Seleccione....</option>
          <?php
            while ($row = $consulta->fetch_assoc()) {
              echo "<option value=".$row['id_usuarioRelacion'].">".$row['nombre']." ".$row['paterno']." ".$row['materno']."</option>";
            }
          ?>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" id="btnRelacion" value="Aceptar">
            <br>
            <div id="result"></div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin Dialogo Reporte -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
$(function() {
  $('#btnRelacion').on('click', function(e) {
    e.preventDefault();
    /* Act on the event */
    var datos = $("#relacion").serialize();

        $.ajax({
          url: 'relacionCartera.php',
          type: 'POST',
          dataType: 'json',
          data: datos,
          success: function(data){
            if(data.msj == true) {
                    $("#result").fadeIn('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
                    $("#result").fadeOut('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
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
  });
});
</script>