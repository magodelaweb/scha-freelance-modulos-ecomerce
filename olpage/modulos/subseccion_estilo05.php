<ul id="galeriafotos">
<?php 
$sql_seccion = "SELECT * FROM  seccion WHERE ccodseccion like '".$cat."%' and cnivseccion='".($nivsecc+1)."' AND cestseccion='1' order by cnomseccion ";
$que_seccion = db_query($sql_seccion);
while ($row_seccion=db_fetch_array($que_seccion))
{ 
	$enlaceurl     = $rutasec."/".$row_seccion['camiseccion'];
?>
	<li>
			<?php 	if($row_seccion['cimgseccion']!="")	{ ?>
				<a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>" ><img src="<?=$row_seccion['cimgseccion']?>" border="0" title="<?=$row_seccion['cnomseccion']?>" alt="<?=$row_seccion['cnomseccion']?>" width="180" height="140" ></a>
			<?php  } ?>
	<span><a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>" class="link_out"><?=$row_seccion['cnomseccion']?></a></span>
	</li>        
<?php  } ?>
</ul>