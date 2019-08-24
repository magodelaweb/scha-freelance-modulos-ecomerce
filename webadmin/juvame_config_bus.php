<table width="210" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Buscador
    </td>
</tr>
<tr >
	<td  width="30"  class="columnaespecial"  >
	Página <br />
  <select name="selectpage" id="selectpage" style="width:190px" size="15" class="box">
  <?php  
	if ($_SESSION['webuser_nivel'] == '9')
	  	$sql_page = db_query("select * from page  where  cestpage='1'  order by cnikpage");
	else
	  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnompage");
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		 if( $row_page['ccodpage']==$_SESSION['page'])
			echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnikpage'] . '</option>';
		 else
			echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnikpage'] . '</option>';
	 }
  ?>
  </select>
  <br />
  <br />
    </td>
</tr>
</table>