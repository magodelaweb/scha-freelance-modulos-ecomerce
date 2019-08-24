<br />
<ul id="galeriafotos">
<?php 
$sqlgaleria= db_query("select * from contenidogaleria where ccodcontenido='".$codcont."' order by ccodmodulo,ccodcontenido");
while($rowg=db_fetch_array($sqlgaleria))
{
?>	<li>
	   	<a href="<?=$rowg['cimggaleria']?>" title="<?=$rowg['cnomgaleria']?>" rel="gb_imageset[nice_pics]">
        <img src="<?=ereg_replace('fotos','thumbs',$rowg['cimggaleria'])?>"  width="160" height="120" border="0"/>
        </a>
	    <span><?=$rowg['cnomgaleria']?></span>
    </li>
<?php  } ?>
</ul>
<div id="clear"></div>
