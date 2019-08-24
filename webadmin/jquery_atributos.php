<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
include "../config.php";
$idcod = substr($_POST['codatri'],0,13);
$sqld  = "SELECT * FROM atributos WHERE ccodatributo like '".$idcod."%' and cnivatributo='2' order by cnomatributo";
$sqld_query = db_query($sqld);
$totaldetalle = db_num_rows($sqld_query);
$idcont2 = 1;
while($rowd=db_fetch_array($sqld_query))
{
	if ($idcont2 == 1) 
	{
		$idsele2="selected";
		$iddeta =$rowd['ccodatributo'];
	}
	else
	{
		$idsele2="";
	}
	$idcont2 = $idcont2+1;
	
	echo "<option value=".$rowd['ccodatributo']." ".$idsele2.">".$rowd['cnomatributo']."</option>";
} 
if ( $totaldetalle=='0')
{	
?>
	<script>
	$(document).ready(function(){
		$('#editdetalle').attr('disabled','disabled'); 
		$('#deldetalle').attr('disabled','disabled');
	})
	</script>
<?php  } else { ?>
	<script>
	$(document).ready(function(){
	   $('#editdetalle').attr('disabled',''); 
	   $('#deldetalle').attr('disabled','');
	})
	</script>
           
<?php  } ?>