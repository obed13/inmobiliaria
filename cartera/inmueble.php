<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	require_once '../conexion.php';
	require_once '../sesion.php';
	$conexion = conectar();

	$id = $_GET['id'];

	$sql = "
	  	SELECT * FROM datos_inmuebles WHERE id_cartera='".$id."'
	";
	$proceso = $conexion->query($sql);
	$dato = $proceso->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Datos de Inmueble</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  	<link rel="stylesheet" href="../css/dashboard.css">
  	<link rel="stylesheet" href="../css/estilo.css">
  	<link rel="stylesheet" href="../css/opa-icons.css">
	<!-- JavaScript -->
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.deskform.js"></script>
</head>
<body>
<?php include_once 'menu_bar.php'; ?>
<div class="container-fluid">
<h3 class="sub-header"><a href="cartera.php?id=<?php echo $_GET['id']; ?>"><span class="icon32 icon-color icon-arrowthick-w" title="Regresar"></span></a>Regresar</h3>
<div class="col-sm-9 col-md-10 col-md-offset-1 main">
	<form action="save_inmueble.php" method="POST" class="form-inline" role="form">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Datos del Inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
			Tipo de inmueble
			<select name="tipo_inmueble" id="tipo_inmueble" class="form-control" required >
				<option value="">..selecciona..</option>
				<option value="CASA" <?php if ($dato['tipo_mueble'] == 'CASA') {echo "selected='selected' ";} ?>>CASA</option>
				<option value="TERRENO" <?php if ($dato['tipo_mueble'] == 'TERRENO') {echo "selected='selected' ";} ?>>TERRENO</option>
				<option value="LOCAL COMERCIAL" <?php if ($dato['tipo_mueble'] == 'LOCAL COMERCIAL') {echo "selected='selected' ";} ?>>LOCAL COMERCIAL</option>
				<option value="DEPARTAMENTO" <?php if ($dato['tipo_mueble'] == 'DEPARTAMENTO') {echo "selected='selected' ";} ?>>DEPARTAMENTO</option>
				<option value="OFICINA" <?php if ($dato['tipo_mueble'] == 'OFICINA') {echo "selected='selected' ";} ?>>OFICINA</option>
			</select>
			con Terreno de <input type="text" class="form-control" name="terreno_m" id="terreno_m" placeholder="metros" value="<?php echo $dato['terreno_2']; ?>" > m2, 
			con dimensiones de terreno <input type="text" class="form-control" name="dimension_1" id="dimension_1" placeholder="dimension" value="<?php echo $dato['dimension_1']; ?>" >m 
			por <input type="text" class="form-control" name="dimension_2" id="dimension_2" placeholder="dimension"value="<?php echo $dato['dimension_2']; ?>" >m, 
			con construccion de <input type="text" class="form-control" name="construccion_m" id="construccion_m" placeholder="metros" value="<?php echo $dato['construccion_m']; ?>" >m2, 
			con <input type="text" class="form-control" name="recamaras" id="recamaras" placeholder="Cuantas Recamaras?" value="<?php echo $dato['recamaras']; ?>" > Recamaras, 
			<input type="text" class="form-control" name="bano" id="bano" placeholder="Baños" value="<?php echo $dato['bano']; ?>" > Baños, 
			<input type="text" class="form-control" name="nivel" id="nivel" placeholder="niveles" value="<?php echo $dato['nivel']; ?>" > niveles, 
			ampliacion <input type="text" class="form-control" name="ampli" id="ampli" placeholder="metro" value="<?php echo $dato['ampli']; ?>" >m2, 
			Terreno excedente <input type="text" class="form-control" name="excendente" id="excendente" placeholder="metros" value="<?php echo $dato['excendente']; ?>" >m2, 
			Material de construccion <input type="text" class="form-control" name="material" id="material" placeholder="material" value="<?php echo $dato['material']; ?>" >, 
			cuenta con aislamiento? <input type="text" class="form-control" name="resp_1" id="resp_1" placeholder="si o no" value="<?php echo $dato['resp_1']; ?>" >, 
			Amueblada <input type="text" class="form-control" name="resp_2" id="resp_2" placeholder="si o no" value="<?php echo $dato['resp_2']; ?>" >, 
			Semi amueblada <input type="text" class="form-control" name="resp_3" id="resp_3" placeholder="si o no" value="<?php echo $dato['resp_3']; ?>" >, 
			Gasto Máximo de Energia Eléctrica en Verano <input type="text" class="form-control" name="luz" id="luz" placeholder="$$" value="<?php echo $dato['luz']; ?>" >. 
			Con equipo y accesorios adiccionales como se describe a continuación: 
			<br><textarea class="form-control" name="descripcion_1" id="descripcion_1" cols="100" rows="3" ><?php echo $dato['descripcion_1']; ?></textarea>.
	  	</div>
	</div>
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones legales del inmueble:</h3>
	  	</div>
	  	<div class="panel-body">
	  		El inmueble antes mencionado se encuentra <select name="gravamen" id="gravamen" class="form-control" required >
	  			<option value="">..selecciona..</option>
				<option value="CON" <?php if ($dato['gravamen'] == 'CON') {echo "selected='selected' ";} ?> >CON</option>
				<option value="SIN" <?php if ($dato['gravamen'] == 'SIN') {echo "selected='selected' ";} ?> >SIN</option>
			</select> gravamen
	  		<select name="opcion" id="opcion" class="form-control">
	  		<option value="Infonavit" <?php if ($dato['opcion'] == 'Infonavit') {echo "selected='selected' ";} ?> >Infonavit</option>
	  		<option value="Bancaria" <?php if ($dato['opcion'] == 'Bancaria') {echo "selected='selected' ";} ?> >Bancaria</option></select> por la cantidad de <input type="text" name="cantidad" id="cantidad" class="form-control" value="<?php echo $dato['cantidad']; ?>" placeholder="$$$"> <input type="radio" name="moneda" id="moneda" <?php if ($dato['moneda'] == 1) {echo "checked";} ?> class="form-control" value="1">Pesos <input type="radio" name="moneda" <?php if ($dato['moneda'] == 2) {echo "checked";} ?> id="moneda" class="form-control" value="2">Dolares e inscrito en el R.P.P.C. bajo el nombre <input type="text" class="form-control" name="titular" id="titular" value="<?php echo $dato['titular']; ?>" placeholder="A nombre de:" >
	  	</div>
	 </div>
	 <div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Condiciones para la gestión de venta o renta:</h3>
	  	</div>
	  	<div class="panel-body">
	  		Se pacta un precio de venta <input type="radio" name="ve_re" id="ve_re" <?php if ($dato['ve_re'] == 1) {echo "checked";} ?> class="form-control" value="1" >
	  		/ renta <input type="radio" name="ve_re" id="ve_re" <?php if ($dato['ve_re'] == 2) {echo "checked";} ?> class="form-control" value="2" > de <input type="text" name="precio" id="precio" class="form-control" placeholder="$$$" value="<?php echo $dato['precio']; ?>" > <input type="radio" name="moneda2" id="moneda2" <?php if ($dato['moneda2'] == 1) {echo "checked";} ?> class="form-control" value="1">Pesos <input type="radio" name="moneda2" <?php if ($dato['moneda2'] == 2) {echo "checked";} ?> id="moneda2" class="form-control" value="2">Dolares
	  		con una comisión de venta del <input type="text" name="comision" id="comision" class="form-control" placeholder="Comision %" value="<?php echo $dato['comision']; ?>"  required >%, 
	  		bajo las siguientes condiciones
	  		<br><textarea name="descripcion_2" id="descripcion_2" cols="100" rows="3" class="form-control" ><?php echo $dato['descripcion_2']; ?></textarea>
	  		y se autoriza la promoción del inmueble antes señalado durante un plazo de <input type="text" name="meses" id="meses" class="form-control" placeholder="Meses" value="<?php echo $dato['meses']; ?>" >Meses a partir de <input type="date" name="mes_inicio" id="mes_inicio" class="form-control" value="<?php echo $dato['mes_inicio']; ?>" > hasta <input type="date" name="mes_fin" id="mes_fin" class="form-control" value="<?php echo $dato['mes_fin']; ?>" >
	  	</div>
	  	<div class="panel panel-primary">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Forma de Contactar al Interesado</h3>
		  	</div>
		  	<div class="panel-body">
		  		<label for="nombre">Nombre:</label>
		  		<br>
		  		<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" value="<?php echo $dato['nombre']; ?>" />
		  		<br>
		  		<label for="apellidos">Apellidos:</label>
		  		<br>
		  		<input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="<?php echo $dato['apellidos']; ?>" />
		  		<br>
		  		<label for="tel_casa">Tel Casa: </label>
		  		<br>
		  		<input type="text" name="tel_casa" id="tel_casa" class="form-control" placeholder="Telefono de Casa" value="<?php echo $dato['tel_casa']; ?>" />
		  		<br>
		  		<label for="movil">Celular:</label>
		  		<br>
		  		<input type="text" name="movil" id="movil" class="form-control" placeholder="Telefono Celular" value="<?php echo $dato['movil']; ?>" />
		  		<br>
		  		<label for="email">Email:</label>
		  		<br>
		  		<input type="email" name="email" id="email" class="form-control" placeholder="Correo Electronico" value="<?php echo $dato['email']; ?>" />
		  		<br>
		  	</div>
	  	</div>
	  	<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>" >
	  	<div class="panel-footer"><input type="submit" class="btn btn-primary" value="Aceptar"></div>
	 </div>
	</form>
</div>
</div>

<!-- JavaScript -->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>