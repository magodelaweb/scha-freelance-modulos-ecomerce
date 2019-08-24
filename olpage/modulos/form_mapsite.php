<ul class="mapatree">
<?php 
$sql_menu = "SELECT ccodseccion,csecamigable,cnomseccion FROM seccion where cnivseccion='1' ORDER BY ccodidioma desc,ccodseccion";
$res_menu = db_query($sql_menu);
while ($rows_sub = mysql_fetch_array($res_menu)) 
{
?>
	<li><a href="<?=WEB_DOMINIO.$rows_sub['csecamigable']?>"><?=$rows_sub['cnomseccion']?></a>
		<ul class="mapasub1">
		<?php 
		$cod_menu2 = substr($rows_sub['ccodseccion'],0,6);
		$sql_menu2 = "SELECT ccodseccion,csecamigable,cnomseccion FROM seccion where ccodseccion like '".$cod_menu2."%'  and cnivseccion='2' ORDER BY ccodseccion";
		$res_menu2 = db_query($sql_menu2);
		while ($rows_sub2 = mysql_fetch_array($res_menu2)) 
		{
		?>
		<li><a href="<?=WEB_DOMINIO.$rows_sub['csecamigable']."/".$rows_sub2['csecamigable']?>"><?=$rows_sub2['cnomseccion']?></a>
			<ul class="mapasub2">
				<?php 
				$cod_menu3 = substr($rows_sub2['ccodseccion'],0,9);
				$sql_menu3 = "SELECT ccodseccion,csecamigable,cnomseccion FROM seccion where ccodseccion like '".$cod_menu3."%'  and cnivseccion='3' ORDER BY ccodseccion";
				$res_menu3 = db_query($sql_menu3);
				while ($rows_sub3 = mysql_fetch_array($res_menu3)) 
				{
				?>
					<li><a href="<?=WEB_DOMINIO.$rows_sub['csecamigable']."/".$rows_sub2['csecamigable']."/".$rows_sub3['csecamigable']?>"><?=$rows_sub3['cnomseccion']?></a>

						<ul class="mapasub3">
							<?php 
							$cod_menu4 = substr($rows_sub3['ccodseccion'],0,12);
							$sql_menu4 = "SELECT ccodseccion,csecamigable,cnomseccion FROM seccion where ccodseccion like '".$cod_menu4."%'  and cnivseccion='4' ORDER BY ccodseccion";
							$res_menu4 = db_query($sql_menu4);
							while ($rows_sub4 = mysql_fetch_array($res_menu4)) 
							{
							?>
								<li><a href="<?=WEB_DOMINIO.$rows_sub['csecamigable']."/".$rows_sub2['csecamigable']."/".$rows_sub3['csecamigable']."/".$rows_sub4['csecamigable']?>"><?=$rows_sub4['cnomseccion']?></a></li>
							<?php  } ?>	
						</ul>

					</li>
				<?php  } ?>	
		
			</ul>
		</li>
		<?php  }?>
		</ul>
	</li>
<?php 
}
?>
</ul>
