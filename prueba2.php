<?php
require_once 'conexion.php';
$conexion = conectar();

if($_GET['action'] == 'listFotos'){
    $sql = "SELECT * FROM fotos ORDER BY id_foto DESC";
    $consulta = $conexion->query($sql);

    while($row = $consulta->fetch_assoc())
    {
        echo  '<li>
                <img src="fotos/'.$row['nom_foto'].'" />
                <span>'.$row['nom_foto'].'</span>
            </li>';
    }

}else
{
    $destino = "fotos/";
    if(isset($_FILES['image'])){

        $nombre = $_FILES['image']['name'];
        $temp   = $_FILES['image']['tmp_name'];

        // subir imagen al servidor
        if(move_uploaded_file($temp, $destino.$nombre))
        {
            $sql = "INSERT INTO fotos VALUES('','','".$nombre."')";
            $accion=$conexion->query($sql);
        }

        echo  '<li>
                <img src="fotos/'.$nombre.'" />
                <span>'.$nombre.'</span>
            </li>';
    }
}
?>