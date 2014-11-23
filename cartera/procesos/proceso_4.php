<?php
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='3' ";
	$resultcat = $conexion->query($sqlcat);
	$nomcat = $resultcat->fetch_array();
	if ($_SESSION['id_cat'] != 3 && $_SESSION['id_cat'] != 1) {
		echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
		$proceso = false;
	}
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
				<td><input type="text" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="precio_dueno" id="precio_dueno" placeholder="Precio del Dueño" required></td>
			</tr>
			<tr>
				<td><label for="precio_sugerido">Precio Sugerido:</label></td>
				<td><input type="text" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="precio_sugerido" id="precio_sugerido" placeholder="Precio Sugerido" required></td>
				<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
				<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
			</tr>
			<tr>
				<td><label >Moneda:</label></td>
				<td>
					<select name="moneda" id="moneda" class="form-control">
						<option value="1">Pesos</option>
						<option value="2">Dolares</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="archivo">Archivo de Estimacion:</label></td>
				<td><input type="file" <?php if($proceso == false) { ?> disabled <?php } ?> class="form-control" name="archivo" id="archivo"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					<input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar">
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="col-xs-12 col-md-3 col-md-offset-1">
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
            //alert($("#moneda").val());

			if ($("#precio_dueno").val() == "") {
				$("#result").html("<div class='alert alert-danger'>Hay Campos Vacios!!!!</div>");
			}else if ($("#precio_sugerido").val() == "" ) {
				$("#result").html("<div class='alert alert-danger'>Hay Campos Vacios!!!!</div>");
			}else if ($("#moneda").val() == '' ) {
				$("#result").html("<div class='alert alert-danger'>Hay Campos Vacios!!!!</div>");
			}  else{
				$('#precio_sugerido').unmask('000,000,000', {reverse: true});
				$('#precio_dueno').unmask('000,000,000', {reverse: true});
				$("#form_archivo").submit();
			}

		});

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