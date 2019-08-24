
<?php 
$webubica ="5";
if (empty($_GET['idsec']))
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and  ( d.ccoddestino='D' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
else
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and ( d.ccoddestino='".$codsecc."' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
while($rowc  = db_fetch_array($sqlc))
{
	if ($rowc['ctiphome']=='4') 
	{
	echo "<div id='".$rowc['cclase']."'>";
	echo "<div id='".$rowc['cclase']."titulo'>".$rowc['cnomhome']."</div>";
    echo "<div id='".$rowc['cclase']."contenido'>";
	}
	contenidosweb($rowc['ccodinicio'],$rowc['cnomhome'],$rowc['ctiphome'],$rowc['cimgpubli'],$rowc['curlpubli'],$rowc['cadspubli'],$rowc['ccodestilo'],$rowc['ccodmodulo'],$rowc['ccodseccion'],$rowc['ccodcategoria'],$rowc['ccodorden'],$rowc['nancho'],$rowc['nalto'],$rowc['nnroitems'],'columnacenbanner');
	if ($rowc['ctiphome']=='4')	echo "</div></div>";
}

?>
