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
      a.estatus
    from
      proceso_cartera a
    where
      a.id_cartera = ".$id." 
  ";
  $resultado = $conexion->query($sql);
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
                    <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                    <!--<div>507</div>-->
                    <!--<span class="notification">6</span>-->
                  </a>
                </div>

                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="cancel.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-cancel"></span>
                    <div>Cancelar</div>
                    <div></div>
                    <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                    <!--<div>507</div>-->
                    <!--<span class="notification">6</span>-->
                  </a>
                </div>
              <?php if ($row['recabar_doc_mls'] == 3 || $row['recabar_doc_mls'] == 2) { ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="mls.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-script"></span>
                    <div>MLS</div>
                    <div><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; } ?></div>
                    <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                    <!--<div>507</div>-->
                    <!--<span class="notification">6</span>-->
                  </a>
                </div>
              <?php } if ($row['nuevo_contrato'] == 'si') { ?>
                <div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="contrato.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-compose"></span>
                    <div>Contrato</div>
                    <div></div>
                    <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                    <!--<div>507</div>-->
                    <!--<span class="notification">6</span>-->
                  </a>
                </div>
              <?php } if ($row['id_proceso'] >= 2.1) { ?>
              	<div class="col-xs-12 col-md-3">
                  <a data-rel="tooltip" class="well span3 top-block" href="inmueble.php?id=<?php echo $row['id_cartera']; ?>">
                    <span class="icon32 icon-color icon-profile"></span>
                    <div>Datos de Inmueble</div>
                    <div></div>
                    <?php //if ($row['id_cartera']) { echo "<div>".$num."</div>"; } ?>
                    <!--<div>507</div>-->
                    <!--<span class="notification">6</span>-->
                  </a>
                </div>
              <?php } ?>
              </div>
            </div>
        </div>
      </div>
    </div>
    <?php } ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>