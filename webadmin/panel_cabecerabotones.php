<?php
	$sqlhomemenu = "SELECT * FROM weboperaciones WHERE  cnivoperacion ='2' and cicooperacion='1' and cestoperacion='1' and ctipoperacion='A' order by ccodoperacion";
	$reshomemenu = db_query($sqlhomemenu);
	while ($rowhomemenu = db_fetch_array($reshomemenu)) 
		{
	?>
		<a href="<?=$rowhomemenu['cincoperacion']?>"><img src="estilos/images/<?=$rowhomemenu['cimgoperacion']?>" border="0" style="margin-top:8px;"></a>
  <?php	}	?>
