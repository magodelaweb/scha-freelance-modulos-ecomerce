<?php 
$sqlcontenido = db_query("SELECT * FROM  contenido c, contenidodetalle  cd WHERE c.ccodcontenido=cd.ccodcontenido and c.ccodcontenido='".$codcont ."'");
while ($row=db_fetch_array($sqlcontenido))
 { 
?>
	<h1><?=$row['cnomcontenido']?></h1>
   	<div id="articulo">
	<?php  if (trim($row['cimgcontenido'])!="") 
		{ 
		?>
		<a href="<?=$row['cimgcontenido']?>"  title="<?=$row['cnomcontenido']?>"  rel="gb_imageset[nice_pics]">
        <img src="<?=$row['cimgcontenido']?>" width="<?=$columnacenancho?>" border="0" title="<?=$row['cnomcontenido']?>" alt="<?=$row['cnomcontenido']?>" ></a>
	<?php  }?>
	<?=$row['cdetcontenido']?>
    </div>
   <h5><?=traducefecha($row['dfeccontenido'],'S')?></h5>
	<div id="clear"></div> 
<?php  }?>

