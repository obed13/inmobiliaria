<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();

	$sqlnum="SELECT (SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 1) as a,
	(SELECT count(opcion) FROM actividades WHERE id_cartera='".$id."' and opcion = 2) as b FROM actividades WHERE id_cartera='".$id."'";
	$num = $conexion->query($sqlnum);
	$numero = $num->fetch_array();

	$sqlcapana = "SELECT * FROM campana WHERE id_cartera='$id' AND campana='1' ";
	$campana = $conexion->query($sqlcapana);
	$rowcampana = $campana->fetch_array();
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_8_1.php" method="POST">
		<div class="panel panel-primary">
		  	<!-- Default panel contents -->
		  	<div class="panel-heading"><u>Campaña Inicial:</u> Reporte Bimestral de Actividades:</div>
			<table border="0" class="table">
				<tr>
					<td align="center">
						<textarea name="reporte_mensual" id="reporte_mensual" cols="30" rows="10" required><?php echo $rowcampana['reporte_mensual']; ?></textarea>
						<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
						<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
					</td>
				</tr>
			</table>
			<div class="panel-footer"><input type="submit" class="btn btn-primary" id="submit_proceso" value="Aceptar"></div>
		</div>
	</form>
</div>