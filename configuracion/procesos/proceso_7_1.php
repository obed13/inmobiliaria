<?php
  $sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
  $resultado = $conexion->query($sql);
  $row = $resultado->fetch_array();

  $sqlmls = "SELECT * FROM mls WHERE id_cartera='$id' ";
  $resultmls = $conexion->query($sqlmls);
  $mls = $resultmls->fetch_array();
?>
<div class="col-xs-12 col-md-8">
<div class="panel panel-primary">
  <div class="panel-heading">MLS Express</div>
  <form action="procesos/save_proceso_7_1.php" method="POST" role="form">
    <table class="table">
      <tr>
        <td><label for="a4">Acreditacion de propiedad, posesicion, poder sobre el bien etc.</label></td>
        <td><input type="checkbox" <?php if ($mls['a4'] == 1) {?> checked="checked" <?php } ?> name="a4" id="a4" value="1"></td>
      </tr>
      <tr>
        <td><label for="a6">Identificaciones copias (pasaporte, ife vigente, cedula profesional)</label></td>
        <td><input type="checkbox" <?php if ($mls['a6'] == 1) {?> checked="checked" <?php } ?> name="a6" id="a6" value="1"></td>
      </tr>
      <tr>
        <td><label for="c2">Avaluo, Estimacion de Valor o Preavaluo Comercial y de Mercado.</label></td>
        <td><input type="checkbox" <?php if ($mls['c2'] == 1) {?> checked="checked" <?php } ?> name="c2" id="c2" value="1"></td>
      </tr>
      <tr>
        <td><label for="c5">Fotografias</label></td>
        <td><input type="checkbox" <?php if ($mls['c5'] == 1) {?> checked="checked" <?php } ?> name="c5" id="c5" value="1"></td>
      </tr>
    </table>
    <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
    <input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
    <input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
    <div class="panel-footer"><input type="submit" value="Aceptar" class="btn btn-primary"></div>
  </form>
</div>
</div>

<script src="../js/jquery-1.10.2.js"></script>