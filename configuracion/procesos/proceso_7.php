<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$sqlcat = "SELECT nom_cat FROM categoria WHERE id_cat='4' ";
	$resultcat = $conexion->query($sqlcat);
	$nomcat = $resultcat->fetch_array();
	if ($_SESSION['id_cat'] != 4 && $_SESSION['id_cat'] != 1) {
		echo  "<div class='col-md-12'><div class='alert alert-danger'>Espere hasta que la persona de <u><b>".$nomcat['nom_cat']."</b></u> rellenar este proceso!!</div></div>";
		$proceso = false;
	}
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_7.php" method="POST">
		<table border="0" class="table table-striped">
			<tr>
				<td><label for="poner_lona">Poner Lona y Fotos Finales:</label></td>
				<td><input type="checkbox" <?php if($row['poner_lona'] == 1) { ?> checked <?php } ?> name="poner_lona" id="poner_lona" value="1" required></td>
			</tr>
			<tr>
				<td><label for="crm">Dar de Alta en CRM y MLS AMPIRED:</label></td>
				<td><input type="checkbox" <?php if($row['crm'] == 1) { ?> checked <?php } ?> name="crm" id="crm" value="1" required></td>
			</tr>
		</table>
		<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
		<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
		<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
		<input type="submit"  class="btn btn-primary" id="submit_proceso" value="Aceptar">
		<br><br>
	</form>
</div>

<script src="../js/jquery-1.10.2.js"></script>