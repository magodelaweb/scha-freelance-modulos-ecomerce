<?php 
/*****************************************/
	include "include/config_seguro.php";
/*****************************************/
?>
<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
	<tr>
	<td align="center" valign="middle" height="200">

<?php 
//** Quienes somos ****/
	$sql_sec = db_query("SELECT * FROM  contenido WHERE ccodseccion='E1000000010100000000'");
	while ($rowsec=db_fetch_array($sql_sec))	
	{
	    $buffer ="<b>".$rowsec['cnomcontenido']."</b>";
		$buffer.="<body><mainBody><img src='../webfiles/fotos/".$rowsec['cimgcontenido']."'>";
		$buffer.= "<br>".$rowsec['cdetcontenido']."</mainBody></body>";
	}
  $file=fopen("../es/xml/quienesomos.html","w+");
  fwrite ($file,$buffer);
  fclose($file);

//*** Servicios
	$txtseccion ='<?xml version="1.0" encoding="utf-8"?>';
	$txtseccion .="\n";
	$txtseccion .="<collection>\n";
	$sql_sec2 = db_query("SELECT * FROM  contenido WHERE ccodseccion='E1000000010200000000'");
	while ($rowsec2=db_fetch_array($sql_sec2))	
	{
		$txtseccion.="<news thumb='../webfiles/fotos/t".$rowsec2['cimgcontenido']."' date='".$rowsec2['cnomcontenido']."' title='".trim($rowsec2['crescontenido'])."'>\n";
		$txtseccion.="<![CDATA[<span class='newsDate'>".trim($rowsec2['cnomcontenido'])."</span><br><br>";
		$txtseccion.="<img src='../webfiles/fotos/".$rowsec2['cimgcontenido']."' align='right'>";
		$txtseccion.="<span class='textColor'>".trim($rowsec2['cdetcontenido'])."</span>";
		$txtseccion.="]]>\n";
		$txtseccion.="</news>\n";
	}
	$txtseccion.="</collection>\n";
	$file=fopen("../es/xml/servicios.xml","w+");
	fwrite ($file,$txtseccion);
	fclose($file);
//*** Portafolio 
	$txtportafolio ="<gallery title='Portafolio' thumbDir='../webfiles/fotos/' imageDir='../webfiles/fotos/' random='true'>\n";
	$sqlspor = db_query("SELECT * FROM seccion WHERE ccodseccion like 'E10000000103%' and cnivseccion='2'");
	while ($rowpor=db_fetch_array($sqlspor))	
	{
		$txtportafolio.="<album title='".."' description='".."'>" "<category name='".$rowpor['cnomseccion']."'>\n";	
		$sql_por = db_query("SELECT * FROM  contenido WHERE ccodseccion='".$rowpor['ccodseccion']."'");
		while ($rowpor=db_fetch_array($sql_por))	
		{
			$txtportafolio.="<image>\n";
			$txtportafolio.="<date>".$rowpor['dfeccontenido']."</date>\n";
			$txtportafolio.="<title>".$rowpor['cnomcontenido']."</title>\n";
			$txtportafolio.="<desc>".$rowpor['cnomcontenido']."</desc>\n";
			$txtportafolio.="<thumb>".$rowpor['cimgcontenido']."</thumb>\n";
			$txtportafolio.="<img>".$rowpor['cimgcontenido']."</img>\n";
			$txtportafolio.="</image>\n";
		}
		$txtportafolio.="</category>\n";
	}
	$file=fopen("../es/xml/portafolio.xml","w+");
	fwrite ($file,$txtportafolio);
	fclose($file);

//*** Clientes
	$txtclientes ='<?xml version="1.0" encoding="utf-8"?>';
	$txtclientes .="\n";
	$txtclientes .= "<collection>\n";
	$sql_cli     = db_query("SELECT * FROM  contenido WHERE ccodseccion='E1000000010400000000'");
	while ($rowcli=db_fetch_array($sql_cli))	
	{
		$txtclientes.="<news thumb='../webfiles/fotos/t".$rowcli['cimgcontenido']."' date='".$rowcli['cnomcontenido']."' title='".trim($rowcli['crescontenido'])."'>\n";
		$txtclientes.="<![CDATA[<span class='newsDate'>".trim($rowcli['cnomcontenido'])."</span><br><br>";
		$txtclientes.="<img src='../webfiles/fotos/".$rowcli['cimgcontenido']."' align='right'>";
		$txtclientes.="<span class='textColor'>".trim($rowcli['cdetcontenido'])."</span>";
		$txtclientes.="]]>\n";
		$txtclientes.="</news>\n";
	}
	$txtclientes.="</collection>\n";

	$file=fopen("../es/xml/clientes.xml","w+");
	fwrite ($file,$txtclientes);
	fclose($file);		
echo "<br>Publicacion completada</p>";
?> 
</td>
</tr>
</table>