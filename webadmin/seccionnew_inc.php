<?php
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
?>
<div id="capaformulario">
<form name="form" id="form"> 
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborderfull" >
<tr>
  <td colspan="2" class="titulo">
	<div class="formtitulo">Nueva Seccion </div>
	<div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
  </td>
</tr>
<tr>
  <td width="200" class='colgrishome' height='25' align="right" >Pagina</td>
  <td  class='colblancocen' >
  <select name="selectpage" id="selectpage" style="width:190px" class="box">
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
<tr>
   <td class='colgrishome' height='25' align="right" valign="top">Menu</td>
   <td class='colblancocen' >
   <div id="mostrarmenu"> 
	<?php  include "jq_selectmenu.php"?>
	</div>
	</td>
	
</tr>
	
<tr>
    <td class='colgrishome' height='25' align="right">Nombre </td>
    <td class='colblancocen' ><input type='text' name='titulo'  id='titulo'  size='90'  maxlength="50" class="box600">
	</td>
</tr>
<tr> 
	<td class='colgrishome' align='right'>Tipo</td>
	<td class='colblancocen' >
	<select name="selectenlace"  id="selectenlace" style="width:190px" class="box">
	<?php   $tipo_enlace = db_query("select * from webparametros where ccodparametro='0005' and ctipparametro='1' ");
		while ($row_enlace = db_fetch_array($tipo_enlace)) 
		{	
			echo '<option value='.$row_enlace['cvalparametro'].'>'.$row_enlace['cdesparametro'].'</option>';
		}
	?>
    </select>
    Url: <input type="text" name="rutaenlace" id="rutaenlace" size="60" disabled="disabled"  class="box400">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Modulo</td>
    <td class='colblancocen' >
   <select name="selectmodulo" style="width:190px" onChange="xajax_procesar_estilos(xajax.getFormValues('form'))" class="box">
	<?php   $sqlmod = db_query("select * from webmodulos where cestmodulo='1' order by ccodmodulo");
		while ($rowmod = db_fetch_array($sqlmod)) 
		{	
			echo '<option value='.$rowmod['ccodmodulo'].'>'.$rowmod['cnommodulo'].'</option>';
		}
	?>
    </select>
	</td>
</tr>

<tr>
	<td class='colgrishome' valign="top" align="right">Estilo de Sección</td>
	<td align="center" class='colblancoend'>
	<div id="estilos">
    <ul class='stylos'>
	<?php 
	$sql_estilo = "SELECT * FROM estiloseccion WHERE cestsecestilo='1' AND ccodmodulo='1100' order by ccodsecestilo";
	$res_estilo = db_query($sql_estilo);
	$nregs = db_num_rows($res_estilo);
	if ($nregs < 1) 
	{	echo "No existe diseño disponible para esta seccion.";	}
	$na = 1;
	while($rowestilo = db_fetch_array($res_estilo)) 
	{
		if ($na==1) { $check = " checked";} else { $check = "";}
		echo "<li>\n";
		echo "<img border='0' src=\"estilos/images/" . $rowestilo['cimgsecestilo'] . "\"><br><input type='radio' name='selectestilo' value='".$rowestilo['ccodsecestilo']."'".$check.">" . $rowestilo['cnomsecestilo'];
		echo "</li>";
		$na++;
	}
	?>
    </ul>
	</div>
</td>
</tr>
<tr>
	<td  colspan="2" height="25" class='titlesub'>Información para Buscadores (SEO)</td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right">Titulo </td>
    <td class='colblancocen' ><input name='txttitulo' type='text' id='txttitulo'  size='90'  maxlength="100" class="box600">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Url amigable </td>
    <td class='colblancocen' ><input name='amigable' type='text' id='amigable'  size='90'  maxlength="100" class="box600"></td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Descripción </td>
    <td class='colblancocen' >
		<textarea id="txtdetalle" name="txtdetalle" rows="4" cols="68" class="area600" ></textarea>
    </td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Tags </td>
    <td class='colblancocen' ><textarea name="txttags" cols="68" rows="4" class="area600"></textarea></td>
</tr>
<tr>
	<td  colspan="2" height="25" class='titlesub'>Opciones Adicionales</td>
</tr>

<tr> 
	<td class='colgrishome' align='right'>Imagen </td>
	<td class='colblancocen' ><input type="text" name="imagencab" id="imagencab" size="76" class="box500"><input type="button" value="Seleccionar" onClick="openAsset('imagencab')" id="btnAsset" name="btnAsset"  style="height:30px;vertical-align:middle;">
	
	</td>
</tr>
<tr>
	<td class='colgrishome' valign="top" align="right">Estilo Sub Secciónes</td>
	<td align="center" class='colblancoend'>
	<div id="estilos">
    <ul class="stylos">
	<?php 
	$sql_subestilo = "SELECT * FROM estiloseccion WHERE cestsecestilo='1' AND ccodmodulo='1000' order by ccodsecestilo";
	$res_subestilo = db_query($sql_subestilo);
	$na2 = 1;
	while($rowsubestilo = db_fetch_array($res_subestilo)) 
	{
		if ($na2==1) { $check2 = " checked";} else { $check2 = "";}
		echo "<li>\n";
		echo "<img border='0' src=\"estilos/images/" . $rowsubestilo['cimgsecestilo'] . "\"><br><input type='radio' name='selectsub' value='".$rowsubestilo['ccodsecestilo']."' ".$check2.">" . $rowsubestilo['cnomsecestilo'];
		echo "</li>";
		$na2++;
	}
	?>
    </ul>
	</div>
      </td>
</tr>

<tr>
    <td class='colgrishome'  align="right">Menu Independiente</td>
    <td class='colblancocen' ><input type="checkbox" name="menuind" id="menuind"  /></td>
</tr>


<tr>
    <td class='colgrishome'  align="right">Paginacion Contenido</td>
    <td class='colblancocen' > <input type="text" name="txtpaginar"  size="5" value="12" class="box100"> Items</td>
</tr>

<tr>
    <td class='colgrishome'  align="right">Orden Contenido</td>
    <td class='colblancocen' > 
	<select name="selectorden" style="width:200px" class="box">
	<?php   $tipo_orden = db_query("select * from webparametros where ccodparametro='0007' and ctipparametro='1'");
		while ($row_orden = db_fetch_array($tipo_orden)) 
		{	
			echo '<option value='.$row_orden['cvalparametro'].'>'.$row_orden['cdesparametro'].'</option>';
		}
	?>

    </select>		
	</td>
</tr>



<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   

<tr>
	<td colspan="2" align="center" class='formpie' >
    <input type="hidden" id="selectnivel" name="selectnivel" value="0" />
	<input type="button" value="Aceptar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('form'))" />
	<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	
    </td>
</tr>
</table>
</form>
</div>
<script>
$(document).ready(function(){

   $('#selectenlace').change(function() 
    {
	if($(this).attr('value') == '1')
	{ 
       $('#rutaenlace').attr('disabled','disabled');
	   $('#rutaenlace').val('');
	} 
	else
	{
       $('#rutaenlace').attr('disabled','');
	}
    }); 
	$('#titulo').keyup(function() 
    {
	   $('#amigable').val(convierteAlias($('#titulo').val()));
	   $('#txttitulo').val($('#titulo').val());
	});
	$("#selectpage").change(function(){
		$.post("jq_selectmenu.php",{ idopera:'1',idmodulo:$("#selectmodulo").val(),iditem:$("#IDpro").val(),idpage:$("#selectpage").val()},function(data){$("#mostrarmenu").html(data);})
	});

})
</script>
