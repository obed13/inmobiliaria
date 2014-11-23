<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();

	if ($_GET['msj']==1) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>No Lleno los Campos o No subir un Archivo!!</div></div>";
	}
	if ($_GET['msj']==2) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>Ha Ocurrido un Error con el Archivo!!!</div></div>";
	}
	if ($_GET['msj']==3) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>El Archivo ya Existe con el mismo Nombre!!!</div></div>";
	}
	if ($_GET['msj']==4) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>Archivo no permitido, excede el tamano!!</div></div>";
	}
	if ($_GET['msj']==5) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>Ocurrio un Error al Mover el Archivo</div></div>";
	}
	if ($_GET['msj']==6) {
		echo "<div class='col-md-12'><div class='alert alert-danger'>No se pudo Guarda Intente mas tarde</div></div>";
	}
?>
<div class="col-xs-12 col-md-6">
	<div id="result"></div>
	<form action="procesos/save_proceso_4.php" id="form_archivo" method="POST" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th colspan="2">Determinacion del Precio</th>
			</tr>
			<tr>
				<td><label for="precio_dueno">Precio del Dueño:</label></td>
				<td><input type="text" class="form-control" name="precio_dueno" id="precio_dueno" value="<?php echo$row['precio_dueno']?>" placeholder="Precio del Dueño" required></td>
			</tr>
			<tr>
				<td><label for="precio_sugerido">Precio Sugerido:</label></td>
				<td><input type="text" class="form-control" name="precio_sugerido" id="precio_sugerido" value="<?php echo$row['precio_sugerido']?>"  placeholder="Precio Sugerido" required></td>
				<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
				<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
			</tr>
			<tr>
				<td><label for="archivo">Archivo de Estimacion:</label></td>
				<td><input type="file" class="form-control" name="archivo" id="archivo"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					<input type="submit" class="btn btn-primary" id="submit_proceso" value="Aceptar">
				</td>
			</tr>
		</table>
	</form>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script>
	$(function() {
//=========================================================================//

  	$('#precio_dueno').mask('000,000,000', {reverse: true});
  	$('#precio_sugerido').mask('000,000,000', {reverse: true});
  	//$('#precio_dueno').unmask('000,000,000', {reverse: true});
	//$('#precio_sugerido').unmask('000,000,000', {reverse: true});

//=========================================================================//
		$("#submit_proceso").on('click', function(e) {
			e.preventDefault();
			/* Act on the event */

			if ($("#precio_dueno").val() == "") {
				$("#result").html("<div class='alert alert-danger'>Hay Campos Vacios!!!!</div>");
			}else if ($("#precio_sugerido").val() == "" ) {
				$("#result").html("<div class='alert alert-danger'>Hay Campos Vacios!!!!</div>");
			}  else{
				$('#precio_sugerido').unmask('000,000,000', {reverse: true});
				$('#precio_dueno').unmask('000,000,000', {reverse: true});
				$("#form_archivo").submit();
			}

		});
	});
</script>