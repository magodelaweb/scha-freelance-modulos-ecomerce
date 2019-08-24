<?php 
/***********************************/
$modulo_include="seccionsubnew_inc.php";
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
	if ($form_entrada["titulo"]=="") $error_form = " * Error en nombre. Por favor, ingresar el nombre de la sección";	
	else
	{
        if ($form_entrada["amigable"]=="")   $error_form = " * Error en nombre amigable. Por favor, ingrese un nombre amigable";	
       	else if (!validar_amigable($form_entrada["amigable"]))  $error_form = "  * Error en nombre amigable. No se aceptan caracteres escpeciales ni espacios.";	
    	else 
		{	
		  	$niveles = $form_entrada['selectnivel'];
			$seccixx = $form_entrada['selectroot'];
			$cseccxx = substr($seccixx,0,8+($niveles*4));

			$sql    = "SELECT * FROM seccion  WHERE ccodpage='".$form_entrada['selectpage']."' and ccodseccion like '".$cseccxx."%' and camiseccion  ='".$form_entrada['amigable']."'";
		    $query  = db_query($sql);
		    $total  = db_num_rows($query);
		    if($total>0) 
				$error_form = " * Error en nombre amigable. Ese nombre amigable ya esta registrado.";	 
			else if ($form_entrada["txtdetalle"]=="")  
				$error_form = " * Error en descripcion. Por favor, ingrese una descripcion";	
		}
  	}
  if ($error_form != "")
  {		
		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
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
  	$nivel = $form_entrada['selectnivel'];
	$secci = $form_entrada['selectroot'];
		
	$csecc = substr($secci,0,8+($nivel*4));
	$posix  = (9 +( $nivel *4));
  	$sqlcad     = "select max(substring(ccodseccion,".$posix.",4))+1 from seccion   where ccodseccion like '".$csecc."%' and cnivseccion='".($nivel+1)."'";
	$query_cod  = db_query($sqlcad);
	list($cod2) = mysql_fetch_array($query_cod);
	if(!isset($cod2))	$cod2='0001';
	$var    = '0000';
	if($form_entrada["menuind"]) 
		$menuinden="1";
	else
		$menuinden ="0";		
	$new_cod      = $csecc.substr_replace($var, $cod2, strlen($var)-strlen($cod2), strlen($cod2)).'0000000000000000';
	
	$save_query = "INSERT INTO seccion (
					ccodseccion,
					ccodpage,
					ccodmodulo,
					ccodplantilla,
					ccodsecestilo,
					ccodsubestilo,
					ccodgrupo,
					cnomseccion,
					camiseccion,
					ctitseccion,
					cdesseccion,
					ctagseccion,
					cimgseccion,
					cestseccion,
					cnivseccion,
					cnewmenu,
					ctipseccion,
					curlseccion,
					cpagseccion,
					cordcontenido,
					dfecseccion,
					ccodusuario,
					dfecmodifica)
				   VALUES (
					'".$new_cod."',
					'".$form_entrada['selectpage']."',
					'".$form_entrada['selectmodulo']."',
					'".$form_entrada['selectplantilla']."',
					'".$form_entrada['selectestilo']."',
					'".$form_entrada['selectsub']."',
					'0',
					'".$form_entrada['titulo']."',
					'".$form_entrada['amigable']."',
					'".$form_entrada['txttitulo']."',
					'".$form_entrada['txtdetalle']."',
					'".$form_entrada['txttags']."',
					'".$form_entrada['imagencab']."',
					'1',
					'".($nivel+1)."',
					'".$menuinden."',
					'".$form_entrada['selectenlace']."',
					'".$form_entrada['rutaenlace']."',
					'".$form_entrada['txtpaginar']."',
					'".$form_entrada['selectorden']."',
					now(),
					'".$_SESSION['webuser_id']."',
					now()
					)";	
	
	db_query($save_query);
	$save_detalle = "INSERT INTO secciondetalle (ccodseccion, cnombre) values ('" . $new_cod . "',''  )";
	db_query($save_detalle);
	
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
