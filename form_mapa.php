<body>
<div style="width:711px;">
	<div class="textblog" style="border:none;">
    <ul>
    <?php
		$aclass->consulta("SELECT * FROM pagesucursal WHERE ccodpage='12172806' and cestsucursal='1' ORDER BY ccodsucursal");
		while($rowsucursal = $aclass->respuesta()){
	?>
		<li><p><?php echo $rowsucursal['cnomsucursal']." : ";?><a href="javascript:void(0)"><u><?php echo $rowsucursal['cdiroficina'];?></u></a></p></li>
	<?php  } ?>
	</ul>
	<div id="mapgoogle" style="width: 710px; height: 312px;"></div>
   </div>
</div>
