<?php 
	if (empty($_GET['idsec']))
	{
		$seccionactiva ="inicio";
	}
	else
	{
		$seccionactiva = $_GET['idsec'];
	}

	if ($dominio==$midominio)
	{	
		$rutadominio ="http://www.".$dominio;
		$sqlmenucab = "SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  su, pagemenu pm WHERE s.ccodseccion=su.ccodseccion and su.ccodmenu = pm.ccodmenu and pm.cubimenu='1' and s.ccodpage='12172806' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY su.cordmenu";
	}
	else
	{	
		$rutadominio ="";
		$sqlmenucab = "SELECT s.ccodseccion,s.cnomseccion,s.camiseccion,s.curlseccion,s.ctipseccion,s.cnewmenu FROM  seccion s, seccionmenu  su, pagemenu pm WHERE s.ccodseccion=su.ccodseccion and su.ccodmenu = pm.ccodmenu and pm.cubimenu='1' and s.ccodpage='".$codpage."' and s.cnivseccion=1 and  s.cestseccion='1'  ORDER BY su.cordmenu";
	}
		
	$resmenucab = db_query($sqlmenucab);
	echo "<ul id='cabmenu'>\n";
	while ($rowmenucab = db_fetch_array($resmenucab)) 
		{
			$s1 = substr($rowmenucab['ccodseccion'],0,12);
			$tipo_cabseccion = $rowmenucab['ctipseccion'];
			switch($tipo_cabseccion)
			{
			case 1:
				$enlacecab = $rutadominio."/".$rowmenucab['camiseccion'];
				break;
			case 2:
				$enlacecab = $rowmenucab['curlseccion'];
				break;
			}
			$estactiva="";
			if ($rowmenucab['camiseccion']==$seccionactiva) $estactiva= " id='active'";
			echo "<li ".$estactiva."><a href='".$enlacecab."' title='".$rowmenucab[cnomseccion]."' >".$rowmenucab[cnomseccion]."</a>";
			if ($rowmenucab['cnewmenu']=='0')
			{
			echo "<ul>";
			$sqlmenucab2 = "SELECT ccodseccion,cnomseccion,camiseccion,curlseccion,ctipseccion FROM seccion  WHERE  ccodseccion like '".$s1."%'  and cnivseccion=2 and  cestseccion='1' ";
			$resmenucab2 = db_query($sqlmenucab2);
			$nromenucab2 = db_num_rows($resmenucab2);
			while ($rowmenucab2 = db_fetch_array($resmenucab2)) 
			{
				$s2 = substr($rowmenucab2['ccodseccion'],0,16);
				$tipo2 = $rowmenucab2['ctipseccion'];
				switch($tipo2)
				{
				case 1:
					$enlacecab2 = $rutadominio."/".$rowmenucab['camiseccion']."/".$rowmenucab2['camiseccion'];
					break;
				case 2:
					$enlacecab2 = $rowmenucab2['curlseccion'];
					break;
				}
				echo "<li ><a href='".$enlacecab2."'>".$rowmenucab2[cnomseccion]."</a>";
				echo "<ul >";
				$sqlmenucab3 = "SELECT ccodseccion,cnomseccion,camiseccion,curlseccion,ctipseccion FROM seccion  WHERE  ccodseccion like '".$s2."%'  and cnivseccion=3 and  cestseccion='1' ";
				$resmenucab3 = db_query($sqlmenucab3);
				$nromenucab3 = db_num_rows($resmenucab3);
				while ($rowmenucab3 = db_fetch_array($resmenucab3)) 
				{
					$s3 = substr($rowmenucab3['ccodseccion'],0,20);
					$tipo3 = $rowmenucab3['ctipseccion'];
					switch($tipo3)
					{
					case 1:
						$enlacecab3 = $rutadominio."/".$rowmenucab['camiseccion']."/".$rowmenucab2['camiseccion']."/".$rowmenucab3['camiseccion'];
						break;
					case 2:
						$enlacecab3 = $rowmenucab3['curlseccion'];
						break;
					}
					echo "<li><a href='".$enlacecab3."'>".$rowmenucab3[cnomseccion]."</a>";
					echo "<ul >";
					$sqlmenucab4 = "SELECT ccodseccion,cnomseccion,camiseccion,curlseccion,ctipseccion FROM seccion  WHERE  ccodseccion like '".$s3."%'  and cnivseccion=4 and  cestseccion='1' ";
					$resmenucab4 = db_query($sqlmenucab4);
					$nromenucab4 = db_num_rows($resmenucab4);
					while ($rowmenucab4 = db_fetch_array($resmenucab4)) 
					{
						$tipo4 = $rowmenucab4['ctipseccion'];
						switch($tipo4)
						{
						case 1:
							$enlacecab4 = $rutadominio."/".$rowmenucab['camiseccion']."/".$rowmenucab2['camiseccion']."/".$rowmenucab3['camiseccion']."/".$rowmenucab4['camiseccion'];
							break;
						case 2:
							$enlacecab4 = $rowmenucab4['curlseccion'];
							break;
						}
						echo "<li><a href='".$enlacecab4."'>".$rowmenucab4[cnomseccion]."</a></li>\n";
					}
					echo "</ul>\n";
					echo "</li>\n";
				}
				echo "</ul>\n";
				echo "</li>\n";
			}
			echo "</ul>\n";
			}
			echo "</li>\n";
		}
	echo "</ul>\n";
?>
