<?php 
$webubica ="1";
if ($webtipo<>'1')
{
	$sqlperfil= db_query("SELECT * FROM  page p, pagesucursal s WHERE p.ccodpage=s.ccodpage and p.ccodpage ='".$codpage."'  "); 
	while($rowperfil  = db_fetch_array($sqlperfil))
	{
		echo "<div id='perfilcabecera'>";
		echo "<h1>$rowperfil[cnompage]</h1>";
		echo $rowperfil[cdiroficina]." ".nombre_pais($rowperfil[ccodpais]);
		echo "</div>";
		$telefono = '';
		if ($rowperfil['ctelsucursal']<>'')	$telefono .= ' <b>Teléfono:</b> '.$rowperfil['ctelsucursal']." ";
		if ($rowperfil['cfaxsucursal']<>'')	$telefono .= ' <b>Telefax:</b> '.$rowperfil['cfaxsucursal']." ";
		if ($rowperfil['cmovsucursal']<>'')	$telefono .= ' <b>Móvil:</b> '.$rowperfil['cmovsucursal']." ";
		if ($rowperfil['cnexsucursal']<>'')	$telefono .= ' <b>Nextel:</b> '.$rowperfil['cnexsucursal']."";
	}
	
}
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
		contenidosweb($rowc['ccodinicio']);
		echo "</div></div>";
	}
	else
	{
		contenidosweb($rowc['ccodinicio']);
	}
}
?>
