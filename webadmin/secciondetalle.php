<?php 
/***********************************/
$modulo_include="secciondetalle_inc.php";
$modulo_buscar ="panel_publicar_edit.php";
$modulo="1100";
$stylo = "3";
$retorno ="seccion.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($juvame_form)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("seccion.php");
	return $objResponse;
}

function procesar_formulario($juvame_form)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $juvame_error = "";
  if ($juvame_error != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
		return $respuesta;
  }
  else
  {		
	$save_contenido= "UPDATE secciondetalle 	SET
							cnombre    = '" .addslashes($juvame_form['titulo']) . "', 
							cdetseccion    = '" .addslashes($juvame_form['descripcion']) . "'
						WHERE ccodseccion = '" . $juvame_form['ids'] . "'";
	db_query($save_contenido);
	
	return redirect($form_web);  
  }	
}

require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_formulario");
$xajax->processRequests();
$xajax->printJavascript("xajax/");
include "panel_template.php";
?>
