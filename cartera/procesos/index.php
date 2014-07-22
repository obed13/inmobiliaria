<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="col-md-4 col-md-offset-4">
		<form action="procesos/save_proceso.php" method="POST">
			<input type="hidden" name="id_cartera" value="<?php echo $tituloCartera['id_cartera'];?>">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="submit" class="btn btn-primary" value="Pasar al proceso">
		</form>
	</div>
</body>
</html>