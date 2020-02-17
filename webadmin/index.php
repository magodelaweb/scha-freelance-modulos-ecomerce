<?php
/***********************************/
ob_start();
session_start();
//error_reporting(0);
include "../config.php";
include "include/funciones.php";
/***********************************/
function redirect()
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("panel.php");
	return $objResponse;
}
function procesar_formulario($form_entrada){
   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
   if ($form_entrada["email"]=="")			$error_form = " * Escriba correo electronico";
   else if ($form_entrada["clave"]=="")		$error_form = " * Escriba su Contrase�a";
   else
   {
   		$password = md5($form_entrada['clave']);
		$sqlogin = "SELECT ccodpersona,cemapersona,cnompersona,cimgpersona,cnivpersona FROM persona WHERE cemapersona = '".$form_entrada['email']."' AND cpaspersona = '".$password."' and cestpersona='1' and cnivpersona >7 ";
		$reslogin = db_query($sqlogin);
		if (db_num_rows($reslogin) != 0)
		{
		 	$user_data = db_fetch_array($reslogin);
			unset ($password);
			session_cache_limiter('nocache,private');
			$_SESSION['webuser_aut']        ='0';
			$_SESSION['webuser_id']         = $user_data['ccodpersona'];
			$_SESSION['webuser_email']      = $user_data['cemapersona'];
			$_SESSION['webuser_nombre']     = $user_data['cnompersona'];
			$_SESSION['webuser_foto']       = $user_data['cimgpersona'];
			$_SESSION['webuser_nivel']      = $user_data['cnivpersona'];
			$_SESSION['rutaimages']         = $user_data['ccodpersona']."/fotos";
			$_SESSION['pais']        = 'PE000000';
			if ($user_data['cnivpersona']=='9')
			{
				$sqldata = "SELECT * FROM page WHERE ccodpage='12172806'";
				$resdata = db_query($sqldata);
				while($rowdata = db_fetch_array($resdata))
				{
					$_SESSION['webuser_aut'] = '1';
					$_SESSION['plantilla']   = $rowdata['ccodplantilla'];
					$_SESSION['page']        = $rowdata['ccodpage'];
					$_SESSION['rutaimages']  = "web/".$rowdata['ccodpage']."/fotos";
				}
			}
			else
			{
				$sqldata = "SELECT * FROM page p, personapage pp WHERE p.ccodpage=pp.ccodpage and pp.ccodpersona='".$user_data['ccodpersona']."' and pp.ccodperfil='ADMIN'";
				$resdata = db_query($sqldata);
				while($rowdata = db_fetch_array($resdata))
				{
					$_SESSION['webuser_aut'] = '1';
					$_SESSION['plantilla']   = $rowdata['ccodplantilla'];
					$_SESSION['page']        = $rowdata['ccodpage'];
					$_SESSION['rutaimages']  = "web/".$rowdata['ccodpage']."/fotos";
				}
			}
			if($form_entrada['recordar']=="si")
			{
				setcookie ("user_vvr", "$form_entrada[email]", time () + 604800);
				setcookie ("pass_vvr", "$form_entrada[clave]", time () + 604800);
			}
			return redirect();
		}
		else
		{
			$error_form = " Correo Electronico y/o contrase�a son incorrectos.";
		}
	}
	if ($error_form!="")
	{
		$respuesta->addAssign("mensaje","innerHTML","<span style='color:black;'><b>$error_form</b></span>");
 		return $respuesta;
	 }
}

require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_formulario");
$xajax->processRequests();
$xajax->printJavascript("xajax/");
if (isset($_SESSION['webuser_aut'])&&($_SESSION['webuser_aut']=='1')) tep_redirect("panel.php")
?>
<html>
<head>
<title>JUVAME CMS: Sistema de administraci�n de contenidos</title>
<!--meta charset="ISO-8859-1"-->
<link  href='estilos/estilo.css'     rel='stylesheet' type='text/css'>
</head>
<body>
<div id="fondo">
<div id="cabecera">
	<div id="logo"></div>
</div>
	<div id="cuerpo">
		<div id="contenidocen">
<form id="index" name="index">
	<table width="400"  border='0' cellspacing='0' cellpadding='0' align="center">
		<tr>
			<td  height="73">&nbsp;</td>
		</tr>
		<tr>
			<td height="30" class='homecontenido' valign="top">
                <p><b>Correo Electr&oacute;nico</b></p>
				<input name="email" id="email" type="text" size="45" maxlength="50"  value="" ><BR>
                <p><b>Contrase&ntilde;a</b></p>
                <input name="clave" id="clave" type="password" size="45"  maxlength="30" value="" ><BR><BR>
                <input type="checkbox" name="recordar" value="si">Recordarme en este equipo<br><br>
                <input type="button" value="Ingresar"  onClick="xajax_procesar_formulario(xajax.getFormValues('index'))" />
		        <div id="mensaje"></div>
			</td>
		</tr>
	</table>
	</form>
        </div>
	</div>
</div>

</body>
</html>
