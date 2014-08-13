<?php  
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega, a.cita_propiedad, a.comment_preliminar FROM proceso_cartera a WHERE id_cartera='$id' ";
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
<div class="col-xs-12 col-md-9">
	<form action="procesos/save_proceso_2_1.php" method="POST" class="form-inline" role="form">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Datos del Inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
			Tipo de inmueble 
			<select name="tipo_inmueble" id="tipo_inmueble" class="form-control" required>
				<option value="">..selecciona..</option>
				<option value="CASA">CASA</option>
				<option value="TERRENO">TERRENO</option>
				<option value="LOCAL COMERCIAL">LOCAL COMERCIAL</option>
				<option value="DEPARTAMENTO">DEPARTAMENTO</option>
				<option value="OFICINA">OFICINA</option>
			</select> 
			con Terreno de <input type="text" class="form-control" name="terreno_m" id="terreno_m" placeholder="metros" > m2, 
			con dimensiones de terreno <input type="text" class="form-control" name="dimension_1" id="dimension_1" placeholder="dimension" >m 
			por <input type="text" class="form-control" name="dimension_2" id="dimension_2" placeholder="dimension" >m, 
			con construccion de <input type="text" class="form-control" name="construccion_m" id="construccion_m" placeholder="metros" >m2, 
			con <input type="text" class="form-control" name="recamaras" id="recamaras" placeholder="Cuantas Recamaras?" > Recamaras, 
			<input type="text" class="form-control" name="bano" id="bano" placeholder="Baños" > Baños, 
			<input type="text" class="form-control" name="nivel" id="nivel" placeholder="niveles" > niveles, 
			ampliacion <input type="text" class="form-control" name="ampli" id="ampli" placeholder="metro" >m2, 
			Terreno excedente <input type="text" class="form-control" name="excendente" id="excendente" placeholder="metros" >m2, 
			Material de construccion <input type="text" class="form-control" name="material" id="material" placeholder="material" >, 
			cuenta con aislamiento? <input type="text" class="form-control" name="resp_1" id="resp_1" placeholder="si o no" >, 
			Amueblada <input type="text" class="form-control" name="resp_2" id="resp_2" placeholder="si o no" >, 
			Semi amueblada <input type="text" class="form-control" name="resp_3" id="resp_3" placeholder="si o no" >, 
			Gasto Máximo de Energia Eléctrica en Verano <input type="text" class="form-control" name="luz" id="luz" placeholder="$$" >. 
			Con equipo y accesorios adiccionales como se describe a continuación: 
			<br><textarea class="form-control" name="descripcion_1" id="descripcion_1" cols="100" rows="3" ></textarea>.	
	  	</div>
	</div>
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones legales del inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
	  		El inmueble antes mencionado se encuentra <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Direccion" >
	  		e inscrito en el R.P.P.C. bajo el nombre <input type="text" class="form-control" name="titular" id="titular" placeholder="A nombre de:" >
	  	</div>
	 </div>
	 <div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones para la gestión de venta o renta:</h3>
	  	</div>
	  	<div class="panel-body">
	  		Se pacta un precio de venta <input type="radio" name="ve_re" id="ve_re" class="form-control" value="1" >
	  		/ renta <input type="radio" name="ve_re" id="ve_re" class="form-control" value="2" > de <input type="text" name="precio" id="precio" class="form-control" placeholder="$$$" >
	  		con una comisión de venta del <input type="text" name="comision" id="comision" class="form-control" placeholder="Comision %" >%, 
	  		bajo las siguientes condiciones
	  		<br><textarea name="descripcion_2" id="descripcion_2" cols="100" rows="3" class="form-control" ></textarea>
	  		y se autoriza la promoción del inmueble antes señalado durante un plazo de <input type="text" name="meses" id="meses" class="form-control" placeholder="Meses" >Meses a partir de <input type="date" name="mes_inicio" id="mes_inicio" class="form-control" > hasta <input type="date" name="mes_fin" id="mes_fin" class="form-control" >
	  	</div>
	  	<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>" >
	  	<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
	  	<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
	  	<div class="panel-footer"><input type="submit" class="btn btn-primary" value="Aceptar"></div>
	 </div>
	</form>
</div>
<div class="col-md-3">
	<form action="update_fecha.php" method="POST" id="form_fecha" name="form_fecha">
		<label for="fecha_inicio">Fecha de Inicio</label>
		<br>
		<input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" readonly="readonly" value="<?php echo $row['fecha']; ?>">
		<br>
		<label for="fecha_entrega">Fecha de Entrega</label>
		<br>
		<input type="date" class="form-control" <?php if($proceso == false) { ?> disabled <?php } ?> name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
		<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
		<br>
		<input type="submit" class="btn btn-success" <?php if($proceso == false) { ?> disabled <?php } ?> id="submit_fecha" value="Cambiar Fecha Entrega">
		<br>
		<div id="result_fecha"></div>
	</form>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script>
	$(function() {
		 
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
	});
</script>