<?php  
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='2' ";
	$resultcat = $conexion->query($sqlcat);
	$nomcat = $resultcat->fetch_array();
	if ($_SESSION['id_cat'] != 2 && $_SESSION['id_cat'] != 1) {
		echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
		$proceso = false;
	}
?>
<div class="col-xs-12 col-md-7">
	<form action="procesos/save_proceso_6.php" method="POST" enctype="multipart/form-data">
		<table class="table table-striped">
			<tr>
				<td><label for="elab_contrato">Elaborar Contrato de Prestacion de Servicios:</label></td>
				<td>
					<input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="elab_contrato" id="elab_contrato" value="1" required>
				</td>
			</tr>
			<tr>
				<td><label for="recabar_firmas">Recabar Firmas para Contrato:</label></td>
				<td>
					<input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="recabar_firmas" id="recabar_firmas" value="1" required>
					<input type="file" name="archivo" id="archivo" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td><label for="firma_aviso_privacidad">Firma de Aviso de Privacidad:</label></td>
				<td>
					<input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="firma_aviso_privacidad" id="firma_aviso_privacidad" value="1" required>
					<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
					<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
				</td>
			</tr>
			<tr>
				<td><label for="contrato_inicio">Fecha de Contrato Inicio:</label></td>
				<td><input type="date" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="contrato_inicio" id="contrato_inicio" required></td>
			</tr>
			<tr>
				<td><label for="contrato_fin">Fecha de Contrato Fin:</label></td>
				<td><input type="date" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="contrato_fin" id="contrato_fin" required></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar"></td>
			</tr>
		</table>
	</form>
</div>
<div class="col-md-3 ">
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
		<input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-success" id="submit_fecha" value="Guardar Fecha de Entrega">
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