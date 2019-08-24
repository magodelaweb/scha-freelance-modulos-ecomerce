<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idopera']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	$pagew    = $_POST['idpage'];
	$modulow  = $_POST['idmodulo'];
	$_SESSION['page']=$_POST['idpage'];
}
else
{
	$pagew = $_SESSION['page'];
	$modulow ="1100";
}
echo "<option value='00'> Todas</option>";
$sql_secniv = db_query("select * from seccion where ccodpage= '".$pagew."' and ccodmodulo='".$modulow."' and ctipseccion='1' order by ccodseccion");
while ($row_secniv = db_fetch_array($sql_secniv)) 
{
	if ($row_secniv['cnivseccion']=='1') echo "<option value='".$row_secniv['ccodseccion']."'>".$row_secniv['cnomseccion']."</option>";		
	if ($row_secniv['cnivseccion']=='2') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
	if ($row_secniv['cnivseccion']=='3') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
	if ($row_secniv['cnivseccion']=='4') echo "<option value='".$row_secniv['ccodseccion']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;".$row_secniv['cnomseccion']."</option>";		
}	
?>
