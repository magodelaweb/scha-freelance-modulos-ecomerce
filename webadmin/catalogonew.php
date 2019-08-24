<?php 
/***********************************/
$modulo_include="catalogonew_inc.php";
$modulo_buscar ="panel_publicar_new.php";
$modulo="1100";
$stylo = "3";
$retorno ="catalogo.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($juvame_form)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("catalogo.php");
	return $objResponse;
}
function procesar_formulario($juvame_form)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $juvame_error = "";
   if ($juvame_form["titulo"]=="") $juvame_error = " * Ingresar el nombre de la articulo";	
   else
   {
        if ($juvame_form["amigable"]=="")   
			$juvame_error = " * Ingrese un nombre amigable";	
       	else if (!validar_amigable($juvame_form["amigable"]))  
			$juvame_error= "  * Error en nombre amigable. No se aceptan caracteres especiales ni espacios.";	
    	else 
		{	
			$sql    = db_query("SELECT * FROM contenido  WHERE ccodpage='".$juvame_form['selectpage']."' and camicontenido  ='".$juvame_form['amigable']."'");
		    $total  = db_num_rows($sql);
		    if($total>0) 
				$juvame_error = " * Nombre amigable ya esta existe, intente escribir otro nombre";	 
		}
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
  	if ($_POST['comenta']) $comenta="1"; else $comenta='0';
	$new_cod = $juvame_form['selectpage'].date('ymdHis').codigo_azar(4);
	$save_contenido= "INSERT INTO contenido 
						(
						ccodcontenido,
						ccodpage,
						ccodcategoria,
						ccodmodulo,
						ccodestcontenido,
						cnomcontenido,
						camicontenido,
						crescontenido,
						ctagcontenido,
						cimgcontenido,
						cestcontenido,
						ctipcontenido,
						curlcontenido,
						cestcomentario,
						dfeccontenido,
						ccodusuario,
						dfecmodifica,
						ccodmoneda,
						cuniproducto)
						values(
						'" . $new_cod . "', 
						'" . $juvame_form['selectpage'] . "', 
						'" . $juvame_form['selectcategoria']. "',
						'1200', 
						'" . $juvame_form['selectestilo'] . "', 
						'" . addslashes($juvame_form['titulo']) . "', 
						'" . $juvame_form['amigable'] . "', 
						'" . addslashes($juvame_form['resumen']) . "', 
						'" . addslashes($juvame_form['tags']) . "', 
						'" . $juvame_form['imagen']. "', 
						'0',
						'2',
						'',				
						'".$comenta."',
						'" .fechaymd($juvame_form['idfecha']). "', 
						'" .$_SESSION['webuser_id']. "',
						now(),
						'D',
						'UND')";		
	db_query($save_contenido);
	
	$save_detalle = "INSERT INTO contenidodetalle 
						(
						 ccodcontenido, cdetcontenido)
						 values (
						'" . $new_cod . "',
						'" . addslashes($juvame_form['descripcion']) . "' 
						 )";
	db_query($save_detalle);
	
	$sqlsec = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$juvame_form['selectpage']."' and cestseccion ='1' and ccodmodulo='1200' and ctipseccion='1' order by ccodseccion");
	while($rowsec = db_fetch_array($sqlsec)) 
	{
		$varcamp = "select".$rowsec['ccodseccion'];
		$varsecc = $juvame_form[$varcamp];
		if($varsecc)
		{
			$save_seccion="INSERT INTO seccioncontenido (ccodpage,ccodseccion, ccodcontenido ) values ('".$juvame_form['selectpage']."','" . $rowsec[ccodseccion] . "', '" . $new_cod . "' )";
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
