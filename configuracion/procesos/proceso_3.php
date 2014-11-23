<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
?>
<div class="col-xs-12 col-md-4">
	<form action="procesos/save_proceso_3.php" method="POST">
		<label for="acuerdo_previo">Acuerdo Previo a Contrato:</label>
		<br>
		<input type="checkbox" <?php if($row['acuerdo_previo'] == 1) { ?> checked <?php } ?> name="acuerdo_previo" id="acuerdo_previo" value="1" required>
		<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
		<br>
		<label for="acuerdo_comment">Comentario:</label>
		<br>
		<textarea name="acuerdo_comment"  id="acuerdo_comment" cols="40" rows="5"><?php echo $row['acuerdo_comment']?></textarea>
		<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
		<br>
		<input type="submit" class="btn btn-primary" id="submit_proceso" value="Aceptar">
	</form>
</div>