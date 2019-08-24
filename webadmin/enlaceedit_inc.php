<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
$sql_contenido = db_query("SELECT * FROM contenido  WHERE ccodcontenido = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
	$pageweb =	$row_contenido['ccodpage'];
//	$fechaurl = substr(ereg_replace('-','',$row_contenido['dfeccontenido']),0,6);
//	$_SESSION['rutaimages']="webfiles/fotos".$fechaurl;
?>
<div id="capaformulario">
<form name="form" id="form"> 
<table border="0"  align="center" cellpadding="0" cellspacing="0"  width="980" >
<tr>
   	<td align="left"  valign="top">

<table border="0"   cellpadding="0" cellspacing="0" class="tablebordernew" >
<tr>
	<td colspan='2' class='titulo' >
        <div class="formtitulo">Ediar Enlace</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
	</td>
</tr>
<tr>
	<td class='colgrishome' width="150"  align="right">Titulo </td>
    <td class='colgrisend'>
	<input type="text" name="titulo" id="titulo" maxlength="150"  class="box500" value='<?=$row_contenido['cnomcontenido']?>' >
    </td>
</tr>        
<tr>
	<td class='colgrishome' width="150"  align="right">Url </td>
    <td class='colgrisend'>
	<input type="text" name="url" id="url" maxlength="150"  class="box500" value='<?=$row_contenido['curlcontenido']?>' >
    </td>
</tr>        

<tr>
	<td class='colgrishome' align="right" valign="top">Resumen </td>
	<td class='colgrisend'>
	<textarea name="resumen"  rows="5" class="area500"><?=$row_contenido['crescontenido']?></textarea>
	</td>
</tr>

<tr>
	<td class='colgrishome' colspan="2" align="center">
        Imagen Principal : <input type="text" name="imagen" id="imagen" size="60"  maxlength="150" value='<?=$row_contenido['cimgcontenido']?>'><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
	</td>
</tr>

<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   
<tr>
	<td colspan="2"  class='formpie' align="center" >
        <input type="hidden" name="selectmodulo" id="selectmodulo" value="<?=$modulo?>" />
	    <input type="hidden" name="amigable" id="amigable"  maxlength="150" class="box500" value='<?=$row_contenido['camicontenido']?>'>
        <input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">
		<input type="button" value="Aceptar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('form'))" />
		<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	
	</td>
</tr>
</table>
</td>
<td valign="top"  width="270">
<?php  include $modulo_buscar;?>
</td>
</tr>
</table>

</form>
</div>
<?php  } ?>
<script>
$(document).ready(function(){

	$('#titulo').keyup(function() 
    {
	   $('#amigable').val(convierteAlias($('#titulo').val()));
	   $('#txttitulo').val($('#titulo').val());
	});
	$("#selectpage").change(function(){
		$.post("jq_selectseccion.php",{ idopera:'1',idmodulo:$("#selectmodulo").val(),iditem:$("#IDpro").val(),idpage:$("#selectpage").val()},function(data){$("#cuadrobox").html(data);})
	});
	
})
</script>
