<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
if ($_POST['idopera']=='1')
{
	ob_start();
	session_start();	
	include "../config.php";
	$pagew   = $_POST['idpage'];
	$modulo = $_POST['idmodulo'];
	$iditem = $_POST['iditem'];
	$_SESSION['page']=$_POST['idpage'];
}
else
{
	$pagew = $pageweb;
	$iditem = $_GET['IDpro'];
	$_SESSION['page']=$pagew;
}
$_SESSION['rutaimages']  = "web/".$_SESSION['page']."/fotos";
?>
<script type="text/javascript">
jQuery(document).ready(function(){
		$('ul#menuseccion').collapsibleCheckboxTree({
		checkParents : false, // When checking a box, all parents are checked (Default: true)
		checkChildren : false, // When checking a box, all children are checked (Default: false)
		uncheckChildren : true, // When unchecking a box, all children are unchecked (Default: true)
		initialState : 'default' // Options - 'expand' (fully expanded), 'collapse' (fully collapsed) or default
												});
});
</script>
       <?php 
	    echo "<ul id='menuseccion'>";
			$seccion_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage='".$pagew."' and cestseccion ='1' and ccodmodulo='".$modulo."'  and cnivseccion='1' and ctipseccion='1' order by cnomseccion");
			while($row_seccion = db_fetch_array($seccion_sql)) 
				{
				$s1sql = db_query("select * from seccioncontenido where ccodseccion='".$row_seccion[ccodseccion]."' and ccodcontenido='".$iditem."'");
				$s1ok = db_num_rows($s1sql);
				if ($s1ok=='0')
			        echo "<li><input type='checkbox' name='select".$row_seccion[ccodseccion]."'>".$row_seccion['cnomseccion'];
				else
					echo "<li><input type='checkbox' name='select".$row_seccion[ccodseccion]."' checked>".$row_seccion['cnomseccion'];
				$niv1cod = substr($row_seccion[ccodseccion],0,12);
				$seccion2_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv1cod."%' and cestseccion ='1' and cnivseccion='2' and ctipseccion='1' order by cnomseccion");
				$total2 = db_num_rows($seccion2_sql);
				if ($total2<>'0') echo "<ul>";
				while($row_seccion2 = db_fetch_array($seccion2_sql)) 
				{
					$s2sql = db_query("select * from seccioncontenido where ccodseccion='".$row_seccion2[ccodseccion]."' and ccodcontenido='".$iditem."'");
					$s2ok = db_num_rows($s2sql);
					if ($s2ok=='0')
				        echo "<li><input type='checkbox' name='select".$row_seccion2[ccodseccion]."'>".$row_seccion2['cnomseccion'];
					else
				        echo "<li><input type='checkbox' name='select".$row_seccion2[ccodseccion]."' checked>".$row_seccion2['cnomseccion'];
					
					
					$niv2cod = substr($row_seccion2[ccodseccion],0,16);
					$seccion3_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv2cod."%' and cestseccion ='1' and cnivseccion='3' and ctipseccion='1' order by cnomseccion");
					$total3 = db_num_rows($seccion3_sql);
					if ($total3<>'0') echo "<ul>";
					while($row_seccion3 = db_fetch_array($seccion3_sql)) 
						{
							$s3sql = db_query("select * from seccioncontenido where ccodseccion='".$row_seccion3[ccodseccion]."' and ccodcontenido='".$iditem."'");
							$s3ok = db_num_rows($s3sql);
							if ($s3ok=='0')
								echo "<li><input type='checkbox' name='select".$row_seccion3[ccodseccion]."'>".$row_seccion3['cnomseccion'];
							else
								echo "<li><input type='checkbox' name='select".$row_seccion3[ccodseccion]."' checked>".$row_seccion3['cnomseccion'];
						
							$niv3cod = substr($row_seccion3[ccodseccion],0,20);
							$seccion4_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv3cod."%' and cestseccion ='1' and cnivseccion='4' and ctipseccion='1' order by cnomseccion");
							$total4 = db_num_rows($seccion4_sql);
							if ($total4<>'0') echo "<ul>";
							while($row_seccion4 = db_fetch_array($seccion4_sql)) 
							{
								$s4sql = db_query("select * from seccioncontenido where ccodseccion='".$row_seccion4[ccodseccion]."' and ccodcontenido='".$iditem."'");
								$s4ok = db_num_rows($s4sql);
								if ($s4ok=='0')
									echo "<li><input type='checkbox' name='select".$row_seccion4[ccodseccion]."'>".$row_seccion4['cnomseccion'];
								else
									echo "<li><input type='checkbox' name='select".$row_seccion4[ccodseccion]."' checked>".$row_seccion4['cnomseccion'];
								echo "</li>\n";
							}
							if ($total4<>'0') echo "</ul>";	
							echo "</li>\n";
						}
					if ($total3<>'0') echo "</ul>";
					echo "</li>\n";
				}
				if ($total2<>'0') echo "</ul>";
				echo "</li>\n";
				}
	echo "</ul>";
	?>
