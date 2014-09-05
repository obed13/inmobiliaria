<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../inicio.php">Inmobiliaria</a>
    </div>
    <div class="navbar-collapse collapse">
      <?php
        $sql = "SELECT destinatario,id_accion,id_user FROM post WHERE id_user='".$_SESSION['uid']."' ";

        $inst = $conexion->query($sql);
        $con = $inst->num_rows;
        $row = $inst->fetch_array();

      ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../inicio.php">Inicio</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Cartera <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="cartera_add.php">Crear Cartera</a></li>
            <li><a href="list_cartera.php">Lista Cartera</a></li>
            <li><a href="list_cancel.php">Carteras Canceladas</a></li>
            <li><a href="list_success.php">Carteras Completadas</a></li>
          </ul>
        </li>
        <li><a href="../bandeja.php">Bandeja &nbsp;<?php if ($row['id_user'] == $_SESSION['uid']) { if ($row['id_accion'] == 1) { echo "<span class='badge pull-right'>".$con."</span>"; } } ?></a></li>
        <li><a href="#">Profile</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="divider"></li>
            <li><a href="../logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>