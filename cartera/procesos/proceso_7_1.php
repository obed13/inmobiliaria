<?php 
  $sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega FROM proceso_cartera a WHERE id_cartera='$id' ";
  $resultado = $conexion->query($sql);
  $row = $resultado->fetch_array();
  $sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='4' ";
  $resultcat = $conexion->query($sqlcat);
  $nomcat = $resultcat->fetch_array();
  if ($_SESSION['id_cat'] != 4 && $_SESSION['id_cat'] != 1) {
    echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
    $proceso = false;
  }
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
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($mls['a4'] == 1) {?> checked="checked" <?php } ?> name="a4" id="a4" value="1"></td>
      </tr>
      <tr>
        <td><label for="a6">Identificaciones copias (pasaporte, ife vigente, cedula profesional)</label></td>
        <td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> <?php if ($mls['a6'] == 1) {?> checked="checked" <?php } ?> name="a6" id="a6" value="1"></td>
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
    <div class="panel-footer"><input type="submit" <?php if(!($_SESSION['id_cat'] == 2) && !($_SESSION['id_cat'] == 1)) { ?> disabled <?php }elseif(!($_SESSION['id_cat'] == 3) && !($_SESSION['id_cat'] == 1)) { ?> disabled <?php } ?> value="Aceptar" class="btn btn-primary"></div>
  </form>
</div>
</div>
<div class="col-md-3">
  <form action="update_fecha.php" method="POST" id="form_fecha" name="form_fecha">
    <label for="fecha_inicio">Fecha de Inicio</label>
    <br>
    <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" readonly="readonly" value="<?php echo $row['fecha']; ?>">
    <br>
    <label for="fecha_entrega">Fecha de Entrega</label>
    <br>
    <input type="date" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
    <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
    <br>
    <input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-success" id="submit_fecha" value="Cambiar Fecha Entrega">
    <br>
    <div id="result_fecha"></div>
  </form>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script>
  $(function() {
    $("#submit_fecha").on('click', function(e) {
      e.preventDefault();
      var datos = $("#form_fecha").serialize();
      /* Act on the event */
      $.ajax({
        url: 'procesos/update_fecha.php',
        type: 'POST',
        dataType: 'json',
        data: datos,
        success: function(data){
          if(data.msj == true) {
            $("#fecha_entregas").val(data.fecha_entrega);
                  $("#result_fecha").fadeIn('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
                  $("#result_fecha").fadeOut('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
                }else{
                  $("#result_fecha").html("<div class='alert alert-danger'>No se pudo Guardar!</div>");
                }
        },
              beforeSend: function(){
                $("#result_fecha").html("<div class='alert-info form-control'><img src='../../img/ajax-loader.gif' /> Loading...</div>");
              }
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
        $("#result_fecha").html("<div class='alert alert-danger'>ERROR!</div>");
      })
      .always(function() {
        console.log("complete");
      });
      
    });
  });
</script>