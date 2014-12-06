<?php
  $sql = "SELECT destinatario,id_accion,id_user FROM post WHERE id_user='".$_SESSION['uid']."' ";

  $inst = $conexion->query($sql);
  $con = $inst->num_rows;
  $row = $inst->fetch_array();
?>
<ul class="nav navbar-nav navbar-right">
  <li><a href="inicio.php">Inicio</a></li>
  <li><a href="bandeja.php">Bandeja &nbsp;<?php if ($row['id_user'] == $_SESSION['uid']) { if ($row['id_accion'] == 1) { echo "<span class='badge pull-right'>".$con."</span>"; } } ?></a></li>
  <?php if ($_SESSION['id_cat'] == 1) { ?>
  <li><a href="configuracion/">Configuracion</a></li>
  <?php } ?>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="logout.php">Cerrar Sesion</a></li>
    </ul>
  </li>
</ul>