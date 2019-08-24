<?php 
$webubica ="4";
if (empty($_GET['idsec']))
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and  ( d.ccoddestino='D' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
else
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and ( d.ccoddestino='".$codsecc."' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
while($rowc  = db_fetch_array($sqlc))
{
	if ($rowc['ctiphome']=='4') 
	{
		echo "<div id='".$rowc['ccodclase']."'>";
		echo "<div id='".$rowc['ccodclase']."titulo'><span>".$rowc['cnomhome']."</span></div>";
	    echo "<div id='".$rowc['ccodclase']."contenido'>";
		contenidosweb($rowc['ccodinicio']);
		echo "</div></div>";
	}
	else
	{
		contenidosweb($rowc['ccodinicio']);
	}
}
?>