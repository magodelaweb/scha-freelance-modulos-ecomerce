<?php  
include "modulos/seccion_titulo.php";
$sql_query = "SELECT * FROM  contenido c, seccioncontenido s WHERE c.ccodcontenido=s.ccodcontenido  and s.ccodseccion = '".$codsecc."' AND c.cestcontenido='1' and c.ccodcategoria='1' order by c.dfeccontenido desc ";
$query = db_query($sql_query);
$total = db_num_rows($query);
$pag    = $pagina;
$numpags = ceil($total/$pagsecc);
$reg     = ($pag-1) * $pagsecc;
$producto_query = db_query($sql_query . " LIMIT " .$reg." , ".$pagsecc);
while ($row=db_fetch_array($producto_query))
{ 
		$enlaceurl     = WEB_DOMINIO."webfiles/descarga/".$row['curlcontenido'];
		$enlacedestino = "target='_blank'";
?>
	<div class="seccionindex100">
	
		<dl class="seccionindex" >
			<dt>
			<?php 
			if($row['cimgcontenido']!="")
			{
			?>
			<a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>" <?=$enlacedestino?>><img src="<?=ereg_replace('/fotos/','/fotos/thumbs/',$row['cimgcontenido'])?>" border="0" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" ></a>
			<?php  } ?>
			</dt>
			<dd>
   			<a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>" <?=$enlacedestino?>><?=$row['cnomcontenido']?></a><br>
			<?=$row['crescontenido']?>
			</dd>
		</dl>
	</div>
<?php  }?>
<?=paginar($pag, $total, $pagsecc, 3, $rutasec);?></div>
