<?php  
	
	function conectar()
	{
		$conexion = new mysqli('localhost','root','','inmobiliaria');
		$conexion->query(" SET NAMES 'utf8' ");

		return $conexion;
	}
?>