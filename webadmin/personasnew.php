<?php
/***********************************/
$modulo_include="personasnew_inc.php";
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
	if ($form_entrada["nombre"]=="")   
   		$error_form = " * Error en nombre. Por favor, ingrese nombre";	
	else if ($form_entrada['email']=="")
			$error_form = " * Error en email. Por favor, ingrese un Email.";				
	else if (!validar_email($form_entrada["email"]))  
			$error_form = " * Error en email. Email invalido.";	
	else
	{
		$sql    = "SELECT cnompersona FROM persona  WHERE cemapersona ='".$form_entrada['email']."'";
		$query  = db_query($sql);
		$row    = db_fetch_array($query);
	    $total  = db_num_rows($query);
		if($total>0) 		
			$error_form = " * Email ya esta registrado";	 
			
	  }	
	  
  if ($error_form != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
		return $respuesta;
  }
  else
  {
		$sqlcad     = db_query("SELECT MAX(ccodpersona)+1 FROM persona");
		list($new_cod) = mysql_fetch_array($sqlcad);
		if(!isset($new_cod))	$new_cod='11061213';

		if($form_entrada['pais'])					$ccodubigeo=$form_entrada['pais'];	
		if($form_entrada['dpto']!='00000000')		$ccodubigeo=$form_entrada['dpto'];	
		if($form_entrada['city']!='00000000')		$ccodubigeo=$form_entrada['city'];
		$fechamysql=fechaymd($form_entrada['fechanac']);
		$sql_insert= "INSERT INTO persona(ccodpersona,cnompersona,cemapersona,cpaspersona,cestpersona,cnivpersona,cestsuscripcion,
					csexpersona,cdnipersona,dnacpersona,cimgpersona,ccodubigeo,ccodidioma,
					cciudad,ccodpostal,cdireccion,ntelefono,nmovil,
					dfecpersona,dfecmodifica,ccodusuario)
				    VALUES (
					'".$new_cod."',
					'".$form_entrada['nombre']."',
					'".$form_entrada['email']."',
					'".md5('987abc')."',
					'1',
					'1',
					'0',
					'".$form_entrada['selectsexo']."',
					'".$form_entrada['numerodoc']."',
					'".$fechamysql."',
					'hnohayfoto.jpg',
					'".$ccodubigeo."',
					'ES',
					'".$form_entrada['ciudad']."',
					'".$form_entrada['codpostal']."',
					'".$form_entrada['direccion']."',
					'".$form_entrada['telefono']."',
					'".$form_entrada['movil']."',
					'".date("Y-m-d")."',
					'".date("Y-m-d H:i:s")."',
					'".$_SESSION['webuser_id']."')";
		$query = db_query($sql_insert);
		
		if ($query)	 return redirect();  
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