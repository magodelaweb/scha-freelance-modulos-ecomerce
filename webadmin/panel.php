<?php
/***********************************/
$modulo_include="panel_inc.php";
$modulo_buscar ="panel_columna.php";
$stylo = "3";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
include "panel_template.php";
/***********************************/
?>
