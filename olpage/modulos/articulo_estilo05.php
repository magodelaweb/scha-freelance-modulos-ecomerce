<?php 
include "modulos/web_seccioncab.php";
?>
<ul id="galeriafotos">
<?php 
$sql_query = "SELECT * FROM  contenido c, seccioncontenido s WHERE c.ccodcontenido=s.ccodcontenido and s.ccodpage='".$codpage."' and s.ccodseccion = '".$codsecc."' AND c.cestcontenido='1'  order by c.ccodcontenido desc ";
$query = db_query($sql_query);
$total = db_num_rows($query);
$pag    = $pagina;
$numpags = ceil($total/$pagsecc);
$reg     = ($pag-1) * $pagsecc;
$producto_query = db_query($sql_query . " LIMIT " .$reg." , ".$pagsecc);
while ($row=db_fetch_array($producto_query))
{ 
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
?>
		<li>
        	<a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>" <?=$enlacedestino?>><img src="<?=ereg_replace('/fotos/','/thumbs/',$row['cimgcontenido'])?>" border="0" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>"  width="200" height="150"></a>
            <span><a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>"><?=$row['cnomcontenido']?></a></span>
		</li>
	
<?php 	} ?>
</ul> 
<div id="clear"></div>       
<?=paginar($pag, $total, $pagsecc, 3, $rutasec);?>
