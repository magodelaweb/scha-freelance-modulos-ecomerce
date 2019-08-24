<?php 
$sqlcontenido = db_query("SELECT * FROM  contenido c, contenidodetalle  cd WHERE c.ccodcontenido=cd.ccodcontenido and c.ccodcontenido='".$codcont ."'");
while ($row=db_fetch_array($sqlcontenido))
 { 
	?>
    <h1><?=$row['cnomcontenido']?></h1>
	<div id="articulo"><?=$row['cdetcontenido']?></div>
<?php  }?>
