<?php 
$webubica ="2";
if ($webtipo<>'1')
{
	$sqlperfil2= db_query("SELECT p.clogo FROM  page p, pagesucursal s WHERE p.ccodpage=s.ccodpage and p.ccodpage ='".$codpage."'  "); 
	while($rowperfil2  = db_fetch_array($sqlperfil2))
	{
		?>
        <div id='perfilfoto'>
		<img src="<?=$rowperfil2['clogo']?>" width="190" border="0" align="left" />
        </div>
        <?php 
	}

}
if ($submenu=='0')
{
	$sqlmizq = db_query("SELECT * FROM  pagemenu  WHERE ccodpage='".$codpage."' and cubimenu='".$webubica."' and cestmenu='1'  ORDER BY cmenuorden");
	while ($rowmizq = db_fetch_array($sqlmizq))
	{
		echo "<ul id='izqmenu'>\n";
		echo "<li id='menuizqtitulo'><p>".$rowmizq['cnommenu']."</p></li>";
		$sqlsubmenu = db_query("SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  sm WHERE s.ccodseccion=sm.ccodseccion  and sm.ccodmenu='".$rowmizq['ccodmenu']."' and s.ccodpage='".$codpage."' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY sm.cordmenu");
		while ($rows_submenu = db_fetch_array($sqlsubmenu)) 
		{
			$tipo_seccion = $rows_submenu['ctipseccion'];
			$subcat   = substr($rows_submenu['ccodseccion'],0,12);
			switch($tipo_seccion)
			{
				case 1:
					$enlacemenu = "/".$rows_submenu['camiseccion'];
					break;
				case 2:
					$enlacemenu = $rows_submenu['curlseccion'];
					break;
			}
			?>
			<li><a href="<?=$enlacemenu?>"><?=$rows_submenu['cnomseccion']?></a>
            <?php 
            if ($rows_submenu['cnewmenu']=='0')
			{
			?>
            <ul>
            <?php 
			$sqlmenu2 = db_query("SELECT ccodseccion,cnomseccion,camiseccion,curlseccion, ctipseccion FROM  seccion WHERE ccodseccion like '".$subcat."%' and cnivseccion=2 and  cestseccion='1'  ORDER BY ccodseccion");
			while ($rows_submenu2 = db_fetch_array($sqlmenu2)) 
				{
					$tipo_seccion2 = $rows_submenu2['ctipseccion'];
					$subcat2   = substr($rows_submenu2['ccodseccion'],0,16);
					switch($tipo_seccion2)
					{
						case 1:
							$enlacemenu2 = "/".$rows_submenu['camiseccion']."/".$rows_submenu2['camiseccion'];
							break;
						case 2:
							$enlacemenu2 = $rows_submenu2['curlseccion'];
						break;
					}
				?>
	            <li><a href="<?=$enlacemenu2?>"><?=$rows_submenu2['cnomseccion']?></a>
                	<ul>
		            <?php 
					$sqlmenu3 = db_query("SELECT ccodseccion,cnomseccion,camiseccion,curlseccion, ctipseccion FROM  seccion WHERE ccodseccion like '".$subcat2."%' and cnivseccion=3 and  cestseccion='1'  ORDER BY ccodseccion");
					while ($rows_submenu3 = db_fetch_array($sqlmenu3)) 
						{
							$tipo_seccion3 = $rows_submenu3['ctipseccion'];
							$subcat3   = substr($rows_submenu3['ccodseccion'],0,20);
							switch($tipo_seccion3)
							{
								case 1:
									$enlacemenu3 = "/".$rows_submenu['camiseccion']."/".$rows_submenu2['camiseccion']."/".$rows_submenu3['camiseccion'];
									break;
								case 2:
									$enlacemenu3 = $rows_submenu3['curlseccion'];
									break;
							}
						?>
				            <li><a href="<?=$enlacemenu3?>"><?=$rows_submenu3['cnomseccion']?></a>
		                	<ul>
				            <?php 
								$sqlmenu4 = db_query("SELECT ccodseccion,cnomseccion,camiseccion,curlseccion, ctipseccion FROM  seccion WHERE ccodseccion like '".$subcat3."%' and cnivseccion=4 and  cestseccion='1'  ORDER BY ccodseccion");
								while ($rows_submenu4 = db_fetch_array($sqlmenu4)) 
								{
									$tipo_seccion4 = $rows_submenu4['ctipseccion'];
									switch($tipo_seccion4)
									{
										case 1:
											$enlacemenu4 = "/".$rows_submenu['camiseccion']."/".$rows_submenu2['camiseccion']."/".$rows_submenu3['camiseccion']."/".$rows_submenu4['camiseccion'];
											break;
										case 2:
											$enlacemenu4 = $rows_submenu4['curlseccion'];
											break;
									}
								?>
						            <li><a href="<?=$enlacemenu4?>"><?=$rows_submenu4['cnomseccion']?></a></li>
                            	<?php  } ?>
                            </ul>
                            </li>
						<?php  } ?>
					</ul>
                </li>
			<?php  } ?>               
            </ul>
            <?php  } ?>               
            </li>
	<?php  } 
	echo "</ul>";
	}
	
}
else
{
	echo "<ul id='izqmenu'>\n";
	echo "<li id='menuizqtitulo'><p>".$menusup."</p></li>";
	$catmenu = substr($codsecc,0,12);
	$sqlmenu = db_query("SELECT ccodseccion,cnomseccion,camiseccion,curlseccion, ctipseccion FROM  seccion WHERE ccodseccion like '".$catmenu."%' and cnivseccion='2' and  cestseccion='1'  ORDER BY cnomseccion");
	while ($rowmenu = db_fetch_array($sqlmenu)) 
		{
			$tipo_seccion = $rowmenu['ctipseccion'];
			switch($tipo_seccion)
			{
				case 1:
					$enlacemenu = "/".$_GET['idsec']."/".$rowmenu['camiseccion'];
					break;
				case 2:
					$enlacemenu = $rowmenu['curlseccion'];
					break;
			}
			?>
			<li><a href="<?=$enlacemenu?>"><?=$rowmenu['cnomseccion']?></a></li>
	<?php  } 
	echo "</ul>";
	
}
if ($webtipo<>'1')
{
	echo "<ul id='izqmenu'>\n";
	echo "<li id='menuizqtitulo'><p>Explora</p></li>";
	echo "<li><a href=''>Hoteles</a></li>";
	echo "</ul>";	
	echo "<ul id='izqmenu'>\n";
	echo "<li id='menuizqtitulo'><p>Conoce</p></li>";
	echo "<li><a href=''>Mancora</a></li>";
	echo "</ul>";	
	
}

if (empty($_GET['idsec']))
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and  ( d.ccoddestino='D' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
else
	$sqlc= db_query("SELECT p.*,d.ccoddestino,p.cordpublica FROM pagehome p, pagehomedet d where p.ccodinicio=d.ccodinicio and p.ccodpage ='".$codpage."' and ( d.ccoddestino='".$codsecc."' or d.ccoddestino='T') and p.cubidestino='".$webubica."' and p.cesthome='1' order by p.cordpublica "); 
while($rowc  = db_fetch_array($sqlc))
{
	if ($rowc['ctiphome']=='4') 
	{
	echo "<div id='".$rowc['ccodclase']."'>";
	echo "<div id='".$rowc['ccodclase']."titulo'>".$rowc['cnomhome']."</div>";
    echo "<div id='".$rowc['ccodclase']."contenido'>";
	}
	contenidosweb($rowc['ccodinicio'],$rowc['cnomhome'],$rowc['ctiphome'],$rowc['cimgpubli'],$rowc['curlpubli'],$rowc['cadspubli'],$rowc['ccodestilo'],$rowc['ccodmodulo'],$rowc['ccodseccion'],$rowc['ccodcategoria'],$rowc['ccodorden'],$rowc['nancho'],$rowc['nalto'],$rowc['nnroitems'],'columnacenbanner');
	if ($rowc['ctiphome']=='4')	echo "</div></div>";
}
?>

