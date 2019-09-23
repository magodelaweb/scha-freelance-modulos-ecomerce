<?php
session_start();
	require('inc/config.php');
	require('inc/class.php');
	require('inc/func.php');
	$aclass = new conexionClass;
	$bclass = new conexionClass;
	$pageno = isset($_POST["pageno"])?$_POST["pageno"]:1;
  $skip=($pageno-1)*12;
	$sql = "Select c.ccodcontenido,c.cnomcontenido,c.camicontenido,c.crescontenido,c.curlcontenido,s.ccodseccion,c.cimgcontenido,c.ccodmodulo,c.dfeccontenido,ctipcontenido,curlcontenido
	FROM contenido c, seccioncontenido s where c.ccodcontenido=s.ccodcontenido and  c.cestcontenido='1' and c.ccodmodulo='1200' and s.ccodseccion = '121728060002000000000000'
	order by c.ccodcontenido desc  LIMIT ".$skip." , 12";
	$aclass->consulta($sql);
	while($info=$aclass->respuesta()){
	/*$codcont = $info['ccodcontenido'];
		$bclass->consulta("UPDATE contenido SET nviscontenido = nviscontenido + 1  WHERE ccodcontenido = '".$codcont."'");*/
	$nomurl = crearurl_articulo($info[5],$bclass);/*v ($i%4)==0)?'' <style="margin-right:0;"*/
	echo '<div class="celda left f-fila">
	<div class="celdacont"><a class="segura" href="'.
	($nomurl.$info[2]).'"><img onerror="imgError(this);" class="segura" src="'.
	(str_replace('fotos','thumbs',substr($info[6],1))).
	''.'"/></a><p>'
	.$info[1].'</p></div></div>';
}
?>
<?php
function crearurl_articulo($articulocod, $clase){
	$codniv1 =substr($articulocod,0,12).'000000000000';
	$codniv2 =substr($articulocod,0,16).'00000000';
	$codniv3 =substr($articulocod,0,20).'0000';
	$codniv4 =substr($articulocod,0,24);
	$urlweb ="";
	$clase->consulta("SELECT ccodseccion, camiseccion FROM seccion WHERE ccodseccion ='".$codniv1."' or ccodseccion ='".$codniv2."'or ccodseccion ='".$codniv3."'or ccodseccion ='".$codniv4."'");
	while($row_url  = $clase->respuesta()){
		$urlweb .= $row_url['camiseccion'].'/';
	}
	return $urlweb;        //***Anotación por Arturo Martinez: "Esta funcion es llamada por los artículos (por ejemplo las fotos de los camiones)"
}
 ?>
