<?php
if($paramSec=='home'){
	include("inchome.php");
}
elseif($paramSec2!='home-next'){
	include("inchomenext.php");
}
elseif($paramSec2!=''){
	include("incdetalle.php");
}else include("incequipo.php");
 ?>
