<?php
session_start();
//error_reporting(0);
error_reporting(E_ALL);
//echo "...Inicia debug...";
require('inc/config.php');
//echo "<br/>...config cargado...";
require('inc/class.php');
//echo "<br/>...class cargado...";
require('inc/func.php');
//echo "<br/>...func cargado...";

$aclass = new conexionClass;
$bclass = new conexionClass;

//$contenedor = ($_SERVER["SERVER_NAME"]=='localhost' || $_SERVER["SERVER_NAME"]=='www.nslatino.com')?'/schasoci':'';

$paramSec = isset($_GET["idsec"])?$_GET["idsec"]:"inicio";
/*echo "<script language='JavaScript'>
                alert('paramSec: ".$paramSec."');
                </script>";*/
$paramSec2 = isset($_GET["idsec2"])?$_GET["idsec2"]:"";
/*echo "<script language='JavaScript'>
                alert('paramSec2: ".$paramSec2."');
                </script>";*/

function crearurl_articulo($articulocod, $clase){
	$codniv1 =substr($articulocod,0,12).'000000000000';
	$codniv2 =substr($articulocod,0,16).'00000000';
	$codniv3 =substr($articulocod,0,20).'0000';
	$codniv4 =substr($articulocod,0,24);
	$urlweb ="";
	$clase->consulta("SELECT ccodseccion, camiseccion FROM seccion WHERE ccodseccion ='".$codniv1."' or ccodseccion ='".$codniv2."'or ccodseccion ='".$codniv3."'or ccodseccion ='".$codniv4."'");
	while($row_url  = $clase->respuesta()){
		$urlweb .= $row_url['camiseccion'].'/';
	}
	return $urlweb;
        //***Anotación por Arturo Martinez: "Esta funcion es llamada por los artículos (por ejemplo las fotos de los camiones)"
}

function url_amigable($url) {
	$url = strtolower($url);
	//Rememplazamos caracteres especiales latinos
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
	$repl = array('a', 'e', 'i', 'o', 'u', 'n');
	$url = str_replace ($find, $repl, $url);
	// Añaadimos los guiones
	$find = array(' ', '&', '\r\n', '\n', '+');
	$url = str_replace ($find, '-', $url);
	// Eliminamos y Reemplazamos demás caracteres especiales
	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace ($find, $repl, $url);
	return $url;
}

$ccodmodulo = '';
include("visita.php");
include("template.php");
?>
