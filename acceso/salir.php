<?php
	session_start();
	include("../php/conexion.php");

	if(isset($_SESSION['user'])) {
		$conexion->query("UPDATE usuarios SET conectado='0' WHERE correo='".$_SESSION['user']."'");
		session_destroy();
		header("Location: index.php");
	}else{
		header("Location: index.php");
	}

?>
