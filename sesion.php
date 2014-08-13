<?php
	
	date_default_timezone_set('America/Los_Angeles');
	
	if (!isset($_SESSION['autenticado']) && !$_SESSION['autenticado'] == 'SI') {
		header("Location: index.php?msj=1");
	}
?>