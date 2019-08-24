<?php 
$sqlcontenido = db_query("SELECT * FROM  contenido c, contenidodetalle  cd WHERE c.ccodcontenido=cd.ccodcontenido and c.ccodcontenido='".$codcont ."'");
while ($row=db_fetch_array($sqlcontenido))
 { 
?>
	<h1><?=$row['cnomcontenido']?></h1>
    <div id="articulo">
	<?php  if (trim($row['cimgcontenido'])!="") 
		{ 
	echo "<div id='wrapper'>\n";
	echo "<div id='slider-wrapper'>\n";
	echo "<div id='slider1' class='nivoSlider'>\n";
		
		?>
		<a href="<?=$row['cimgcontenido']?>"  title="<?=$row['cnomcontenido']?>" rel="gb_imageset[nice_pics]"><img src="<?=ereg_replace('fotos','thumbs',$row['cimgcontenido'])?>" border="0"  width="250" height="150" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" ></a>
		<a href="<?=$row['cimgcontenido']?>"  title="<?=$row['cnomcontenido']?>" rel="gb_imageset[nice_pics]"><img src="<?=ereg_replace('fotos','thumbs',$row['cimgcontenido'])?>" border="0"  width="250" height="150" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" ></a>
		<a href="<?=$row['cimgcontenido']?>"  title="<?=$row['cnomcontenido']?>" rel="gb_imageset[nice_pics]"><img src="<?=ereg_replace('fotos','thumbs',$row['cimgcontenido'])?>" border="0"  width="250" height="150" title="<?=$row['cnomcontenido']?>"  alt="<?=$row['cnomcontenido']?>" ></a>
	<?php 
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";	
	
	 }?>
    <?=$row['cdetcontenido']?>
    </div>
    <?php  include "modulos/web_galerias.php";?>
    <?php  include "modulos/web_comentarios.php";?>
<?php  }?>

