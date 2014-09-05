<?php  
	$sql = "SELECT DATE_FORMAT(a.fecha_inicio, '%d-%m-%Y') fecha, a.fecha_entrega,EXTRACT(DAY FROM a.contrato_inicio) inicio,EXTRACT(DAY FROM a.contrato_fin) fin FROM proceso_cartera a WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$sqlcampana = "SELECT * FROM campana a WHERE id_cartera='$id' AND campana='1' ";
	$result = $conexion->query($sqlcampana);
	$sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='3' ";
	$resultcat = $conexion->query($sqlcat);
	$nomcat = $resultcat->fetch_array();
	if ($_SESSION['id_cat'] != 3 && $_SESSION['id_cat'] != 1) {
		echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
		$proceso = false;
	}
?>
<div class="col-xs-12 col-md-9">
	<div class="table-responsive">
	<form action="" method="POST" id="form_fecha" class="form-inline" name="form_fecha">
		<label for="fecha_entrega">Fecha de Entrega:</label>
		<input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" readonly="readonly" value="<?php echo $row['fecha_entrega']; ?>">
	</form>
	<br>
	<form action="procesos/save_proceso_8.php" method="POST" name="formulario" role="form">
		<table border="0" class="table table-striped">
			<tr>
				<td><label for="publicitar_inicio">Publicitar (Campaña Inicial)</label></td>
				<td><label for="publicitar_inicio">Negado</label></td>
				<td><label for="publicitar_inicio">Aprobado</label></td>
				<td colspan="2"><label for="publicitar_inicio">Fecha de Publicacion</label></td>
			</tr>
<?php while ($campana = $result->fetch_array()) { ?>
			<tr>
				<td><label for="bolsa_ampi">Bolsa Inmobiliaria AMPI y CRM, MLS: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="bolsa_ampi" <?php if ($campana['bolsa_ampi'] == 2) {?> checked="checked" <?php } ?> id="bolsa_ampi" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="bolsa_ampi" <?php if ($campana['bolsa_ampi'] == 1) {?> checked="checked" <?php } ?> id="bolsa_ampi" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="bolsa_ampi_btn" <?php if ($campana['bolsa_btn'] == 1) {?> checked="checked" <?php } ?> id="bolsa_ampi_btn" value="1" onclick="document.formulario.bolsa_ampi_fecha.disabled=!document.formulario.bolsa_ampi_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="bolsa_ampi_fecha" value="<?php echo $campana['bolsa_fecha']; ?>" id="bolsa_ampi_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="portal_crm">10 Portales de Internet CRM: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="portal_crm" <?php if ($campana['portal_crm'] == 2) {?> checked="checked" <?php } ?> id="portal_crm" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="portal_crm" <?php if ($campana['portal_crm'] == 1) {?> checked="checked" <?php } ?> id="portal_crm" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="portal_crm_btn" <?php if ($campana['portal_btn'] == 1) {?> checked="checked" <?php } ?> id="portal_crm_btn" value="1" onclick="document.formulario.portal_crm_fecha.disabled=!document.formulario.portal_crm_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="portal_crm_fecha" value="<?php echo $campana['portal_fecha']; ?>" id="portal_crm_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="revista">Revista Bussines & Home: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="revista" <?php if ($campana['revista'] == 2) {?> checked="checked" <?php } ?> id="revista" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="revista" <?php if ($campana['revista'] == 1) {?> checked="checked" <?php } ?> id="revista" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="revista_btn" <?php if ($campana['revista_btn'] == 1) {?> checked="checked" <?php } ?> id="revista_btn" value="1" onclick="document.formulario.revista_fecha.disabled=!document.formulario.revista_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="revista_fecha" value="<?php echo $campana['revista_fecha']; ?>" id="revista_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="venta_brokers">Fuerza de Ventas Brokers Aliados: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="venta_brokers" <?php if ($campana['venta_brokers'] == 2) {?> checked="checked" <?php } ?> id="venta_brokers" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="venta_brokers" <?php if ($campana['venta_brokers'] == 1) {?> checked="checked" <?php } ?> id="venta_brokers" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="venta_brokers_btn" <?php if ($campana['venta_btn'] == 1) {?> checked="checked" <?php } ?> id="venta_brokers_btn" value="1" onclick="document.formulario.venta_brokers_fecha.disabled=!document.formulario.venta_brokers_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="venta_brokers_fecha" value="<?php echo $campana['venta_fecha']; ?>" id="venta_brokers_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="periodico">Periódicos (2 veces por semana jueves-domingos): </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="periodico" <?php if ($campana['periodico'] == 2) {?> checked="checked" <?php } ?> id="periodico" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="periodico" <?php if ($campana['periodico'] == 1) {?> checked="checked" <?php } ?> id="periodico" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="periodico_btn" <?php if ($campana['periodico_btn'] == 1) {?> checked="checked" <?php } ?> id="periodico_btn" value="1" onclick="document.formulario.periodico_fecha.disabled=!document.formulario.periodico_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="periodico_fecha" value="<?php echo $campana['periodico_fecha']; ?>" id="periodico_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="web">Nuestra pagina Web: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="web" <?php if ($campana['web'] == 2) {?> checked="checked" <?php } ?> id="web" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="web" <?php if ($campana['web'] == 1) {?> checked="checked" <?php } ?> id="web" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="web_btn" <?php if ($campana['web_btn'] == 1) {?> checked="checked" <?php } ?> id="web_btn" value="1" onclick="document.formulario.web_fecha.disabled=!document.formulario.web_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="web_fecha" value="<?php echo $campana['web_fecha']; ?>" id="web_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="letrero">Letrero Pedestal en Propiedad: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="letrero" <?php if ($campana['letrero'] == 2) {?> checked="checked" <?php } ?> id="letrero" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="letrero" <?php if ($campana['letrero'] == 1) {?> checked="checked" <?php } ?> id="letrero" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="letrero_btn" <?php if ($campana['letrero_btn'] == 1) {?> checked="checked" <?php } ?> id="letrero_btn" value="1" onclick="document.formulario.letrero_fecha.disabled=!document.formulario.letrero_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="letrero_fecha" value="<?php echo $campana['letrero_fecha']; ?>" id="letrero_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="redes_sociales">Redes Sociales (facebook, ect): </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="redes_sociales" <?php if ($campana['redes_sociales'] == 2) {?> checked="checked" <?php } ?> id="redes_sociales" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="redes_sociales" <?php if ($campana['redes_sociales'] == 1) {?> checked="checked" <?php } ?> id="redes_sociales" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="redes_sociales_btn" <?php if ($campana['redes_btn'] == 1) {?> checked="checked" <?php } ?> id="redes_sociales_btn" value="1" onclick="document.formulario.redes_sociales_fecha.disabled=!document.formulario.redes_sociales_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="redes_sociales_fecha" value="<?php echo $campana['redes_fecha']; ?>" id="redes_sociales_fecha" disabled></td>
			</tr>
			<tr>
				<td><label for="evento_open_house">Evento Open House: </label></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="evento_open_house" <?php if ($campana['evento_open_house'] == 2) {?> checked="checked" <?php } ?> id="evento_open_house" value="2"></td>
				<td><input type="radio" <?php if($proceso == false) { ?> disabled <?php } ?> name="evento_open_house" <?php if ($campana['evento_open_house'] == 1) {?> checked="checked" <?php } ?> id="evento_open_house" value="1"></td>
				<td><input type="checkbox" <?php if($proceso == false) { ?> disabled <?php } ?> name="evento_open_house_btn" <?php if ($campana['evento_btn'] == 1) {?> checked="checked" <?php } ?> id="evento_open_house_btn" value="1" onclick="document.formulario.evento_open_house_fecha.disabled=!document.formulario.evento_open_house_fecha.disabled" ></td>
				<td><input type="date" class="form-control" name="evento_open_house_fecha" value="<?php echo $campana['evento_fecha']; ?>" id="evento_open_house_fecha" disabled></td>
			</tr>
<?php } ?>
			<tr>
				<td colspan="5">
					<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
					<input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $row['fecha_entrega']; ?>">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					<input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar">
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
<script src="../js/jquery-1.10.2.js"></script>