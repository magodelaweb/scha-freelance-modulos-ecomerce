<table width="210" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Buscador
    </td>
</tr>
<tr >
	<td  class="columnaespecial" >
	P�gina<br />
  <select name="selectpage" id="selectpage" style="width:190px" size="15" class="box">
  <?php  
	if ($_SESSION['webuser_nivel'] == '9')
	  	$sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnikpage");
	else
	  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnikpage");
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		 if( $row_page['ccodpage']==$_SESSION['page'])
			echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnikpage'] . '</option>';
		 else
			echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnikpage'] . '</option>';
	 }
  ?>
  </select>
    </td>
</tr>
<tr >
	<td    class="columnaespecial" >
Nombre:
<input type="text" name="palabra" id="palabra"  size='22' style="width:190px;" class="cuadrotexto">
   </td>
</tr>
<tr >
	<td    class="columnaespecial">
Fecha:<br />
        <input type="text" name="fecha" id="fecha" size='18'  style="width:150px;" class="cuadrotexto">
		<input type="button" id="fechabus" value="" class="botonfecha">
		<script type="text/javascript"> 
		   Calendar.setup({ 
		    inputField     :  "fecha",     // id del campo de texto 
		    ifFormat       :  "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		    button         :  "fechabus"     // el id del bot�n que lanzar� el calendario 
			}); 
		</script>
        <br />
        <br />
   </td>
</tr>
<tr >
	<td   align="center" class="titlehome">
<input type="button" name="buscar" id="buscar" value="Buscar"  > 
</tr>
</table>