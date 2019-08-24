<?php 
$sqlpag   = db_query("SELECT * FROM  secciondetalle WHERE ccodseccion='".$codsecc."'");
while ($rowpag=db_fetch_array($sqlpag))
{
	echo "<h1>".$rowpag['cnombre']."</h1>";
	echo "<div id='articulo'>".$rowpag['cdetseccion']."</div>";
}
$sqlsubseccion = db_query("SELECT cincsecestilo FROM  estiloseccion WHERE ccodsecestilo = '".$subestilo."' ");
while ($rowsub=db_fetch_array($sqlsubseccion))
{
	$websubpag  = "modulos/".$rowsub['cincsecestilo'];
	include $websubpag;
	
}
?>