<?php
	$sql = "SELECT precio_dueno,precio_sugerido,DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega,datediff(a.contrato_fin, a.contrato_inicio) as diferencia FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();

	$sqlnum="SELECT (SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 1) as a,
	(SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 2) as b FROM actividades WHERE id_cartera='".$id."'";
	$num = $conexion->query($sqlnum);
	$numero = $num->fetch_array();

	$sqlcapana = "SELECT * FROM campana WHERE id_cartera='$id' AND campana='2' ";
	$campana = $conexion->query($sqlcapana);
	$rowcampana = $campana->fetch_array();
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_9_2.php" method="POST">
		<div class="panel panel-primary">
		  	<!-- Default panel contents -->
		  	<div class="panel-heading"><u>Campaña Intermedio:</u> Acuerdos Resultado de Reporte Bimestral:</div>
			<table border="0" class="table">
				<tr>
					<td align="center">
						<textarea name="acuerdo_reporte" id="acuerdo_reporte" cols="40" rows="10" required><?php echo $rowcampana['acuerdo_reporte']; ?></textarea>
						<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
						<input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
						<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					</td>
				</tr>
			</table>
			<div class="panel-footer"><input type="submit" class="btn btn-primary" id="submit_proceso" value="Aceptar"></div>
		</div>
	</form>
</div>
<div class="col-xs-12 col-md-4">
	<a href="javascript:void(0)" data-toggle='modal' data-target='.reporte' class="btn btn-primary">Ver Reporte</a>
	<br><br>
	<a href="javascript:void(0)" data-toggle='modal' data-target='.precio' class="btn btn-warning">Ver Precios</a>
	<br>
	<form action="update_fecha.php" method="POST" class="form-inline" id="form_fecha" name="form_fecha">
		<label for="fecha_entrega">Fecha de Entrega</label>
		<br>
		<input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" readonly="readonly" value="<?php echo $row['fecha_entrega']; ?>">
		<label for="">El Contrato se Vence en:</label>
		<input type="text" class="form-control" readonly="readonly" value="<?php echo $row['diferencia']; ?> Dias">
	</form>
	<form action="update_datos.php" method="POST" id="form_nuevo">
		<label for="">Cambio de Precio:</label>
		<br>
		<label class="radio-inline">
		  <input type="radio" name="new_precio" id="new_precio1" value="si"> Si
		</label>
		<label class="radio-inline">
		  <input type="radio" name="new_precio" id="new_precio2" value="no" checked> No
		</label>
		<input type="text" name="new_cash" id="new_cash" class="form-control" placeholder="Nuevo Precio $$$" required>
		<br>
		<label for="">Nuevo Contrato:</label>
		<br>
		<label class="radio-inline">
		  <input type="radio" name="contrato" id="contrato1" value="si"> Si
		</label>
		<label class="radio-inline">
		  <input type="radio" name="contrato" id="contrato2" value="no" checked> No
		</label>
		<input type="date" name="new_contrato" id="new_contrato" class="form-control" required>
		<input type="hidden" name="id_cartera" value="<?php echo $id; ?>" >
		<br>
		<input type="submit" class="btn btn-info" id="btn" disabled="disabled" value="Aceptar">
		<div id="result"></div>
	</form>
</div>
<!--  Inicio Dialogo Reporte -->
<div class="modal fade reporte" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reporte de Visitas</h4>
      </div>
      <div class="modal-body">
      	<div style="width:500px;height: 500px;overflow: auto;">
      		<?php echo '<div class="label alert-success">Total de Citas:</div> <div class="label alert-danger"><u>'.$numero['a'].'</u></div> <div class="label alert-success">Total de Llamadas:</div> <div class="label alert-danger"><u>'.$numero['b'].'</u></div>'; ?>
      		<div id="table_reporte"></div>
      	</div>
      </div>
    </div>
  </div>
</div>
<!-- Fin Dialogo Reporte -->
<!--  Inicio Dialogo Precio -->
<div class="modal fade precio" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Precio de la Cartera</h4>
      </div>
      <div class="modal-body">
      <form action="">
      	<label for="precio_dueno">Precio Dueño:</label>
      	<br>
      	<input type="text" id="precio_dueno" name="precio_dueno" class="form-control" value="<?php echo $row['precio_dueno']; ?>" />
      	<br>
      	<label for="precio_sugerido">Precio Sugerido:</label>
      	<br>
      	<input type="text" id="precio_sugerido" name="precio_sugerido" class="form-control" value="<?php echo $row['precio_sugerido']; ?>" />
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin Dialogo Reporte -->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script>
	$(function() {
//=========================================================================//

  $('#new_cash').mask('000,000,000.00', {reverse: true});
  $('#precio_dueno').mask('000,000,000.00', {reverse: true});
  $('#precio_sugerido').mask('000,000,000.00', {reverse: true});

//=========================================================================//
		$("#new_cash").hide();
		$("#new_contrato").hide();

		$("#new_precio1").on('click', function() {
			$("#new_cash").show();
			$("#btn").attr('disabled',false);
		});
		$("#new_precio2").on('click', function() {
			$("#new_cash").hide();
			$("#new_cash").val('');
			$("#btn").attr('disabled',true);
		});
		$("#contrato1").on('click', function() {
			$("#new_contrato").show();
			$("#btn").attr('disabled',false);
		});
		$("#contrato2").on('click', function() {
			$("#new_contrato").hide();
			$("#new_contrato").val('');
			$("#btn").attr('disabled',true);
		});

		$("#btn").on('click', function(e) {
			e.preventDefault();
			/* Act on the event */
			$('#new_cash').unmask('000,000,000', {reverse: true});
			var datos = $("#form_nuevo").serialize();

				$.ajax({
					url: 'procesos/update_datos.php',
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
		              $("#result").html("<div class='alert-info form-control'><img src='../../img/ajax-loader.gif' /> Loading...</div>");
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
//========================================== Reporte Visitas ===========================================//
		$.ajax({
			url: 'procesos/showComent.php',
			type: 'POST',
			dataType: 'json',
			async: false,
		  	cache: false,
		  	data: {id: '<?php echo $id; ?>'},
		  	success: function(data){
		          	var html = "";
		            var num = 0;
		            html ="<table border='0' class='table table-striped' id='table_cartera'>";
		            html +="<thead><tr><th>Estatus</th><th>Tipo</th><th width='100'>Fecha</th><th>Comentario</th><th>Encargado</th><th>Interesado</th><th>Telefono</th><th>Email</th></thead><tbody>";
		            for (i = 0; i < data.data.length; i++) {
		            if(data.data[i].opcion == 1){ opcion='Cita';}else{opcion='Llamada';}
		            if(data.data[i].id_tipo_cat == 1){ status='Vendida';}else if(data.data[i].id_tipo_cat == 2){status='Rentada';}else if(data.data[i].id_tipo_cat == 3){status='Promesa';}else if(data.data[i].id_tipo_cat == 4){status='Negociacion';}
		            html +="<tr>";
		            html +="<td>"+status+"</td>";
		            html +="<td>"+opcion+"</td>";
		            html +="<td>"+data.data[i].fecha+"</td>";
		            html +="<td>"+data.data[i].comentario+"</td>";
		            html +="<td>"+data.data[i].encargado+"</td>";
		            html +="<td>"+data.data[i].interesado+"</td>";
		            html +="<td>"+data.data[i].telefono+"</td>";
		            html +="<td>"+data.data[i].email+"</td>";
		            html +="</tr>";
		            }
		            html += "</tbody></table>";
		            $("#table_reporte").html(html);
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
//=======================================================================================================//
	});
</script>