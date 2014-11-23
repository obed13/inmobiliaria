<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
?>
<div class="col-xs-12 col-md-7">
	<form action="procesos/save_proceso_6.php" method="POST" enctype="multipart/form-data">
		<table class="table table-striped">
			<tr>
				<td><label for="elab_contrato">Elaborar Contrato de Prestacion de Servicios:</label></td>
				<td>
					<input type="checkbox" <?php if($row['elab_contrato'] == 1) { ?> checked <?php } ?> name="elab_contrato" id="elab_contrato" value="1" required>
				</td>
			</tr>
			<tr>
				<td><label for="recabar_firmas">Recabar Firmas para Contrato:</label></td>
				<td>
					<input type="checkbox" <?php if($row['recabar_firmas'] == 1) { ?> checked <?php } ?> name="recabar_firmas" id="recabar_firmas" value="1" required>
					<input type="file" name="archivo" id="archivo" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td><label for="firma_aviso_privacidad">Firma de Aviso de Privacidad:</label></td>
				<td>
					<input type="checkbox" <?php if($row['recabar_firmas'] == 1) { ?> checked <?php } ?> name="firma_aviso_privacidad" id="firma_aviso_privacidad" value="1" required>
					<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
					<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
				</td>
			</tr>
			<tr>
				<td><label for="contrato_inicio">Fecha de Contrato Inicio:</label></td>
				<td><input type="date"  class="form-control" name="contrato_inicio" id="contrato_inicio" value="<?php echo$row['contrato_inicio']?>" required></td>
			</tr>
			<tr>
				<td><label for="contrato_fin">Fecha de Contrato Fin:</label></td>
				<td><input type="date" class="form-control" name="contrato_fin" id="contrato_fin" value="<?php echo$row['contrato_fin']?>" required></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" class="btn btn-primary" id="submit_proceso" value="Aceptar"></td>
			</tr>
		</table>
	</form>
</div>

<script src="../js/jquery-1.10.2.js"></script>