<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idopera']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	$page   = $_POST['idpage'];
	$_SESSION['page']=$_POST['idpage'];
}
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/fotos";

$sql_menuubi = db_query("select * from pagemenu where ccodpage='".$_SESSION['page']."' and cestmenu='1'");
while ($row_menuubi = db_fetch_array($sql_menuubi)) 
{	
	$check="";
	echo "<div style='width:150px; float:left;'><input type='checkbox' name='rdmenu".$row_menuubi['ccodmenu']."' ".$check.">".$row_menuubi['cnommenu']."</div>";
}
?>
