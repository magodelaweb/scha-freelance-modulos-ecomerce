<table width="100%" height='30' border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="30%" align="left">Totales :	[ <?=$total ?> ] - [ <?=$numPags ?> ]
	</td>
	<td width="70%" align='right'  style="padding-right:10px;" >
		Pag.
		<select name="pg" id="pg">
	    <?php 
			for($pg=1; $pg<=$numPags; $pg++)
			{
				if($pg < 1000) $pg = "0".$pg;
				if($pg < 100)  $pg = "0".$pg;
				if($pg < 10)   $pg = "0".$pg;
				if($pg==$pag)
					echo "<option  value='$pg' selected >$pg</option> "; 
				else
					echo"<option  value='$pg' >$pg</option> ";
			}
			?>
		</select>
	</td>
	</tr>
</table>
