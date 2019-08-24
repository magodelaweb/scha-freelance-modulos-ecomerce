<?php 
$sql_seccion = "SELECT * FROM  seccion WHERE ccodseccion like '".$cat."%' and cnivseccion='".($nivsecc+1)."' AND cestseccion='1' order by cnomseccion ";
$que_seccion = db_query($sql_seccion);
while ($row_seccion=db_fetch_array($que_seccion))
{ 
	$enlaceurl     = $rutasec."/".$row_seccion['camiseccion'];
?>
	<div class="seccionindex50">
		<dl class="seccionindex" >
			<dt>
			<?php 	if($row_seccion['cimgseccion']!="")	{ ?>
				<a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>" ><img src="<?=$row_seccion['cimgseccion']?>" border="0" title="<?=$row_seccion['cnomseccion']?>" width="140" alt="<?=$row_seccion['cnomseccion']?>" ></a>
			<?php  } ?>
			</dt>
			<dd><a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>"><?=$row_seccion['cnomseccion']?></a><br /><?=$row_seccion['cdesseccion']?></dd>
		</dl>
	</div>
<?php  } ?>
