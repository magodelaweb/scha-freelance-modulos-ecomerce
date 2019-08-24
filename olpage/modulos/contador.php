<?php  
if (isset($_POST['url']))
{
	include "../config.php";
	include "../include/juvame.php";
		$sql_update="UPDATE persona SET 
						cdireccion  ='".$_POST['url']."'
					WHERE ccodpersona ='11061212'";
		$query   =db_query($sql_update);	
	
}
?>