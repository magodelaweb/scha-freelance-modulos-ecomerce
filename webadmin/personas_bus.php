<table width="210" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Buscador
    </td>
</tr>
<tr >
	<td   class="columnaespecial"  >
	Página <br />
  <select name="selectpage" id="selectpage" style="width:190px"  size="5">
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
	<td  width="30"  class="columnaespecial"  >
	Pais<br />
	<select name='pais' id="pais" style="width:195px">
	<?php   
	$sql     = "SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo";
	$result  = db_query($sql);
	echo "<option value='00000000' selected>Todos</option>";
	while($filaprov=db_fetch_array($result))
	{
		echo "<option value=".$filaprov['ccodubigeo']." > ".$filaprov['cnomubigeo']."</option>\n";
	} 
	?>
	</select>
  </select>
    </td>
</tr>
<tr >
	<td  width="30"   class="columnaespecial" >
	Nombre:
	<input type="text" name="nombre" id="nombre"  size='22' style="width:195px;">
   </td>
</tr>
<tr >
	<td  width="30"   class="columnaespecial" >
	Nick:
	<input type="text" name="nick" id="nick"  size='22' style="width:195px;">
   </td>
</tr>
<tr >
	<td  width="30"   class="columnaespecial" >
	Documento Identidad:
	<input type="text" name="documento" id="documento"  size='22' style="width:195px;">
   </td>
</tr>
<tr >
	<td  width="30"   class="columnaespecial" >
	Correo Electronico:
	<input type="text" name="correo" id="correo"  size='22' style="width:195px;">
   </td>
</tr>

<tr >
	<td  width="30"   class="columnaespecial">
Fecha:<br />
        <input type="text" name="fecha" id="fecha" size='18'>
		<input type="button" id="fechabus" value="..." class="cssboton">
		<script type="text/javascript"> 
		   Calendar.setup({ 
		    inputField     :  "fecha",     // id del campo de texto 
		    ifFormat       :  "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		    button         :  "fechabus"     // el id del botón que lanzará el calendario 
			}); 
		</script>
   </td>
</tr>
<tr >
	<td  width="30" align="center" class="columnaespecial">
<input type="button" name="buscar" id="buscar" value="Buscar" > 
</tr>
</table>