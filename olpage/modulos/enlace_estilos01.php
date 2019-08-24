<?php 
include  "modulos/articulo_estilo01.php";
$sql_query = "SELECT * FROM  contenido c, seccioncontenido s WHERE c.ccodcontenido=s.ccodcontenido  and s.ccodseccion = '".$codsecc."' AND c.cestcontenido='1' and c.ccodcategoria='1' order by c.dfeccontenido desc ";
$query = db_query($sql_query);
$total = db_num_rows($query);
$pag    = $pagina;
$numpags = ceil($total/$pagsecc);
$reg     = ($pag-1) * $pagsecc;
$producto_query = db_query($sql_query . " LIMIT " .$reg." , ".$pagsecc);
while ($row=db_fetch_array($producto_query))
{ 
	if($row['ctipcontenido']=="3")
	{
		$enlaceurl     = $row['curlcontenido'];
		$enlacedestino = "";
	}
	else
	{
		$enlaceurl     = $row['curlcontenido'];
		$enlacedestino = "target='_blank'";
	}
?>
	<div class="seccionindex100">
		<dl class="seccionindex" >
			<dt>
			<?php 
			if($row['cimgcontenido']!="")
			{
			?>
				<a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>" <?=$enlacedestino?>><img src="<?=ereg_replace('/fotos/','/thumbs/',$row['cimgcontenido'])?>" border="0" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" width="140" ></a>
            <?php  } ?>
	            <a href="<?=$enlaceurl?>" title="<?=$row['cnomcontenido']?>" <?=$enlacedestino?>><?=$row['cnomcontenido']?></a>
			</dt>
			<dd><?=$row['crescontenido']?></dd>
		</dl>
	</div>
<?php  }?>
<?=paginar($pag, $total, $pagsecc, 3, $rutasec);?>
