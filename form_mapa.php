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
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3899.842525377739!2d-77.01044978578551!3d-12.19111624792036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105b98800cd60e7%3A0xdd1e870b6120ded6!2sSamuel%20Chamochumbi%20%26%20Asociados%20SAC!5e0!3m2!1ses-419!2spe!4v1566624069098!5m2!1ses-419!2spe" width="710" height="312" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
   </div>
</div>
