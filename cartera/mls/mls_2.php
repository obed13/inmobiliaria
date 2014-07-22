<?php 
  $sqlmls = "SELECT * FROM mls WHERE id_cartera='$id' AND id_proceso_mls='2' ";
  $result = $conexion->query($sqlmls);
  $row = $result->fetch_array();
?>
<div class="panel panel-primary">
  <div class="panel-heading">Dictamen Fiscal</div>
  <form action="mls/save_mls_2.php" method="POST" role="form">
    <table class="table">
      <tr>
        <td><label for="b1">Anexos de Escritura Sobre el Ultimo Pago de Impto Sobre Adquisicion del Inmueble.</label></td>
        <td><input type="checkbox" <?php if ($row['b1'] == 1) {?> checked="checked" <?php } ?> name="b1" id="b1" value="1"></td>
      </tr>
      <tr>
        <td><label for="b2">Anexo de Escritura Sobre el Ultimo Pago o Excencion de ISR del Inmueble.</label></td>
        <td><input type="checkbox" <?php if ($row['b2'] == 1) {?> checked="checked" <?php } ?> name="b2" id="b2" value="1"></td>
      </tr>
      <tr>
        <td><label for="b3">Documentos Actuales que Acrediten Exentar el ISR (RECIBOS DE CFE O SERVICIOS).</label></td>
        <td><input type="checkbox" <?php if ($row['b3'] == 1) {?> checked="checked" <?php } ?> name="b3" id="b3" value="1"></td>
      </tr>
      <tr>
        <td><label for="b4">Calculo Estimado Del Impuesto Posible a Generarse Por Venta (ISR).</label></td>
        <td><input type="checkbox" <?php if ($row['b4'] == 1) {?> checked="checked" <?php } ?> name="b4" id="b4" value="1"></td>
      </tr>
      <tr>
        <td><label for="b5">Ultima Boleta De Pago Del Impuesto Predial O Presupuesto Actual de Adeudo.</label></td>
        <td><input type="checkbox" <?php if ($row['b5'] == 1) {?> checked="checked" <?php } ?> name="b5" id="b5" value="1"></td>
      </tr>
      <tr>
        <td><label for="b6">Calculo Estmado del Impto al Valor Agregado (IVA) Si Aplica O No.</label></td>
        <td><input type="checkbox" <?php if ($row['b6'] == 1) {?> checked="checked" <?php } ?> name="b6" id="b6" value="1"></td>
      </tr>
    </table>
    <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
    <div class="panel-footer"><input type="submit" value="Aceptar" class="btn btn-primary"></div>
  </form>
</div>