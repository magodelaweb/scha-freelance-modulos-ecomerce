<?php 
$sql_grupo = "SELECT * FROM  secciongrupo WHERE ccodseccion like '".$cat."%'  ";
$que_grupo = db_query($sql_grupo);
$tot_grupo = db_num_rows($que_grupo);
if ($tot_grupo == 0)
{
	$sql_seccion = "SELECT * FROM  seccion WHERE ccodseccion like '".$cat."%' and cnivseccion='".($nivsecc+1)."'  and cestseccion='1' order by cnomseccion ";
	$que_seccion = db_query($sql_seccion);
	while ($row_seccion=db_fetch_array($que_seccion))
	{ 
		$enlaceurl     = $rutasec."/".$row_seccion['camiseccion'];
	?>
	<div class="seccionindex501">
		<dl class="seccionindex" >
			<dt></dt>
			<dd><a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>"><?=$row_seccion['cnomseccion']?></a></dd>
		</dl>
	</div>
<?php  } 
	echo "<div id='clear'></div>";
	echo "<br>";
}
else
{
	while ($row_grupo=db_fetch_array($que_grupo))
	{
		echo "<h3>".$row_grupo['cnomgrupo']."</h3><br>";
		$sql_seccion = "SELECT * FROM  seccion WHERE ccodseccion like '".$cat."%' and cnivseccion='".($nivsecc+1)."' AND ccodgrupo='".$row_grupo['ccodgrupo']."' and cestseccion='1' order by cnomseccion ";
		$que_seccion = db_query($sql_seccion);
		while ($row_seccion=db_fetch_array($que_seccion))
		{ 
			$enlaceurl     = $rutasec."/".$row_seccion['camiseccion'];
		?>
		<div class="seccionindex501">
			<dl class="seccionindex" >
			<dt></dt>
			<dd><a href="<?=$enlaceurl?>" title="<?=$row_seccion['cnomseccion']?>"><?=$row_seccion['cnomseccion']?></a></dd>
			</dl>
		</div>
		<?php  } 
		echo "<div id='clear'></div>";
		echo "<br>";
	}
}
?>