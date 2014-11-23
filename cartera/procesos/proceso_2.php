<?php
	$sql = "SELECT a.id_usuarioRelacion, DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega, a.cita_propiedad, a.comment_preliminar FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_2.php" method="POST" >
		<label for="comment_preliminar">Comentario Preliminar:</label>
		<br>
		<textarea class="form-control"  name="comment_preliminar" id="comment_preliminar" cols="50" rows="5" required><?php echo $row['comment_preliminar']; ?></textarea>
		<br>
		<label for="cita_propiedad">Cita Propiedad</label>
		<br>
		<input type="date"  class="form-control" name="cita_propiedad" id="cita_propiedad" value="<?php echo $row['cita_propiedad']; ?>" required>
		<br>
		<label for="comment_seguimiento">Comentario Seguimiento:</label>
		<br>
		<textarea class="form-control"  name="comment_seguimiento" id="comment_seguimiento" cols="50" rows="5" ></textarea>
		<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
		<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
		<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
		<br>
		<input type="submit" class="btn btn-primary"  id="submit_proceso" value="Aceptar">
		<br><br>
	</form>
</div>
<div class="col-xs-12 col-md-3 col-md-offset-2">
	<form action="update_fecha.php" method="POST" id="form_fecha" name="form_fecha">
		<label for="fecha_inicio">Fecha de Inicio</label>
		<br>
		<input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" readonly="readonly" value="<?php echo $row['fecha']; ?>">
		<br>
		<label for="fecha_entrega">Fecha de Entrega</label>
		<br>
		<input type="date" class="form-control"  name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
		<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
		<br>
		<input type="submit" class="btn btn-success" id="submit_fecha" value="Guardar Fecha de Entrega">
		<br>
		<div id="result_fecha"></div>
	</form>
	<br>
	<?php if ($row['id_usuarioRelacion'] == '') { ?>
	<a href="javascript:void(0)" data-toggle='modal' data-target='.cartera' class="btn btn-primary" id="btn">Encargado Cartera</a>
	<?php } ?>
</div>
<!--  Inicio Dialogo relacion cartera -->
<div class="modal fade cartera" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Encargado de Cartera</h4>
      </div>
      <div class="modal-body">
        <form action="addcarteraSave.php" method="POST" id="formAddCartera">
    <label for="tipoUser">Tipo:</label>
    <br>
   	<!-- El SELECT ES POR AJAX -->
      <div id="selectUser"></div>
    <!-- FIN SELECT ES POR AJAX -->
    <br>
    <input type="hidden" name="id_carteraAdd" id="id_carteraAdd" value="<?php echo $id; ?>">
      </div>
      <div class="modal-footer">
      	<a href="javascript:void(0)" data-toggle='modal' data-target='.agregar' class="btn btn-warning" id="btn">Registrar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" id="btnAddCartera" value="Agregar">
        </form>
      </div>
      <div id="resultAddCartera"></div>
    </div>
  </div>
</div>
<!-- Fin Dialogo relacion cartera -->
<!--  Inicio Dialogo Registrar -->
<div class="modal fade agregar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registrar Perosna Encargada</h4>
      </div>
      <div class="modal-body">
        <form action="addRegistroSave.php" method="POST" id="formAddRegistro">
	    <label for="nombre">nombre:</label>
	    <br>
	    <input type="text" name="nombre" class="form-control" id="nombre">
	    <br>
	    <label for="paterno">Apellido Paterno:</label>
	    <br>
	    <input type="text" name="paterno" class="form-control" id="paterno">
	    <br>
	    <label for="materno">Apellido Materno:</label>
	    <br>
	    <input type="text" name="materno" class="form-control" id="materno">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" id="btnRegistrar" value="Agregar">
        </form>
      </div>
      <div id="resultAddRegistro"></div>
    </div>
  </div>
</div>
<!-- Fin Dialogo Registrar -->
<script src="../js/jquery-1.10.2.js"></script>
<script>
	$(function() {
		//var interval = setInterval(function() {
		$.ajax({
			url: 'procesos/selectUser.php',
			type: 'POST',
			dataType: 'json',
		})
		.done(function(data) {
			var html = "";
			html ="<select name='tipoUser' id='tipoUser' class='form-control' required >";
			html +="<option value='' >-- Seleccione --</option>";
			for (i = 0; i < data.data.length; i++) {
				html+="<option value='"+data.data[i].id_user+"' >"+data.data[i].nombre+" "+data.data[i].ap_paterno+"</option>";
			}
			html +="</select>";
			$("#selectUser").html(html);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		})
		//},5000);
//=========================================================================//
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

		$("#btnAddCartera").on('click', function(e) {
			e.preventDefault();
			var datos = $("#formAddCartera").serialize();
			/* Act on the event */
			$.ajax({
				url: 'procesos/addcarteraSave.php',
				type: 'POST',
				dataType: 'json',
				data: datos,
				success: function(data){
					if(data.msj == true) {
		              $("#resultAddCartera").fadeIn('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
		              $("#resultAddCartera").fadeOut('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
		              window.location="proceso.php?id=<?php echo $_GET['id']; ?>";
		            }else{
		              $("#resultAddCartera").html("<div class='alert alert-danger'>No se pudo Guardar!</div>");
		            }
				},
	            beforeSend: function(){
	              $("#resultAddCartera").html("<div class='alert-info form-control'><img src='../../img/ajax-loader.gif' /> Loading...</div>");
	            }
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
				$("#resultAddCartera").html("<div class='alert alert-danger'>ERROR!</div>");
			})
			.always(function() {
				console.log("complete");
			});
		});
		$("#btnRegistrar").on('click', function(e) {
			e.preventDefault();
			/* Act on the event */
			var datos = $("#formAddRegistro").serialize();
			/* Act on the event */
			$.ajax({
				url: 'procesos/addRegistroSave.php',
				type: 'POST',
				dataType: 'json',
				data: datos,
				success: function(data){
					if(data.msj == true) {
		              $("#resultAddRegistro").fadeIn('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
		              $("#resultAddRegistro").fadeOut('slow').html("<div class='alert alert-success'>Se Guardo Exitosamente!</div>");
		            }else{
		              $("#resultAddRegistro").html("<div class='alert alert-danger'>No se pudo Guardar!</div>");
		            }
				},
	            beforeSend: function(){
	              $("#resultAddRegistro").html("<div class='alert-info form-control'><img src='../../img/ajax-loader.gif' /> Loading...</div>");
	            }
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
				$("#resultAddRegistro").html("<div class='alert alert-danger'>ERROR!</div>");
			})
			.always(function() {
				console.log("complete");
			});
		});
	});
</script>