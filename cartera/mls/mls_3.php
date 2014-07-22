<?php 
  $sqlmls = "SELECT * FROM mls WHERE id_cartera='$id' AND id_proceso_mls='3' ";
  $result = $conexion->query($sqlmls);
  $row = $result->fetch_array();
?>
<div class="panel panel-primary">
  <div class="panel-heading">Dictamen Comercial</div>
  <form action="mls/save_mls_3.php" method="POST" role="form">
    <table class="table">
      <tr>
        <td><label for="c1">Avaluo Antecedente de Escritura Inmediata Anterior</label></td>
        <td><input type="checkbox" <?php if ($row['c1'] == 1) {?> checked="checked" <?php } ?> name="c1" id="c1" value="1"></td>
      </tr>
      <tr>
        <td><label for="c2">Avaluo, Estimacion de Valor o Preavaluo Comercial y de Mercado.</label></td>
        <td><input type="checkbox" <?php if ($row['c2'] == 1) {?> checked="checked" <?php } ?> name="c2" id="c2" value="1"></td>
      </tr>
      <tr>
        <td><label for="c3">Pre Avaluo o Avaluo Fiscal (Referencia Valor Catastral).</label></td>
        <td><input type="checkbox" <?php if ($row['c3'] == 1) {?> checked="checked" <?php } ?> name="c3" id="c3" value="1"></td>
      </tr>
      <tr>
        <td><label for="c4">Otras Opciones de Referencia</label></td>
        <td><input type="checkbox" <?php if ($row['c4'] == 1) {?> checked="checked" <?php } ?> name="c4" id="c4" value="1"></td>
      </tr>
      <tr>
        <td><label for="c5">Fotografias</label></td>
        <td><input type="checkbox" <?php if ($row['c5'] == 1) {?> checked="checked" <?php } ?> name="c5" id="c5" value="1"></td>
      </tr>
    </table>
    <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
    <div class="panel-footer"><input type="submit" value="Aceptar" class="btn btn-primary"></div>
  </form>
</div>