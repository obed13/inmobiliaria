<?php
	error_reporting(E_ALL ^ E_NOTICE);
  require_once '../sesion.php';

    if(!$id_cat)
    {
      require_once '../conexion.php';
      $conexion = conectar();
    }

  	$sql = "SELECT id_cat, nom_cat FROM categoria";
  	$cat = $conexion->query($sql);

  	while ($categoria = $cat->fetch_array()) {
  		//echo "<option value=".$categoria['id_cat'].">".$categoria['nom_cat']."</option>";
  		echo "<option value='".$categoria['id_cat']."'";
			if ($id_cat==$categoria['id_cat']) 
			{
				echo " selected";
			}
			echo ">".$categoria['nom_cat']."</option>";
  	}
?>