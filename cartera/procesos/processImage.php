<?php
	require_once '../../conexion.php';
    $conexion = conectar();

$path = "../../fotos/";

function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }

	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
		$name = $_FILES['deskImg']['name'];
		$size = $_FILES['deskImg']['size'];
		$id_cartera = $_POST['id_cartera'];

		if(strlen($name))
		{
			 $ext = getExtension($name);
			if(in_array($ext,$valid_formats))
			{
				if($size<(1024*1024))
				{
					$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
					$tmp = $_FILES['deskImg']['tmp_name'];
					if(move_uploaded_file($tmp, $path.$name))
					{
					//mysql_query("UPDATE members SET avatar='$actual_image_name' WHERE id='1'");
					//mysql_query("INSERT INTO fotos(id_cartera,nom_foto)VALUES('".$id_cartera."','".$name."')");
					$sql = "INSERT INTO fotos(id_cartera,nom_foto)VALUES('".$id_cartera."','".$name."')";
					$rutas = $conexion->query($sql);

						echo "<img src='../fotos/".$name."' width='100px'  class='displayImg'>";
					}
					else
						echo "Fallo el upload al acceso a la carpeta.";
				}
				else
					echo "Imagen pesa mas de 1 MB";
			}
			else
			echo "Error El formato de la extencion de la imagen..";
		}
		else
			echo "Please select image to upload..!";
		exit;
	}
?>