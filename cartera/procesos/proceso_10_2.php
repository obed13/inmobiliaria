<?php  
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega,EXTRACT(DAY FROM a.contrato_inicio) inicio,EXTRACT(DAY FROM a.contrato_fin) fin FROM proceso_cartera a WHERE id_cartera='$id' ";
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
	<form action="procesos/save_proceso_10_2.php" method="POST">
		<div class="panel panel-primary">
		  	<!-- Default panel contents -->
		  	<div class="panel-heading">Acuerdos Resultado de Reporte Bimestral:</div>
			<table border="0" class="table">
				<tr>
					<td align="center">
						<textarea name="acuerdo_reporte" <?php if($proceso == false) { ?> disabled <?php } ?> id="acuerdo_reporte" cols="40" rows="10" required></textarea>
						<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
						<input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
					</td>
				</tr>
			</table>
			<div class="panel-footer"><input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar"></div>
		</div>
	</form>
</div>
<div class="col-xs-12 col-md-4">
	<form action="update_fecha.php" method="POST" class="form-inline" id="form_fecha" name="form_fecha">
		<label for="fecha_entrega">Fecha de Entrega</label>
		<input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" readonly="readonly" value="<?php echo $row['fecha_entrega']; ?>">
		<label for="">El Contrato se Vence en:</label>
		<input type="text" class="form-control" readonly="readonly" value="<?php echo $row['diferencia']; ?> Dias">
	</form>
	<form action="" method="POST" id="form_nuevo">
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
		<br>
		<input type="submit" class="btn btn-info" id="btn" disabled="disabled" value="Aceptar">
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
	});
</script>