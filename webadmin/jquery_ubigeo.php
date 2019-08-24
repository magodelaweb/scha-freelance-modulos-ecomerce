<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
include "../config.php";
$pais   =substr($_POST["pais"],0,2);
$dpto   =substr($_POST["dpto"],0,4);
if ($pais<>'')
{
	echo "<option value='00000000' selected>Seleccione</option>";
	$sqldpto=db_query("SELECT * FROM webubigeo where ccodubigeo like '".$pais."%' and cnivubigeo='2'  ORDER BY cnomubigeo ");
	while($rowdpto=db_fetch_array($sqldpto))
	{
		echo "<option value=".$rowdpto['ccodubigeo'].">".$rowdpto['cnomubigeo']."</option>";
	} 
}
else
{
	echo "<option value='00000000' selected>Seleccione</option>";
	$sqlcity=db_query("SELECT * FROM webubigeo where ccodubigeo like '".$dpto."%' and cnivubigeo='3'  ORDER BY cnomubigeo ");
	while($rowcity=db_fetch_array($sqlcity))
	{
		echo "<option value=".$rowcity['ccodubigeo'].">".$rowcity['cnomubigeo']."</option>";
	} 
}
?>