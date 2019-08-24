<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idopera']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	$pagew    = $_POST['idpage'];
	$_SESSION['page']=$_POST['idpage'];
	$sql_p = db_query("select * from page where ccodpage= '".$pagew."' ");
	while ($row_p = db_fetch_array($sql_p)) 
	{
		 echo "<option value='".$row_p['ccodpage']."'>".$row_p['cnompage']."</option>";		
	}	
}
?>
