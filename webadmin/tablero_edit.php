<?php 
/***********************************/
$modulo_include="tablero_edit_inc.php";
$modulo_buscar ="panel_menuizq.php";
$stylo = 2;
$retorno ="tablero.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($juvame_form)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("tablero.php");
	return $objResponse;
}

function procesar_formulario($juvame_form)
{
   	$respuesta = new xajaxResponse('ISO-8859-1');
   	$juvame_error = "";
	if ($juvame_form["titulo"]=="") $juvame_error = " * Ingresar el nombre del Contenido";	
	
	if ($juvame_error != "")
  	{		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
			return $respuesta;
  	}
  	else
  	{	
		if($juvame_form['seltipo']=='1')
		{
			 if($juvame_form['imagen']=="") 			$juvame_error = " * Debe Seleccionar una imagen";
			 elseif($juvame_form['anchoimagen']=="") 	$juvame_error = " * Debe Ingresar el ancho de la imagen";
			 elseif($juvame_form['altoimagen']=="")  	$juvame_error = " * Debe Ingresar el alto de la imagen";
			 
			 if ($juvame_error != "")
			 {		
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage    ='".$juvame_form['selectpage']."', 
								cnomhome    ='".$juvame_form['titulo']."',
								cimgpubli   ='".$juvame_form['imagen']."',
								nancho      ='".$juvame_form['anchoimagen']."', 
				 				nalto       ='".$juvame_form['altoimagen']."',
								curlpubli   ='".$juvame_form['urlimagen']."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino ='".$juvame_form['selectubicacion']."' 
								where ccodinicio='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }  
		 }
		 elseif($juvame_form['seltipo']=='2')
		 {
			 if($juvame_form['flash']=="") 			$juvame_error = " * Debe Seleccionar un banner flash";
			 elseif($juvame_form['anchoflash']=="") 	$juvame_error = " * Debe Ingresar el ancho del banner flash";
			 elseif($juvame_form['altoflash']=="")  	$juvame_error = " * Debe Ingresar el alto del banner flash";
			 
			 if ($juvame_error != "")
			 {		
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage     ='".$juvame_form['selectpage']."', 
								cnomhome     ='".$juvame_form['titulo']."',
								cimgpubli    ='".$juvame_form['flash']."',
								nancho       ='".$juvame_form['anchoflash']."',
								nalto        ='".$juvame_form['altoflash']."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino  ='".$juvame_form['selectubicacion']."' 
								where ccodinicio ='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }
		 }
		 elseif($juvame_form['seltipo']=='3')
		 {
			 if($juvame_form['htmlcodigo']=="") $juvame_error = " * Debe Ingresar el Codigo HTML";
			 
			 if ($juvame_error != "")
			 {		
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage     ='".$juvame_form['selectpage']."',
								cnomhome     ='".$juvame_form['titulo']."',
								cadspubli    ='".addslashes($juvame_form['htmlcodigo'])."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino  ='".$juvame_form['selectubicacion']."' 
								where ccodinicio='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }
		 }
		 elseif($juvame_form['seltipo']=='4')
		 {
			 if($juvame_form['nroitems']=="")
			 { 
				  $juvame_error = " * Debe Ingresar una Cantidad para mostrar"; 
			 }
			 
			 if($juvame_error != "")
			 {
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage     ='".$juvame_form['selectpage']."', 
								cnomhome     ='".$juvame_form['titulo']."',
								ccodestilo   ='".$juvame_form['selectestilo']."',
								ccodcategoria ='".$juvame_form['selectcategoria']."',
								ccodmodulo   ='".$juvame_form['modulodinam']."', 
								ccodseccion  ='".$juvame_form['secciondinam']."',
								nnroitems    ='".$juvame_form['nroitems']."',
								ccodorden    ='".$juvame_form['ordendinam']."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino  ='".$juvame_form['selectubicacion']."' 
								where ccodinicio='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }//fin else error 4
		 }	
		 elseif($juvame_form['seltipo']=='5')
		 {
			 if($juvame_form['anchoimagen']=="") 	$juvame_error = " * Debe Ingresar el ancho de la imagen";
			 elseif($juvame_form['altoimagen']=="") $juvame_error = " * Debe Ingresar el alto de la imagen";
			 
			 if ($juvame_error != "")
			 {		
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage     ='".$juvame_form['selectpage']."', 
								cnomhome     ='".$juvame_form['titulo']."',
								nancho       ='".$juvame_form['anchoimagen']."',
								nalto        ='".$juvame_form['altoimagen']."',
								cimagen1     ='".$juvame_form['imagen1']."',
								curl1        ='".$juvame_form['url1']."',
								cimagen2     ='".$juvame_form['imagen2']."',
								curl2        ='".$juvame_form['url2']."',
								cimagen3     ='".$juvame_form['imagen3']."',
								curl3        ='".$juvame_form['url3']."',
								cimagen4     ='".$juvame_form['imagen4']."',
								curl4        ='".$juvame_form['url4']."',
								cimagen5     ='".$juvame_form['imagen5']."',
								curl5        ='".$juvame_form['url5']."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino  ='".$juvame_form['selectubicacion']."' 
								where ccodinicio ='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }
		 }		 elseif($juvame_form['seltipo']=='6')
		 {
			 if($juvame_form['anchoimagen']=="") 	$juvame_error = " * Debe Ingresar el ancho de la imagen";
			 elseif($juvame_form['altoimagen']=="") $juvame_error = " * Debe Ingresar el alto de la imagen";
			 elseif($juvame_form['imagen']=="")  	$juvame_error = " * Debe seleccionar una imagen";
			 elseif($juvame_form['anchowin']=="")  	$juvame_error = " * Debe Ingresar el ancho de la ventana";
			 elseif($juvame_form['altowin']=="")  	$juvame_error = " * Debe Ingresar el alto de la Ventana";
			 
			 if ($juvame_error != "")
			 {		
				  $respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
				  return $respuesta;
			 }
			 else
			 {
				  $update	= "update pagehome set 
				  				ccodpage     ='".$juvame_form['selectpage']."', 
								cnomhome     ='".$juvame_form['titulo']."',
								cimgpubli    ='".$juvame_form['imagen']."',
								nancho       ='".$juvame_form['anchoimagen']."',
								nalto        ='".$juvame_form['altoimagen']."',
								cadspubli    ='".addslashes($juvame_form['htmlcodigo'])."',
								anchowin     ='".$juvame_form['anchowin']."',
								altowin      ='".$juvame_form['altowin']."',
								dfecinicio   ='".fechaymd($juvame_form['fechaini'])."',
								dfecfinal    ='".fechaymd($juvame_form['fechafin'])."',
								cubidestino  ='".$juvame_form['selectubicacion']."' 
								where ccodinicio ='".$juvame_form['idpro']."' ";
				  
				  db_query($update);
				  /*****************/
			 }
		 }
		  db_query("delete from pagehomedet where ccodinicio='".$juvame_form['idpro']."'");
		  if(!empty($juvame_form['seccionpage']))
		  {
			  while (list ($key, $val) = each ($juvame_form['seccionpage']) )
			  {
				  db_query("insert into pagehomedet(ccodinicio,ccoddestino) values('".$juvame_form['idpro']."','".$val."')");
			  }
		  }
	
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
