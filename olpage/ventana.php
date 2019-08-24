<?php 
include "config.php";
include "include/juvame_store.php";
include "include/juvame.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Banner</title>
<body>
<?php 
	$codigo= intval($_GET['ids']);
	$sqlban= db_query("SELECT * FROM pagehome where ccodinicio='".$_GET['ids']."' and ctiphome='6' "); 
	while($rowban  = db_fetch_array($sqlban))
	{
		echo $rowban['cadspubli'];
	}
?>

</body>
</html>