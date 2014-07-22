<?php 
  $sqlmls = "SELECT * FROM mls WHERE id_cartera='$id' AND id_proceso_mls='1' ";
  $result = $conexion->query($sqlmls);
  $row = $result->fetch_array();

  if (!($_SESSION['id_cat'] == 2) && !($row['a1'] == 1) && !($_SESSION['id_cat'] == 1)) {
    echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona encargada de rellenar este proceso lo haga!!</div></div>";
    $proceso = false;
  }
  if (!($_SESSION['id_cat'] == 3) && !($_SESSION['id_cat'] == 1)) {
    echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona encargada de rellenar este proceso lo haga!!</div></div>";
    $proceso = false;
  }
?>
<div class="panel panel-primary">
  <div class="panel-heading">Dictamen Juridico-Legal</div>
  <form action="mls/save_mls_1.php" method="POST" role="form">
    <table class="table">
      <tr>
        <td><label for="a2">Copia de escrituras, titulo, contrato  y anexos</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a2'] == 1) {?> checked="checked" <?php } ?> name="a2" id="a2" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a3">Informacion registral actual del registro publico de la propiedad (anexos)</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a3'] == 1) {?> checked="checked" <?php } ?> name="a3" id="a3" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a4">Acreditacion de propiedad, posesicion, poder sobre el bien etc.</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a4'] == 1) {?> checked="checked" <?php } ?> name="a4" id="a4" value="1"></td>
      </tr>
      <tr>
        <td><label for="a5">Cancelacion o no cancelacion de gravamen inscrito en el registro publico  (estatus)</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a5'] == 1) {?> checked="checked" <?php } ?> name="a5" id="a5" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a6">Identificaciones copias (pasaporte, ife vigente, cedula profesional)</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a6'] == 1) {?> checked="checked" <?php } ?> name="a6" id="a6" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a7">Validaciones de id</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a7'] == 1) {?> checked="checked" <?php } ?> name="a7" id="a7" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a8">Actas de nacimiento (no obligatorio)</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a8'] == 1) {?> checked="checked" <?php } ?> name="a8" id="a8" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a9">Actas de matrimonio estatus civil (documento probatorio) o resolucion de divorcio</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a9'] == 1) {?> checked="checked" <?php } ?> name="a9" id="a9" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a10">Curps</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a10'] == 1) {?> checked="checked" <?php } ?> name="a10" id="a10" value="1" ></td>
      </tr>
      <tr>
        <td><label for="a11">Deslinde certificado anterior o reciente</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($row['a11'] == 1) {?> checked="checked" <?php } ?> name="a11" id="a11" value="1" ></td>
      </tr>
    </table>
    <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
    <div class="panel-footer"><input type="submit" <?php if(!($_SESSION['id_cat'] == 2) && !($_SESSION['id_cat'] == 1)) { ?> disabled <?php }elseif(!($_SESSION['id_cat'] == 3) && !($_SESSION['id_cat'] == 1)) { ?> disabled <?php } ?> value="Aceptar" class="btn btn-primary"></div>
  </form>
</div>