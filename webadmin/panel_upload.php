<?php 
function get_file_extension($filename)
{		preg_match("/(.*)\.([a-zA-Z0-9]{0,5})$/", $filename, $regs);
		return($regs[2]);
}
if (isset($_POST['listadoarchivos']))
{ 
	echo "<script languaje='javascript'>"; 
	echo "window.opener.document.all.".$_REQUEST['name'].".value ='".$_POST['listadoarchivos']."';"; 
	echo "window.close();"; 
	echo "</script>"; 
}
if (isset($_POST['Aceptar'])){ 
	$ext = strtoupper(get_file_extension($_FILES["textimg"]["name"]));
	$ruta = $_REQUEST['ruta']."/"; 
	if (in_array($ext, array("SWF", "GIF", "JPG", "PNG","XLS","DOC","PDF","PPT","PPS"))) { 
	if ($_FILES['textimg']['size'] < 8000000) {
		if ($_REQUEST['cod']!='')
			$nombreImagen = $_REQUEST['tit'] . $_REQUEST['cod'] . '.' . $ext;
		else
			$nombreImagen = $_REQUEST['tit'] . substr($_SESSION['webuser_codempresa'],0,6) . '_' . $_FILES[textimg]["name"];
			
		$nombreImagen=strtolower($nombreImagen);
		move_uploaded_file($HTTP_POST_FILES['textimg']['tmp_name'], $ruta.$nombreImagen);
			$name = $nombreImagen;
			echo "<script languaje='javascript'>"; 
			echo "window.opener.document.all.".$_REQUEST['name'].".value ='".$name."';"; 
			echo "window.close();"; 
			echo "</script>"; 
		}
		else
			$mensaje = "El archivo es muy pesado, tamaño maximo  1 MB. Utilize cualquier editor para reducir su peso";
	}
	else{
		if ($_FILES["textimg"]["name"]=='')
			$mensaje = "Debe seleccionar un archivo ";
		else
			$mensaje = "Se permiten Imagenes y/o animaciones GIF, JPG, PNG, PDF,PPT,PPS,XLS,DOC y SWF";
	}
}

?>
<html>
<head>
<title>Administrar Imagenes</title>
<link rel="stylesheet" type="text/css" href="estilos/estilo.css">
</head>
<body  bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="598" border="0" align="center" cellpadding="0" cellspacing="0" >
<form name="dynamicselector" action="panel_upload.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="ruta" value="<?=$_REQUEST['ruta']?>" >
<input type="hidden" name="tit" value="<?=$_REQUEST['tit']?>" >
<input type="hidden" name="cod" value="<?=$_REQUEST['cod']?>" >
<input type="hidden" name="name" value="<?=$_REQUEST['name']?>">

<tr>
	<td colspan="2"  class='titlehome'>Listado de Imagenes</td>
</tr>
<tr>
	<td width="300" valign="top"  class='colgrishome' height="285">
		<select name="listadoarchivos" size="17" style="width:330px ">
		<?php 
		$dir = $_REQUEST['ruta']."/";
		$dh  = opendir($dir);
		while (false !== ($nombre_archivo = readdir($dh))) {
		    $archivos[] = $nombre_archivo;
		}
		sort($archivos);
		$nelementos=count($archivos);
		for ($i = 2; $i <= $nelementos-1; $i++) 
		{?>
		    <option value="<?=$archivos[$i]?>" ><?=$archivos[$i]?></option>
		<?php 
		}
		?> 		
		</select>
		</td>
		<td class='colblancoend'>
			<div id="verimagen"></div>
		</td>
	</tr>
	 <tr>
	    <td height="25" class='colgrishome' colspan="2"  align="center"><b>Nueva imagen:</b><input name="textimg" id="textimg" type="file" size="40"></td>
	</tr>
  <tr>
    <td height="10" colspan="2" class='colgrishome'><?php  if (isset($mensaje)) echo " ".$mensaje." "; ?></td>
  </tr>

	<tr>
		<td height="25" colspan="2" class='formpie' align="center" >
			<input type="submit" name="Aceptar" value="Aceptar" class="cssboton">
			<input type="button" name="Cerrar" value="Cancelar" onClick="javascript:window.close();" class="cssboton">	</td>
  </tr>
</form>
</table>
</body>
</html>