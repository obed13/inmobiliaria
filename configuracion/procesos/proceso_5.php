<?php
	$sql = "SELECT * FROM proceso_cartera WHERE id_cartera='$id' ";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array();
	$msj = $_GET['msj'];
	if ($msj == 3) {
		$msj ="<div class='alert alert-danger'>No has Agregado Fotos de la Casa</div>";
	}
?>
<div class="col-xs-12 col-md-6">
	<?php echo $msj; ?>
	<form id="frm" method="post" enctype="multipart/form-data" action='procesos/processImage.php'>
		<table border="0" class="table table-striped">
			<tr>
				<td><label>Seleccione sus Fotos</label></td>
				<td>
					<div id='imgLoading' style='display:none'><img src="../img/loading.gif" alt="Uploading...."/></div>
					<div id='ingLoadButton'>
				        <div class="file_browser">
				            <input type="file" name="deskImg" id="deskImg" class="hide_broswe" />
				            <input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
				        </div>
				    </div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id='displayImg'></div>
				</td>
			</tr>
		</table>
	</form>
	<form action="procesos/save_proceso_5.php" method="POST" enctype="multipart/form-data">
		<table class="table table-striped">
			<tr>
				<td><label for="foto_preliminar">Tomar Fotos preliminares:</label></td>
				<td>
					<input type="checkbox" <?php if($row['foto_preliminar'] == 1) { ?> checked <?php } ?> name="foto_preliminar" id="foto_preliminar" value="1" required>
				</td>
			</tr>
			<tr>
				<td><label for="revision_cond_preliminar">Revision de Condiciones Preliminares:</label></td>
				<td><input type="checkbox" <?php if($row['revision_cond_preliminar'] == 1) { ?> checked <?php } ?> name="revision_cond_preliminar" id="revision_cond_preliminar" value="1" required></td>
			</tr>
			<tr>
				<td><label for="criterios_elab_contrato">Criterios Importantes para Elaborar Contrato de Prestacion de Servicios:</label></td>
				<td>
					<textarea name="criterios_elab_contrato" id="criterios_elab_contrato" cols="40" rows="5" required><?php echo$row['criterios_elab_contrato']?></textarea>
					<input type="hidden" name="id_cartera" id="id_cartera" value="<?php echo $id; ?>">
					<input type="hidden" name="fecha_entrega" id="fecha_entregas" value="<?php echo $row['fecha_entrega']; ?>">
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['uid']; ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" <?php if($proceso == false) { ?> disabled <?php } ?> class="btn btn-primary" id="submit_proceso" value="Aceptar"></td>
			</tr>
		</table>
	</form>
</div>

<script>
	$(function() {
		$('#deskImg').off('click').on('change', function(){
			$("#frm").ajaxForm({target: '#displayImg',
			    beforeSubmit:function(){
                    //console.log('v');
                    $("#imgLoading").show();
                    $("#ingLoadButton").hide();
				},
				success:function(){
                    //console.log('z');
                    $("#imgLoading").hide();
                    $("#ingLoadButton").show();
				},
				error:function(){
                    //console.log('d');
                    $("#imgLoading").hide();
                    $("#ingLoadButton").show();
				}
            }).submit();
		});
	});
</script>