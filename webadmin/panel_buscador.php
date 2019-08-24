<table width="210" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Buscador
    </td>
</tr>
<tr >
	<td   class="columnaespecial"  >
	Página <br />
  <select name="selectpage" id="selectpage" style="width:190px" class="cuadrotexto">
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
	<td   class="columnaespecial">
	Secciones<br />
<select name='selectseccion' id='selectseccion' style='width:190px;' size='15' class="box" >";
<option value='SS' selected>Todos las secciones</option>
<?php
$sqlsec1 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$_SESSION['page']."' and ccodmodulo='".$modulo."' and cnivseccion='1' and ctipseccion='1'  order by cnomseccion");
while($row1 = db_fetch_array($sqlsec1)) 
		{
			$cod1 = substr($row1['ccodseccion'],0,12);
			echo '<option value="' . $cod1 . '">'.$row1['cnomseccion'] . '</option>';
			$sqlsec2 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod1."%' and ccodmodulo='".$modulo."' and cnivseccion='2'  and ctipseccion='1'  order by cnomseccion");
			while($row2 = db_fetch_array($sqlsec2)) 
			{
				$cod2 = substr($row2['ccodseccion'],0,16);
				echo '<option value="' .$cod2 . '">&nbsp;- ' . $row2['cnomseccion'] . '</option>';
				$sqlsec3 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod2."%' and ccodmodulo='".$modulo."' and cnivseccion='3'  and ctipseccion='1'  order by cnomseccion");
				while($row3 = db_fetch_array($sqlsec3)) 
				{
					$cod3 = substr($row3['ccodseccion'],0,20);
					echo '<option value="' . $cod3 . '">&nbsp;&nbsp;&nbsp;- ' . $row3['cnomseccion'] . '</option>';
					$sqlsec4 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod3."%' and ccodmodulo='".$modulo."' and cnivseccion='4'  and ctipseccion='1'  order by cnomseccion");
					while($row4 = db_fetch_array($sqlsec4)) 
					{
						echo '<option value="' . $row4['ccodseccion'] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $row4['cnomseccion'] . '</option>';
					}
				}
		}
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
	<td    class="columnaespecial" >
Codigo:
<input type="text" name="codigo" id="codigo"  size='22' style="width:190px;" class="cuadrotexto">
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
		    button         :  "fechabus"     // el id del botón que lanzará el calendario 
			}); 
		</script>
        <br />
        <br />
   </td>
</tr>
<tr >
	<td   align="center" class="formpie">
	<input type="button" name="buscar" id="buscar" value="Buscar" > 
</tr>
</table>

