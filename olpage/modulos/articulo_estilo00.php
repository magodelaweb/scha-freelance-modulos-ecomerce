<?php 
include "modulos/web_seccioncab.php";
$sql_query = "SELECT * FROM  contenido c, seccioncontenido s, contenidodetalle d WHERE c.ccodcontenido=s.ccodcontenido and c.ccodcontenido=d.ccodcontenido and s.ccodpage='".$codpage."' and s.ccodseccion = '".$codsecc."' AND c.cestcontenido='1' order by c.dfeccontenido desc ";
$query = db_query($sql_query);
$total = db_num_rows($query);
$pag    = $pagina;
$numpags = ceil($total/$pagsecc);
$reg     = ($pag-1) * $pagsecc;
$producto_query = db_query($sql_query . " LIMIT " .$reg." , ".$pagsecc);
while ($row=db_fetch_array($producto_query))
{
	$codcont       = $row['ccodcontenido'];
	$nomurl        = crearurl_articulo($row['ccodseccion']);
	$enlaceurl     = "/".$nomurl.$row['camicontenido'];
	$enlacedestino = "";

	if($row['ctipcontenido']=="8")
	{
		$enlaceurl     = $row['curlcontenido'];
		$enlacedestino = "";
	}
	if($row['ctipcontenido']=="9")
	{
		$enlaceurl     = $row['curlcontenido'];
		$enlacedestino = "target='_blank'";
	}
	$sqlesti = "SELECT * FROM estilocontenido WHERE ccodestcontenido='".$row['ccodestcontenido']."'";
	$queryes = db_query($sqlesti);
	while ($rowes = db_fetch_array($queryes))
	{
		$webestiloes = $rowes['cincestcontenido'];
		include "modulos/".$webestiloes;
	}
}?>
<div id="clear"></div>  
<?=paginar($pag, $total, $pagsecc, 3, $rutasec);?>
