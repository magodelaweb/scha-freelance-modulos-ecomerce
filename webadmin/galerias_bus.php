<table width="210" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Buscador
    </td>
</tr>
<tr >
	<td  class="columnaespecial" >
	Tipo de Contenido :<br />
  <select name="selectmodulo" id="selectmodulo" style="width:190px" size="15" class="box">
  <?php   $sql_modulo = db_query("select * from webmodulos  where  cestmodulo='1' and cactgaleria='S' order by cnommodulo");
	 while($row_modulo = db_fetch_array($sql_modulo)) 
	 {
			echo '<option value="' . $row_modulo['ccodmodulo'] .'">' . $row_modulo['cnommodulo'] . '</option>';
	 }
  ?>
  </select>
    </td>
</tr>
<tr >
	<td   align="center" class="titlehome">
<input type="button" name="buscar" id="buscar" value="Buscar"  > 
</tr>
</table>