<?php 
/***********************************/
$modulo_include="seccion_inc.php";
$modulo_buscar ="seccion_bus.php";
$stylo="1";
$retorno ="panel.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
include "panel_template.php";
/***********************************/
?>
