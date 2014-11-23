<?php
	$sql = "SELECT * FROM datos_inmuebles WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
?>
<div class="col-xs-12 col-md-9">
	<form action="procesos/save_proceso_2_1.php" method="POST" class="form-inline" role="form">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Datos del Inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
			Tipo de inmueble
			<select name="tipo_inmueble" id="tipo_inmueble" class="form-control" required >
				<option <?php if($row['tipo_mueble'] == "CASA"){ ?>selected<?php } ?> value="CASA">CASA</option>
				<option <?php if($row['tipo_mueble'] == "TERRENO"){ ?>selected<?php } ?> value="TERRENO">TERRENO</option>
				<option <?php if($row['tipo_mueble'] == "LOCAL COMERCIAL"){ ?>selected<?php } ?> value="LOCAL COMERCIAL">LOCAL COMERCIAL</option>
				<option <?php if($row['tipo_mueble'] == "DEPARTAMENTO"){ ?>selected<?php } ?> value="DEPARTAMENTO">DEPARTAMENTO</option>
				<option <?php if($row['tipo_mueble'] == "OFICINA"){ ?>selected<?php } ?> value="OFICINA">OFICINA</option>
			</select>
			con Terreno de <input type="text" class="form-control" name="terreno_m" id="terreno_m" placeholder="metros" value="<?php echo $row['terreno_2'];?>" > m2,
			con dimensiones de terreno <input type="text" class="form-control" name="dimension_1" id="dimension_1" placeholder="dimension" value="<?php echo $row['dimension_1'];?>" >m
			por <input type="text" class="form-control" name="dimension_2" id="dimension_2" placeholder="dimension" value="<?php echo $row['dimension_2'];?>" >m,
			con construccion de <input type="text" class="form-control" name="construccion_m" id="construccion_m" placeholder="metros" value="<?php echo $row['construccion_m'];?>" >m2,
			con <input type="text" class="form-control" name="recamaras" id="recamaras" placeholder="Cuantas Recamaras?" value="<?php echo $row['recamaras'];?>" > Recamaras,
			<input type="text" class="form-control" name="bano" id="bano" placeholder="Baños" value="<?php echo $row['bano'];?>" > Baños,
			<input type="text" class="form-control" name="nivel" id="nivel" placeholder="niveles" value="<?php echo $row['nivel'];?>" > niveles,
			ampliacion <input type="text" class="form-control" name="ampli" id="ampli" placeholder="metro" value="<?php echo $row['ampli'];?>" >m2,
			Terreno excedente <input type="text" class="form-control" name="excendente" id="excendente" placeholder="metros" value="<?php echo $row['excendente'];?>" >m2,
			Material de construccion <input type="text" class="form-control" name="material" id="material" placeholder="material" value="<?php echo $row['material'];?>" >,
			cuenta con aislamiento? <input type="text" class="form-control" name="resp_1" id="resp_1" placeholder="si o no" value="<?php echo $row['resp_1'];?>" >,
			Amueblada <input type="text" class="form-control" name="resp_2" id="resp_2" placeholder="si o no" value="<?php echo $row['resp_2'];?>" >,
			Semi amueblada <input type="text" class="form-control" name="resp_3" id="resp_3" placeholder="si o no" value="<?php echo $row['resp_3'];?>" >,
			Gasto Máximo de Energia Eléctrica en Verano <input type="text" class="form-control" name="luz" id="luz" placeholder="$$" value="<?php echo $row['luz'];?>" >.
			Con equipo y accesorios adiccionales como se describe a continuación:
			<br><textarea class="form-control" name="descripcion_1" id="descripcion_1" cols="100" rows="3" ><?php echo $row['descripcion_1'];?></textarea>.
	  	</div>
	</div>
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones legales del inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
	  		El inmueble antes mencionado se encuentra <input type="text" class="form-control" name="gravamen" id="gravamen" placeholder="CON o SIN" value="<?php echo $row['gravamen'];?>" > gravamen
	  		<select name="opcion" id="opcion" class="form-control"> <option value="">-- Seleccione --</option>
	  		<option <?php if($row['opcion'] == "Infonavit"){ ?>selected<?php } ?> value="Infonavit">Infonavit</option>
	  		<option <?php if($row['opcion'] == "Bancaria"){ ?>selected<?php } ?> value="Bancaria">Bancaria</option></select> por la cantidad de <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="$$$" value="<?php echo $row['cantidad'];?>" > e inscrito en el R.P.P.C. bajo el nombre <input type="text" class="form-control" name="titular" id="titular" placeholder="A nombre de:" value="<?php echo $row['titular'];?>" >
	  	</div>
	 </div>
	 <div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones para la gestión de venta o renta:</h3>
	  	</div>
	  	<div class="panel-body">
	  		Se pacta un precio de venta <input type="radio" <?php if($row['ve_re'] == '1'){?>checked<?php } ?> name="ve_re" id="ve_re" class="form-control" value="1" >
	  		/ renta <input type="radio" <?php if($row['ve_re'] == '2'){?>checked<?php } ?> name="ve_re" id="ve_re" class="form-control" value="2" > de <input type="text" name="precio" id="precio" class="form-control" placeholder="$$$" value="<?php echo $row['precio'];?>" >
	  		con una comisión de venta del <input type="text" name="comision" id="comision" class="form-control" placeholder="Comision %" value="<?php echo $row['comision'];?>"  required >%, 
	  		bajo las siguientes condiciones
	  		<br><textarea name="descripcion_2" id="descripcion_2" cols="100" rows="3" class="form-control" ><?php echo $row['descripcion_2'];?></textarea>
	  		y se autoriza la promoción del inmueble antes señalado durante un plazo de <input type="text" name="meses" id="meses" class="form-control" placeholder="Meses" value="<?php echo $row['meses'];?>" >Meses a partir de <input type="date" name="mes_inicio" id="mes_inicio" class="form-control" value="<?php echo $row['mes_inicio'];?>" > hasta <input type="date" name="mes_fin" id="mes_fin" class="form-control" value="<?php echo $row['mes_fin'];?>" >
	  	</div>
	  	<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>" >
	  	<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
	  	<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
	  	<div class="panel-footer"><input type="submit" class="btn btn-primary" value="Aceptar"></div>
	 </div>
	</form>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script>
	$(function() {
//=========================================================================//

  $('#cantidad').mask('000,000,000.00', {reverse: true});
  $('#luz').mask('000,000,000.00', {reverse: true});
  $('#precio').mask('000,000,000.00', {reverse: true});

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