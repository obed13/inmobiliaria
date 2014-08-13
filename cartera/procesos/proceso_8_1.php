<?php  
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega,datediff(a.contrato_fin, a.contrato_inicio) as diferencia FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='3' ";
	$resultcat = $conexion->query($sqlcat);
	$nomcat = $resultcat->fetch_array();
	if ($_SESSION['id_cat'] != 3 && $_SESSION['id_cat'] != 1) {
		echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
		$proceso = false;
	}
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_8_1.php" method="POST">
		<div class="panel panel-primary">
		  	<!-- Default panel contents -->
		  	<div class="panel-heading"><u>Campaña Inicial:</u> Reporte Bimestral de Actividades:</div>
			<table border="0" class="table">
				<tr>
					<td align="center">
						<textarea name="reporte_mensual" <?php if($proceso == false) { ?> disabled <?php } ?> id="reporte_mensual" cols="30" rows="10" required></textarea>
						<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
						<input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
						<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					</td>
				</tr>
			</table>
			<div class="panel-footer"><input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar"></div>
		</div>
	</form>
</div>
<div class="col-md-4">
	<form action="update_fecha.php" class="form-inline" method="POST" id="form_fecha" name="form_fecha">
		<label for="fecha_entrega">Fecha de Entrega:</label>
		<input type="date" class="form-control"  name="fecha_entrega" id="fecha_entrega" readonly="readonly" value="<?php echo $row['fecha_entrega']; ?>">
		<label for="">El Contrato se Vence en:</label>
		<input type="text" class="form-control" readonly="readonly" value="<?php echo $row['diferencia']; ?> Dias">
	</form>
	<form action="update_datos.php" method="POST" id="form_nuevo">
		<label for="">Cambio de Precio:</label>
		<br>
		<label class="radio-inline">
		  <input type="radio" name="new_precio" <?php if($proceso == false) { ?> disabled <?php } ?> id="new_precio1" value="si"> Si
		</label>
		<label class="radio-inline">
		  <input type="radio" name="new_precio" <?php if($proceso == false) { ?> disabled <?php } ?> id="new_precio2" value="no" checked> No
		</label>
		<input type="text" name="new_cash" <?php if($proceso == false) { ?> disabled <?php } ?> id="new_cash" class="form-control" placeholder="Nuevo Precio $$$" required>
		<br>
		<label for="">Nuevo Contrato:</label>
		<br>
		<label class="radio-inline">
		  <input type="radio" name="contrato" <?php if($proceso == false) { ?> disabled <?php } ?> id="contrato1" value="si"> Si
		</label>
		<label class="radio-inline">
		  <input type="radio" name="contrato" <?php if($proceso == false) { ?> disabled <?php } ?> id="contrato2" value="no" checked> No
		</label>
		<input type="date" name="new_contrato" <?php if($proceso == false) { ?> disabled <?php } ?> id="new_contrato" class="form-control" required>
		<input type="hidden" name="id_cartera" value="<?php echo $id; ?>" >
		<br>
		<input type="submit" class="btn btn-info" <?php if($proceso == false) { ?> disabled <?php } ?> id="btn" disabled="disabled" value="Aceptar">
		<div id="result"></div>
	</form>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script>
	$(function() {
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
	});
</script>