<h1><?=buscador_titulo?></h1>
 <p><?=buscador_detalle?></p>

<?php 
/*************************** Buscador de articulos ************************/
if(isset($_POST['palabra'])) 
{
	$buspalabra = strtolower($_POST['palabra']);
	$sql_query  = "SELECT * FROM  seccioncontenido s, contenido c  WHERE s.ccodcontenido = c.ccodcontenido and (c.cnomcontenido LIKE '%".$buspalabra."%'  or  c.crescontenido LIKE '%".$buspalabra."%') group by c.ccodcontenido";
	$_SESSION['buscacontenido']=$sql_query;
}
if(isset($_POST['palabra']) or  ($_SESSION['buscacontenido']<>'')) 
{	
	$query      = db_query($_SESSION['buscacontenido']);
	$total      = db_num_rows($query);
	$pag        = $_GET['idsec2'];
	if ($pag=='') $pag = 1;
	$numPags = ceil($total/10);
	$reg     = ($pag-1) * 10;
	$buscar_query = db_query($_SESSION['buscacontenido'] . " LIMIT " .$reg." ,10");
}
if ($total >0) 
{
?>
	<?php  while ($rowlista=db_fetch_array($buscar_query)) 
	{ 
	$nomurl        = crearurl_articulo($rowlista['ccodseccion']);
	$enlaceurl     = "/".$nomurl.$rowlista['camicontenido'];
	$enlacedestino = "";

	if($rowlista['ctipcontenido']=="8")
	{
		$enlaceurl     = $rowlista['curlcontenido'];
		$enlacedestino = "";
	}
	if($rowlista['ctipcontenido']=="9")
	{
		$enlaceurl     = $rowlista['curlcontenido'];
		$enlacedestino = "target='_blank'";
	}

	?>
	<div class="seccionindex100">
		<dl class="seccionindex" >
			<dt>
			<?php 
			if($rowlista['cimgcontenido']!="")
			{
			?>
			<img src="<?=ereg_replace('fotos','thumbs',$rowlista['cimgcontenido'])?>" border="0" title="<?=$rowlista['cnomcontenido']?>"  width="140" height="140" alt="<?=$rowlista['cnomcontenido']?>" >
			<?php  } ?>
            
            </dt>
			<dd>
            <a href="<?=$enlaceurl?>" title="<?=$rowlista['cnomcontenido']?>" <?=$enlacedestino?>><?=$rowlista['cnomcontenido']?></a><br />
			<?=$rowlista['crescontenido']?>
			</dd>
		</dl>
	</div>
	<?php  } ?>
<?=paginar($pag, $total, 10, 3, '/buscador');
}
else 
{
?>
	<p>No se encontraron datos coincidentes con el criterio de busqueda </p>
<?php 
}
?>
