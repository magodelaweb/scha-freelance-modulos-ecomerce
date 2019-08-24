<?php 
$sqlcontenido = db_query("SELECT * FROM  contenido  WHERE ccodcontenido='".$codcont ."'");
while ($row=db_fetch_array($sqlcontenido))
 { 
	include "modulos/web_opciones.php"; 
	?>
	<h1><?=$row['cnomcontenido']?></h1>
  
	<?php  if (trim($row['cimgcontenido'])!="") 
		{ 
		?>
		<a href="<?=$row['cimgcontenido']?>"  title="<?=$row['cnomcontenido']?>"  rel="gb_imageset[nice_pics]">
        <img src="<?=$row['cimgcontenido']?>" width="<?=$columnacenancho?>" border="0" title="<?=$row['cnomcontenido']?>" alt="<?=$row['cnomcontenido']?>"  align="middle"></a>
	<?php  }?>
	<?=$row['credcontenido']?>
	<div class="articulopie">
		Publicado : <?=traducefecha($row['dfeccontenido'],'S')?>
	</div>
    
<?php  }?>


