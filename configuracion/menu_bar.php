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
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../inicio.php">Inicio</a></li>
        <li><a href="../bandeja.php">Bandeja &nbsp;</a></li>
        <?php if ($_SESSION['id_cat'] == 1) { ?>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuracion <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="add_user.php">Crear Usuarios</a></li>
            <li><a href="index.php">Listado Usuarios</a></li>
            <li><a href="list_cat.php">Lista Categoria</a></li>
            <li><a href="carteras.php">Lista Carteras</a></li>
            <li><a href="infocarteras.php">Informacion Cartera</a></li>
          </ul>
        </li>
        <?php } ?>
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