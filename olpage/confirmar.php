<?php 
include "config.php";
include "include/juvame.php";
$sql    = "SELECT cnompersona FROM persona  WHERE ccodautenticacion ='".$_GET['idok']."'";
$query  = db_query($sql);
$total  = db_num_rows($query);
if($total>0) 
	{		
		$sql_update= "update persona set cestpersona='1' , ccodautenticacion=''	where ccodautenticacion ='".$_GET['idok']."'";
		$query = db_query($sql_update);
	}
tep_redirect("/");	
?>