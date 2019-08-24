<ul id="menupie">
	<?php 
	$sqlmenupie = "SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion FROM  seccion s, seccionmenu  su, pagemenu pm WHERE s.ccodseccion=su.ccodseccion and su.ccodmenu = pm.ccodmenu and pm.cubimenu='5' and s.ccodpage='".$codpage."' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY su.cordmenu";
	$resmenupie = db_query($sqlmenupie);
	while ($rowmenupie = db_fetch_array($resmenupie)) 
		{
			$tipo_pieseccion = $rowmenupie['ctipseccion'];
			switch($tipo_pieseccion)
			{
			case 1:
				$enlacepie = "/".$rowmenupie['camiseccion'];
				break;
			case 2:
				$enlacepie = $rowmenupie['curlseccion'];
				break;
			}
		?>
			<li <?php  if ($rowmenupie['camiseccion']==$seccionactiva) echo " id='active'" ?>><a href="<?=$enlacepie?>"><?=$rowmenupie['cnomseccion']?></a></li>
	<?php  } ?>
</ul>

