<?php
ob_start();
session_start();
include "../config.php";
include "include/funciones.php";

$nombrefoto = "zz".date('ymdHis').codigo_azar(4).".jpg";
$ptimage = "web/".$_POST['pagina']."/fotos";
$pthumbs = ereg_replace('fotos','thumbs',$ptimage);
$rutafoto   = '../'.$ptimage.'/'. $nombrefoto;
$rutathum   = '../'.$pthumbs.'/'.$nombrefoto;
$fotosave   = '/'.$ptimage.'/'. $nombrefoto;
if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $rutafoto))
{
	chmod($rutafoto, 0777);
	//Agrega código de marca de agua
	$watermark = "www.schasociados.com"; // Add your own water mark here
	include_once('include/thumbnail.inc.php');

	$thumb = new Thumbnail($rutafoto);
	$thumb->resize(225,180);
	$thumb->crop(0,0,225,180);
	$thumb->save($rutathum);
	addTextWatermark($rutafoto, $watermark, $rutafoto);
	chmod($rutathum, 0777);
	addTextWatermark($rutathum, $watermark, $rutathum,true);	
//	$new_cod = $_POST['pagina'].date('ymdHis').codigo_azar(4);
	$save_contenido= "INSERT INTO contenidogaleria
						(
						ccodcontenido,ccodmodulo,cnomgaleria,cimggaleria,ccodusuario,dfecmodifica)
						values(
						'" . $_POST['item'] . "',
						'1400',
						'',
						'" . $fotosave. "',
						'" .$_SESSION['webuser_id']. "',
						now()
						)";
	db_query($save_contenido);
	echo $rutafoto."<br>";
} else {
	echo "Error";
}
?>
