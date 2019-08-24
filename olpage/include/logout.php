<?php 
	session_start();
	$url=$_SESSION['USER_ACTIVO'];
	$idi=$_SESSION['pagina_idioma'];
	$xvot=$_SESSION['VOTO'];
	$xcon=$_SESSION['CONTADORESTADO'];
	$xvis=$_SESSION['NROVISITA'];
	session_destroy();
	session_start();
	$_SESSION['USER_ACTIVO']=$url;
	$_SESSION['pagina_idioma']=$idi;
	$_SESSION['VOTO']=$xvot;
	$_SESSION['CONTADORESTADO']=$xcon;
	$_SESSION['NROVISITA']=$xvis;
	header("location: /index.php");
?>