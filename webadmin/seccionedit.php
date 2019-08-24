<?php 
/***********************************/
$modulo_include="seccionedit_inc.php";
$modulo_buscar ="panel_menuizq.php";
$stylo="3";
$retorno ="seccion.php";
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";
include "include/config_seguro.php";
/***********************************/
	
function redirect($form_entrada)
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("seccion.php");
	return $objResponse;
}

function procesar_estilos($form_entrada)
{
	$mostrarsec = new xajaxResponse('ISO-8859-1');
	$opsec   = "<ul class='stylos'>";
	$sqlsec  = " SELECT * FROM estiloseccion WHERE ccodmodulo='".$form_entrada['selectmodulo']."' and cestsecestilo='1' order by ccodsecestilo";
	$sqlmsec = db_query($sqlsec);
	$na = 1;
	while ($rows = db_fetch_array($sqlmsec)) 
	{	
		if ($na==1) { $check = " checked";} else { $check = "";}
		$opsec .= '<li><img src="estilos/images/'.$rows[cimgsecestilo].'"><input type="radio"  name="selectestilo" value="'.$rows[ccodsecestilo].'" '.$check.'>'.$rows[cnomsecestilo].'</li>';
		$na++;
	}
	$opsec .= "</ul>";
	$mostrarsec->addAssign("estilos","innerHTML","$opsec");
	return $mostrarsec;
}

function procesar_formulario($form_entrada)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
   if ($form_entrada["amigable"]=="")          
		$error_form = " * Error en nombre. Por favor, ingresar el nombre de la sección";	
   else
   {
		if (!validar_amigable($form_entrada["amigable"]))  
			$error_form = "  * Error en nombre amigable. No se aceptan caracteres escpeciales ni espacios.";	
    	else 
		{	
			$sql    = "SELECT * FROM seccion  WHERE ccodpage='".$form_entrada['selectpage']."' and camiseccion  ='".$form_entrada['amigable']."' AND ccodseccion<>'".$form_entrada['ids']."'";
		    $query  = db_query($sql);
		    $total  = db_num_rows($query);
		    if($total>0) 
				$error_form = " * Error en nombre amigable. Ese nombre amigable ya esta registrado.";	 
			else if ($form_entrada["txtdetalle"]=="")  
				$error_form = " * Error en descripcion. Por favor, ingrese una descripcion";	
	  	    else if ($form_entrada["imagencab"]!='' && !is_file('..'.$form_entrada["imagencab"]))
				$error_form = " * Error en imagen. La imagen seleccionada no existe.";	
		 			
		}
  	}
  if ($error_form != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
		return $respuesta;
  }
  else
  {	
	if ($form_entrada['imagencab']<>"")
	{
		$rutath = ereg_replace('fotos','thumbs',$form_entrada['imagencab']);
		include_once('include/thumbnail.inc.php');
		$thumb = new Thumbnail('..'.$form_entrada['imagencab']);
		$thumb->resize(240,180);
		$thumb->crop(0,0,240,180);
		$thumb->save('..'.$rutath);
	}
	if($form_entrada["menuind"]) 
		$menuinden="1";
	else
		$menuinden ="0";  
	$update_query = "UPDATE seccion SET
						ccodmodulo    ='".$form_entrada['selectmodulo']."',
						ccodsecestilo ='".$form_entrada['selectestilo']."',
						ccodsubestilo ='".$form_entrada['selectsub']."',
						cnomseccion   ='".$form_entrada['titulo']."',
						camiseccion   ='".$form_entrada['amigable']."',
						ctitseccion   ='".$form_entrada['txttitulo']."',
						cdesseccion   ='".$form_entrada['txtdetalle']."',
						ctagseccion   ='".$form_entrada['txttags']."',
						cimgseccion   ='".$form_entrada['imagencab']."',
						cnewmenu      ='".$menuinden."',
						ctipseccion   ='".$form_entrada['selectenlace']."',
						curlseccion   ='".$form_entrada['rutaenlace']."',
						cpagseccion   ='".$form_entrada['txtpaginar']."',
						cordcontenido ='".$form_entrada['selectorden']."',
						ccodusuario   ='".$_SESSION['webuser_id']."',
						dfecmodifica  ='".date("Y-m-d H:i:s")."'
					WHERE ccodseccion='".$form_entrada['ids']."'";	

	db_query($update_query);

	/***  Grabado de Ubicaciones de Menu 	*/
	$nivel = $form_entrada['selectnivel'];	
	if ($nivel<=1)
	{
//		db_query("DELETE FROM seccionmenu where ccodseccion = '".$form_entrada['ids']."'");
		
		$sqlmenuubi = "select * from pagemenu where ccodpage='".$form_entrada['selectpage']."' and cestmenu='1'";
		$resmenuubi = db_query($sqlmenuubi);
		while ($rows_menuubi = mysql_fetch_array($resmenuubi)) 
		{
			$ubimen = 'rd'.$rows_menuubi['ccodmenu'].$rows_menuubi['cordmenu'];
			$sqlmenusi = "select * from seccionmenu where ccodseccion='".$form_entrada['ids']."' and ccodmenu='".$rows_menuubi['ccodmenu']."'";
			$resmenusi = db_query($sqlmenusi);
			$totalsi   = db_num_rows($resmenusi);	
			if($totalsi==0)
			{
				if ($form_entrada[$ubimen])	
				{
					$save2_query = "INSERT INTO seccionmenu (ccodseccion, ccodmenu,cordmenu) VALUES ('".$form_entrada['ids']."','".$rows_menuubi['ccodmenu']."','0')";
					db_query($save2_query);	
				}
			}
			else
			{
				if ($form_entrada[$ubimen])	
				{
					$insertado="";
				}
				else
				{
					$save3_query = "DELETE FROM seccionmenu where ccodseccion= '".$form_entrada['ids']."' and  ccodmenu='".$rows_menuubi['ccodmenu']."'";
					db_query($save3_query);	
					
				}
				
			}
		}
	}
  
	return redirect($form_entrada);  
  }	// else
}

require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_estilos");
$xajax->registerFunction("procesar_formulario");
$xajax->processRequests();
$xajax->printJavascript("xajax/");
include "panel_template.php";
?>
