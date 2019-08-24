<table width="270" border="0" align="center" cellpadding="0" cellspacing="0">
<tr >
	<td class='titleespecial' >
    Publicacion
    </td>
</tr>
<tr>
  <td class='colgrishome' valign="top"  >
	Pagina :<br />
  <select name="selectpage" id="selectpage" style="width:240px">
  <?php  
  	$webdefa = $row_contenido['ccodpage']; 
	if ($_SESSION['webuser_nivel'] == '9')
	  	$sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnompage");
	else
	  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnikpage");
  
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		if( $row_page['ccodpage']==$row_contenido['ccodpage'])
			echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnikpage'] . '</option>';
		else
			echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnikpage'] . '</option>';
	 }
  ?>
  </select>
  </td>
</tr>
<tr>
  <td class='colgrishome'  valign="top"  >
  Categoria :<br />
		<select name="selectcategoria" style="width:240px;">
	<?php  	$categoria_sql=db_query("SELECT * FROM webparametros where ccodparametro='0013' and ctipparametro='1'");
		while($row_categoria=db_fetch_array($categoria_sql))
		{ 
			if( $row_categoria['cvalparametro']==$row_contenido['ccodcategoria']) 
				echo "<option value=".$row_categoria['cvalparametro']." selected>".$row_categoria['cdesparametro']."</option>";
			else
				echo "<option value=".$row_categoria['cvalparametro'].">".$row_categoria['cdesparametro']."</option>";
		}
	?>
		</select>
	</td>        
</tr>
<tr>
	<td class='titlehome'   >        
		Seccion :
	</td>
</tr>
<tr>
	<td class='colgrishome'   >        
		<button id="expand">+</button><button id="collapse">-</button><button id="default">::</button>
		<div id="cuadrobox"  style="border:1px #666666 solid; padding:5px; width:240px; height:200px; overflow:auto;background-color:#FFF;">
        <?php  include "jq_selectseccion.php"?>
		</div>
  </td>
</tr>
<tr>
	<td class='titlehome' >        
		Seo Palabras de Busqueda :
	</td>
</tr>
<tr>
	<td class='colgrishome'   > 
        <textarea name="tags" style="width:100%;" rows="3"><?=$row_contenido['ctagcontenido']?></textarea>  </td>
</tr>
<tr>
  <td class='colgrishome'  valign="top"  >
  Fecha Publicación :
		<input name="idfecha"  id="idfecha" type="text" value="<?=fechadmy($row_contenido['dfeccontenido'])?>" class="txtbox" size="11" maxlength="10">
		<input type="button" id="fechabus" value="..." class="cssboton">
		<script type="text/javascript"> 
		   Calendar.setup({ 
		    inputField     :  "idfecha",     // id del campo de texto 
		    ifFormat       :  "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		    button         :  "fechabus"     // el id del botón que lanzará el calendario 
			}); 
		</script> 				
        
	</td>
</tr>

</table>

