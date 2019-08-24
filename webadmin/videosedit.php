<?php 
/***********************************/
$modulo_include="videosedit_inc.php";
$modulo_buscar ="panel_publicar_edit.php";
$modulo="1600";
$stylo = "3";
$retorno ="videos.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($juvame_form)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("videos.php");
	return $objResponse;
}

function procesar_formulario($juvame_form)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $juvame_error = "";
   if ($juvame_form["titulo"]=="") $juvame_error = " * Ingresar el nombre del video";	
   else
   {
        if ($juvame_form["amigable"]=="")   
			$juvame_error = " * Ingrese un nombre amigable";	
       	else if (!validar_amigable($juvame_form["amigable"]))  
			$juvame_error= "  * Error en nombre amigable. No se aceptan caracteres escpeciales ni espacios.";	
    	else 
		{	
			$sql    = db_query("SELECT * FROM contenido  WHERE camicontenido  ='".$juvame_form['amigable']."' and ccodcontenido <>'".$juvame_form['IDpro']."'");
		    $total  = db_num_rows($sql);
		    if($total>0) 
				$juvame_error = " * Nombre amigable ya esta existe";	 
		}
  	}
  if ($juvame_error != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$juvame_error</span>");
		return $respuesta;
  }
  else
  {		
	$save_contenido= "UPDATE contenido 	SET
							ccodpage         = '" .$juvame_form['selectpage']. "', 
							ccodcategoria    = '" .$juvame_form['selectcategoria']. "', 
							cnomcontenido    = '" .addslashes($juvame_form['titulo']) . "', 
							camicontenido    = '" .$juvame_form['amigable'] . "', 
							crescontenido    = '" .addslashes($juvame_form['resumen']) . "', 
							ctagcontenido    = '" .addslashes($juvame_form['tags']) . "', 
							cimgcontenido    = '" .$juvame_form['imagen']. "', 
							curlcontenido    = '" .$juvame_form['video']. "', 
							dfeccontenido    = '" .fechaymd($juvame_form['idfecha']). "', 
							ccodusuario      = '" .$_SESSION['webuser_id']. "',
							dfecmodifica     = now()
						WHERE ccodcontenido = '" . $juvame_form['IDpro'] . "'";
	db_query($save_contenido);
	$save_detalle= "UPDATE contenidodetalle SET cdetcontenido='".addslashes($juvame_form['descripcion'])."'WHERE ccodcontenido = '" . $juvame_form['IDpro'] . "'";
	db_query($save_detalle);
	
	db_query("DELETE FROM seccioncontenido where ccodcontenido = '".$juvame_form['IDpro']."'");
	
	$sqlsec = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$juvame_form['selectpage']."' and cestseccion ='1' and ccodmodulo='1600' and ctipseccion='1' order by ccodseccion");
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
	if ($juvame_form['imagen']<>"")
	{
		$rutath = ereg_replace('fotos','thumbs',$juvame_form['imagen']);
		include_once('include/thumbnail.inc.php');
		$thumb = new Thumbnail('..'.$juvame_form['imagen']);
		$thumb->resize(160,160);
		$thumb->crop(0,0,160,160);
		$thumb->save('..'.$rutath);
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
