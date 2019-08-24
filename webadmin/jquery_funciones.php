<?php  header('Content-Type: text/html; charset=ISO-8859-15'); 
include "../config.php";
?>
<script type="text/javascript" src="include/js/jquery.checkboxtree.js" ></script>
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
<ul id="menuseccion">
 <?php 
			$seccion_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage='".$_POST[idpage]."' and cestseccion ='1' and ccodmodulo='1300'  and cnivseccion='1' and ctipseccion='1' order by ccodseccion");
			while($row_seccion = db_fetch_array($seccion_sql)) 
				{
				
		        echo "<li><input type='checkbox' name='select".$row_seccion[ccodseccion]."'>".$row_seccion['cnomseccion'];
				
				$niv1cod = substr($row_seccion[ccodseccion],0,12);
				$seccion2_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv1cod."%' and cestseccion ='1' and cnivseccion='2' and ctipseccion='1' order by ccodseccion");
				$total2 = db_num_rows($seccion2_sql);
				if ($total2<>'0') echo "<ul>";
				while($row_seccion2 = db_fetch_array($seccion2_sql)) 
				{
			        echo "<li><input type='checkbox' name='select".$row_seccion2[ccodseccion]."'>".$row_seccion2['cnomseccion'];
					
					$niv2cod = substr($row_seccion2[ccodseccion],0,16);
					$seccion3_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv2cod."%' and cestseccion ='1' and cnivseccion='3' and ctipseccion='1' order by ccodseccion");
					$total3 = db_num_rows($seccion3_sql);
					if ($total3<>'0') echo "<ul>";
					while($row_seccion3 = db_fetch_array($seccion3_sql)) 
						{
							echo "<li><input type='checkbox' name='select".$row_seccion3[ccodseccion]."'>".$row_seccion3['cnomseccion'];
						
							$niv3cod = substr($row_seccion3[ccodseccion],0,20);
							$seccion4_sql = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$niv3cod."%' and cestseccion ='1' and cnivseccion='4' and ctipseccion='1' order by ccodseccion");
							$total4 = db_num_rows($seccion4_sql);
							if ($total4<>'0') echo "<ul>";
							while($row_seccion4 = db_fetch_array($seccion4_sql)) 
							{
								echo "<li><input type='checkbox' name='select".$row_seccion4[ccodseccion]."'>".$row_seccion4['cnomseccion'];
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
	?>
 </ul>

