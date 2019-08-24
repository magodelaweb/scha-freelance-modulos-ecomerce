<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
$idedit=$_GET['ids'];
if ($_SESSION['webuser_nivel']=='8')
{
	$idseguro = $_GET['ids'];
	$idedit   ="";
	$idpageseg= substr($idseguro,0,8);
	$sqldata = "SELECT * FROM personapage  WHERE ccodpage='".$idpageseg."' and ccodpersona='".$_SESSION['webuser_id']."' and ccodperfil='ADMIN'";
	$resdata = db_query($sqldata);
	while($rowdata = db_fetch_array($resdata))
	{
		$idedit=$_GET['ids'];
	}
}

$sql = db_query("SELECT * FROM seccion WHERE ccodseccion='".$idedit."'");
while($row  =db_fetch_array($sql))
{
?>

<div id="capaformulario">
<form name="form" id="form">
<input  name='ids'   type='hidden' id='ids' value='<?=$_GET['ids']?>'>
<input  name='selectnivel' id="selectnivel"   type='hidden' value='<?=$row['cnivseccion']?>'>
<input  name='selectpage' id="selectpage"   type='hidden' value='<?=$row['ccodpage']?>'>

<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborderfull" >
<tr>
  <td colspan="2" class="titulo">
	<div class="formtitulo">Editar Sub Seccion</div>
	<div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
  </td>
</tr>
<tr>
	<td width="200" class='colgrishome' height='25' align="right" >Página </td>
	<td class='colblancocen' >
  <?php   
	$sql_page = db_query("select * from page  where  ccodpage='".$row['ccodpage']."'");
	while($row_page = db_fetch_array($sql_page)) 
	 {
		echo $row_page['cnompage'];
	 }
  ?>
	</td>
</tr>
<tr>
  <td width="200" class='colgrishome' height='25' align="right" >Seccion Principal</td>
  <td  class='colblancocen' >/<?=crearurl_articulo($row['ccodseccion']) ?>
  
  </td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Nombre </td>
    <td class='colblancocen' ><input name='titulo' type='text' id='titulo'  size='90'  maxlength="50" value="<?=$row['cnomseccion']?>" class="box600">	</td>
</tr>

<tr> 
	<td class='colgrishome' align='right'>Tipo </td>
	<td class='colblancocen' >
	<select name="selectenlace" id="selectenlace" style="width:190px" class="box">
	<?php   $tipo_enlace = db_query("select * from webparametros where ccodparametro='0005' and ctipparametro='1'");
		while ($row_enlace = db_fetch_array($tipo_enlace)) 
		{	
		 if($row_enlace['cvalparametro']==$row['ctipseccion'])
			echo '<option value='.$row_enlace['cvalparametro'].' selected>'.$row_enlace['cdesparametro'].'</option>';
		else
			echo '<option value='.$row_enlace['cvalparametro'].' >'.$row_enlace['cdesparametro'].'</option>';
		}
	?>
	</select>
    Url: <input type="text" name="rutaenlace" id="rutaenlace" size="60" value="<?=$row['curlseccion']?>" class="box400" />
    </td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Modulo </td>
    <td class='colblancocen'>
   <select name="selectmodulo" style="width:190px" onChange="xajax_procesar_estilos(xajax.getFormValues('form'))" class="box">
<?php 	$querysec = db_query("select * from webmodulos where cestmodulo='1'");
	while($row_sec = db_fetch_array($querysec)) 
	{	if( $row_sec['ccodmodulo']==$row['ccodmodulo'])
			echo '<option value="' . $row_sec['ccodmodulo'].'" selected>' . $row_sec['cnommodulo'] . '</option>';
		else
			echo '<option value="' . $row_sec['ccodmodulo'].'" >' . $row_sec['cnommodulo'] . '</option>';
	}
?>
    </select>
	</td>
</tr>

<tr>
	<td class='colgrishome' valign="top" align="right">Estilo de Sección</td>
	<td align="center" class='colblancoend'>
	<div id="estilos">
    <ul class="stylos">
	<?php 
	$sql_estilo = "SELECT * FROM estiloseccion WHERE cestsecestilo='1' AND ccodmodulo='".$row['ccodmodulo']."' order by ccodsecestilo";
	$res_estilo = db_query($sql_estilo);
	while($rowestilo = db_fetch_array($res_estilo)) 
	{
		if ($rowestilo['ccodsecestilo']==$row['ccodsecestilo']) { $check = " checked";} else { $check = "";}
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
    <td class='colblancocen' ><input name='txttitulo' type='text' id='txttitulo'  size='90'  maxlength="100" value="<?=$row['ctitseccion']?>" class="box600">
	</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Url amigable </td>
    <td class='colblancocen' ><input name='amigable' type='text' id='amigable'  size='90'  maxlength="50" value="<?=$row['camiseccion']?>" class="box600"></td>
</tr>

<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Descripción</td>
    <td class='colblancocen' ><textarea name="txtdetalle" cols="68" rows="4" class="area600"><?=$row['cdesseccion']?></textarea></td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right" valign="top">Tags</td>
    <td class='colblancocen' ><textarea name="txttags" cols="68" rows="4" class="area600"><?=$row['ctagseccion']?></textarea></td>
</tr>
<tr>
	<td  colspan="2" height="25" class='titlesub'>Opciones Adicionales</td>
</tr>
<tr> 
	<td class='colgrishome' align='right'>Imagen</td>
	<td class='colblancocen' ><input type="text" name="imagencab" id="imagencab" size="76" value="<?=$row['cimgseccion']?>" class="box500"> <input type="button" value="Seleccionar" onClick="openAsset('imagencab')" id="btnAsset" name="btnAsset"  style="height:30px;vertical-align:middle;">
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
	while($rowsubestilo = db_fetch_array($res_subestilo)) 
	{
		if ($rowsubestilo['ccodsecestilo']==$row['ccodsubestilo']) { $check = " checked";} else { $check = "";}
		echo "<li>\n";
		echo "<img border='0' src=\"estilos/images/" . $rowsubestilo['cimgsecestilo'] . "\"><br><input type='radio' name='selectsub' value='".$rowsubestilo['ccodsecestilo']."'".$check.">" . $rowsubestilo['cnomsecestilo'];
		echo "</li>";
		$na++;
	}
	?>
    </ul>
	</div>
      </td>
</tr>


<tr>
    <td class='colgrishome' height='25' align="right">Paginacion Contenido</td>
    <td class='colblancocen' > <input type="text" name="txtpaginar"  size="5" value="<?=$row['cpagseccion']?>" class="box100"> Items</td>
</tr>
<tr>
    <td class='colgrishome' height='25' align="right">Orden Contenido</td>
    <td class='colblancocen' > 
	<select name="selectorden" style="width:200px"  class="box">
	<?php   $tipo_acceso = db_query("select * from webparametros where ccodparametro='0007' and ctipparametro='1'");
		while ($row_acceso = db_fetch_array($tipo_acceso)) 
		{	
		 	if($row_acceso['cvalparametro']==$row['cordseccion'])
				echo '<option value='.$row_acceso['cvalparametro'].' selected>'.$row_acceso['cdesparametro'].'</option>';
			else
				echo '<option value='.$row_acceso['cvalparametro'].' >'.$row_acceso['cdesparametro'].'</option>';
		}
	?>
    </select>	
	</td>
</tr>



<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   

<tr>
	<td colspan="2" align="center" class='formpie'  >
	<input type="button" value="Aceptar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('form'))" />
	<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	
    	</td>
</tr>
</table>
</form>
</div>
<?php  } ?>
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

})
</script>
