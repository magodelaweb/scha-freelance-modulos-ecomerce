<?php
/***********************************/
$modulo_include="personasedit_inc.php";
$modulo_buscar ="panel_menuizq.php";
$modulo="";
$stylo = "3";
$retorno ="personas.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect()
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("personas.php");
	return $objResponse;
}

function procesar_formulario($form_entrada){
   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
   	if($form_entrada['pais'])			$ccodubigeo=$form_entrada['pais'];	
	if($form_entrada['dpto']!='00000000')		$ccodubigeo=$form_entrada['dpto'];	
	if($form_entrada['city']!='00000000')		$ccodubigeo=$form_entrada['city'];	

   if ($form_entrada["nombre"]=="") 
   		$error_form = " * Error en nombre. Por favor, ingrese nombre";	
   else if (!validar_letras($form_entrada["nombre"]))  
   		$error_form = " * Error en nombre. Por favor, ingresar solo letras";	
   else 
   {	/* 	validando nombre */
     	$sql    = "SELECT * FROM persona  WHERE cnompersona ='".$form_entrada['nombre']."'  AND dfecpersona   ='".$form_entrada['fechanac']."'";
	    $query  = db_query($sql);
	    $row    = db_fetch_array($query);
	    $total  = db_num_rows($query);
	   	if($total>1) 								 
	   		$error_form = " * Error en nombre. Ese nombre ya existe";	 
		else if ($form_entrada["selectsexo"]=='00')	 
	   		$error_form = " * Error en sexo. Por favor, seleccione sexo.";
		else if ($form_entrada["fechanac"]=='')	
	   		$error_form = " * Error en fecha de nacimiento. Por favor, ingrese fecha.";
   		else if ($form_entrada["pais"]=='00000000')	 
			$error_form = " * Error en ubicación. Por favor, seleccione ubicación.";		

	} /* validar nombre */
 
  if ($error_form != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
		return $respuesta;
  }
  else
  {		
	$fechamysql=fechaymd($form_entrada['fechanac']);
	$sql_update="UPDATE persona SET 
						cnompersona  ='".$form_entrada['nombre']."', 
						csexpersona  ='".$form_entrada['selectsexo']."',
						cdnipersona  ='".$form_entrada['numerodoc']."',
						dnacpersona  ='".$fechamysql."',
						ccodubigeo   ='".$ccodubigeo."',
						cciudad      ='".$form_entrada['lugar']."',
						cdireccion   ='".$form_entrada['direccion']."',
						ccodpostal   ='".$form_entrada['postal']."',
						ntelefono    ='".$form_entrada['telefono']."',
						nmovil       ='".$form_entrada['movil']."',
						dfecmodifica  ='".date("Y-m-d H:i:s")."', 
						ccodusuario	  ='".$_SESSION['webuser_id']."' 
				  WHERE ccodpersona ='".$form_entrada['codigo']."'";
	
		$query   =db_query($sql_update);
		return redirect();  
 	} // else 
}	// function principal


require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_formulario");
$xajax->processRequests();
$xajax->printJavascript("xajax/");
include "panel_template.php";
?>
