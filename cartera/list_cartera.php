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
          <h2 class="sub-header">Listado</h2>
          <div class="table-responsive">
            <table class="table table-striped">
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
            $segundos=substr($fecha, -2);
            $now = substr($hoy, -2);
            $resta = $segundos - $now;
          ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nom_cartera']; ?></td>
                  <td><?php if ($resta == 2){ echo "<div class='label alert-danger'>".$resta." Dias</div>"; } else{ echo $resta." Dias"; } ?></td>
                  <td><?php if ($row['estatus']==1) { echo "<label class='label label-success'>Completado</label>"; }elseif ($row['estatus']==2) { echo "<label class='label label-danger'>Cancelado</label>"; }else{echo "<label class='label label-warning'>En Tramite</label>";} ?></td>
                  <td><?php if ($row['recabar_doc_mls']==3) { echo "<label class='label label-info'>MLS Express</label>"; }elseif ($row['recabar_doc_mls']==2) { echo "<label class='label label-danger'>MLS (No Terminado)</label>"; }elseif ($row['recabar_doc_mls']==1) { echo "<label class='label label-success'>MLS</label>"; } ?></td>
                  <!--<td><a href="proceso.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-success" <?php if ($row['estatus']==1) {?>disabled="disabled" <?php }if ($row['estatus']==2) {?>disabled="disabled" <?php } ?> >Proceso</a> </td>
                  <td><a href="cancel.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-danger"<?php if ($row['estatus']==1) {?>disabled="disabled" <?php }if ($row['estatus']==2) {?>disabled="disabled" <?php } ?> >Cancelar</a> </td>
                  <?php if ($row['recabar_doc_mls'] == 3 || $row['recabar_doc_mls'] == 2) { ?>
                  <td><a href="mls.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-info" <?php if ($row['recabar_doc_mls']==1) {?>disabled="disabled" <?php }if ($row['estatus']==1) {?>disabled="disabled" <?php }if ($row['estatus']==2) {?>disabled="disabled" <?php } ?> >MLS</a> </td>
                  <?php } ?>
                  <?php if ($row['nuevo_contrato'] == 'si') { ?>
                  <td><a href="contrato.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-warning">Contrato</a></td>
                  <?php } ?>-->
                  <td><a href="cartera.php?id=<?php echo $row['id_cartera']; ?>" class="btn btn-primary">Cartera</a></td>
                </tr>
          <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>