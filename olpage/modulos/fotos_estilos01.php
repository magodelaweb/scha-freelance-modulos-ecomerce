<?php 
include "modulos/web_seccioncab.php";
?>

<ul id="galeriafotos">
<?php 
$sql_query = "SELECT * FROM  contenido c, seccioncontenido s WHERE c.ccodcontenido=s.ccodcontenido  and s.ccodseccion = '".$codsecc."' AND c.cestcontenido='1'  order by c.dfeccontenido desc ";

$query = db_query($sql_query);
$total = db_num_rows($query);
$pag    = $pagina;
$numpags = ceil($total/$pagsecc);
$reg     = ($pag-1) * $pagsecc;
$producto_query = db_query($sql_query . " LIMIT " .$reg." , ".$pagsecc);
while ($row=db_fetch_array($producto_query))
{ 
	if($row['curlcontenido']=="")
	{
		$nomurl        = crearurl_articulo($row['ccodseccion']);
		$enlaceurl     = "/".$nomurl.$row['camicontenido'];
		$enlacedestino = "";

	}
	else
	{
		$enlaceurl     = $row['curlcontenido'];
		$enlacedestino = "target='_blank'";
	}
?>
		<li>
        	<a href="<?=$row['cimgcontenido']?>" title="<?=$row['cnomcontenido']?>" rel="gb_imageset[nice_pics]"><img src="<?=ereg_replace('fotos','thumbs',$row['cimgcontenido'])?>" border="0" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" width="180" height="140" ></a>
            <span><?=$row['cnomcontenido']?></span>
		</li>
	
<?php 	} ?>
</ul>
<div id="clear"></div>    
<?=paginar($pag, $total, $pagsecc, 3, $rutasec);?>