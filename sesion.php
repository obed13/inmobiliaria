<?php
	
	if (!isset($_SESSION['autenticado']) && !$_SESSION['autenticado'] == 'SI') {
		header("Location: index.php?msj=1");
	}
?>