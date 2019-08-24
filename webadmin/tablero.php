<?php 
/***********************************/
$modulo_include="tablero_inc.php";
$modulo_buscar ="tablero_bus.php";
$stylo = 1;
$modulo="";
$retorno ="panel.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
include "panel_template.php";
/***********************************/
?>
