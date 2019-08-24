<?php 
/***********************************/
$modulo_include="enlaceedit_inc.php";
$modulo_buscar ="panel_publicar_edit.php";
$modulo="1100";
$stylo = "3";
$retorno ="contenido.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($juvame_form)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("contenido.php");
	return $objResponse;
}

function procesar_formulario($juvame_form)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $juvame_error = "";
   if ($juvame_form["titulo"]=="") $juvame_error = " * Ingresar el nombre de la articulo";	
   else
   {
        if ($juvame_form["url"]=="")   
			$juvame_error = " * Ingrese una URL";	
       	else if ($juvame_form["resumen"]=="")   
			$juvame_error= "  * Error ingrese un resumen.";	
  	}
  if ($juvame_error != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
		return $respuesta;
  }
  else
  {		
	if ($juvame_form['imagen']<>"")
	{
		$rutath = ereg_replace('fotos','thumbs',$juvame_form['imagen']);
		include_once('include/thumbnail.inc.php');
		$thumb = new Thumbnail('..'.$juvame_form['imagen']);
		$thumb->resize(240,180);
		$thumb->crop(0,0,240,180);
		$thumb->save('..'.$rutath);
	}
	$save_contenido= "UPDATE contenido 	SET
							ccodcategoria    = '" .$juvame_form['selectcategoria']. "', 
							cnomcontenido    = '" .addslashes($juvame_form['titulo']) . "', 
							curlcontenido    = '" .$juvame_form['url'] . "', 
							crescontenido    = '" .addslashes($juvame_form['resumen']) . "', 
							ctagcontenido    = '" .addslashes($juvame_form['tags']) . "', 
							cimgcontenido    = '" .$juvame_form['imagen']. "', 
							dfeccontenido    = '" .fechaymd($juvame_form['idfecha']). "', 
							ccodusuario      = '" .$_SESSION['webuser_id']. "',
							dfecmodifica     = now()
						WHERE ccodcontenido = '" . $juvame_form['IDpro'] . "'";
	db_query($save_contenido);
	
	db_query("DELETE FROM seccioncontenido where ccodpage ='".$juvame_form['selectpage']."' and ccodcontenido = '".$juvame_form['IDpro']."' ");
	
	$sqlsec = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$juvame_form['selectpage']."' and cestseccion ='1' and ccodmodulo='1100' and ctipseccion='1' order by ccodseccion");
	while($rowsec = db_fetch_array($sqlsec)) 
	{
		$varcamp = "select".$rowsec['ccodseccion'];
		$varsecc = $juvame_form[$varcamp];
		if($varsecc)
		{
			$save_seccion="INSERT INTO seccioncontenido (ccodpage,ccodseccion, ccodcontenido ) values ('".$juvame_form['selectpage']."','" . $rowsec[ccodseccion] . "', '" . $juvame_form['IDpro'] . "' )";
			db_query($save_seccion);
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
