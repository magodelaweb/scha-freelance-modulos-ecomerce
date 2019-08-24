<?php
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";

$nombrefoto = "zy".date('ymdHis').codigo_azar(4).".jpg";
$ptimage = "web/".$_POST['pagina']."/fotos";
$pthumbs = ereg_replace('fotos','thumbs',$ptimage);
$rutafoto   = '../'.$ptimage.'/'. $nombrefoto;
$rutathum   = '../'.$pthumbs.'/'.$nombrefoto;
$fotosave   = '/'.$ptimage.'/'. $nombrefoto;
if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $rutafoto)) 
{ 
	include_once('include/thumbnail.inc.php');

	$thumb = new Thumbnail($rutafoto);
	$thumb->resize(225,180);
	$thumb->crop(0,0,225,180);
	$thumb->save($rutathum);
	$new_cod = $_POST['pagina'].date('ymdHis').codigo_azar(4);
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
						dfecmodifica)
						values(
						'" . $new_cod . "', 
						'" . $_POST['pagina'] . "', 
						'1',
						'1400', 
						'1401', 
						'', 
						'F" . $new_cod . "', 
						'', 
						'', 
						'" . $fotosave. "', 
						'1',
						'1',
						'',				
						'1',
						now(), 
						'" .$_SESSION['webuser_id']. "',
						now()
						)";		
	db_query($save_contenido);
	$save_seccion="INSERT INTO seccioncontenido (ccodpage,ccodseccion, ccodcontenido ) values ('".$_POST['pagina']."','" . $_POST['seccion'] . "', '" . $new_cod . "' )";
	db_query($save_seccion);


	
	echo $rutafoto."<br>"; 
} else {
	echo "Error";
}
?>
