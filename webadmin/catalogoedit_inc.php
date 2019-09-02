<?php
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
$sql_contenido = db_query("SELECT * FROM contenido c, contenidodetalle d, seccioncontenido e WHERE c.ccodcontenido=d.ccodcontenido and c.ccodcontenido=e.ccodcontenido and c.ccodcontenido = '" . $_GET['IDpro'] . "'");
$i=1;
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
   	<td align="left" >

<table border="0"   cellpadding="0" cellspacing="0" class="tablebordernew" >
<tr>
	<td colspan='2' class='titulo' >
        <div class="formtitulo">Editar Catalogo</div>
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
	<td class='colgrishome' align="right">Titulo Amigable </td>
    <td class='colgrisend'>
    <input type="text" name="amigable" id="amigable"  maxlength="150" class="box500" value='<?=$row_contenido['camicontenido']?>'>
    </td>
</tr>
<tr>
	<td class='colgrishome' width="150"  align="right">Seccion </td>
    <td class='colgrisend'>
<!--<select name='selectseccion' id='selectseccion' class="box" >-->
<?php
$sqlsec1 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$_SESSION['page']."' and ccodmodulo='1200' and cnivseccion='1' and ctipseccion='1'  order by cnomseccion");
while($row1 = db_fetch_array($sqlsec1)) {
			$cod1 = $row1['ccodseccion'];
			//echo '<option value="' . $cod1 . '" '.(($row_contenido['ccodseccion']==$cod1)?"selected":"").'>'.$row1['cnomseccion'] . '</option>';
			echo '<input type="checkbox" name="select'.$cod1.'" id="select'.$cod1.'" '.(($row_contenido['ccodseccion']==$cod1)?"checked":"").'/>'.$row1['cnomseccion'].'<br/>';
}
?>
<!--</select>-->
    </td>
</tr>
<tr>
	<td class='colgrishome' align="right" valign="top">Resumen </td>
	<td class='colgrisend'>
	<textarea name="resumen"  rows="5" class="area500"><?=$row_contenido['crescontenido']?></textarea>
	</td>
</tr>
<tr>
	<td class='titlehome' colspan="2">Contenido</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2">
		<?php  $sContent = $row_contenido['cdetcontenido']; ?>
		<textarea id="contenido_<?php echo $row_contenido['ccodseccion'];?>" name="contenido_<?php echo $row_contenido['ccodseccion'];?>" >
		<?php
		/*function encodeHTML($sHTML)
			{
			$sHTML=ereg_replace("&","&amp;",$sHTML);
			$sHTML=ereg_replace("<","&lt;",$sHTML);
			$sHTML=ereg_replace(">","&gt;",$sHTML);
			return $sHTML;
			}*/
		if(isset($sContent)) echo ereg_replace(">","&gt;",ereg_replace("<","&lt;",ereg_replace("&","&amp;",$sContent)));
		?>
		</textarea>
		<script>
		var oEdit<?php echo $i;?> = new InnovaEditor("oEdit<?php echo $i;?>");
	    oEdit<?php echo $i;?>.cmdAssetManager = "modalDialogShow('/webadmin/editor/assetmanager/assetmanager.php',640,465)";
		oEdit<?php echo $i;?>.width=680;
		oEdit<?php echo $i;?>.height=400;

	    /*Set toolbar mode: 0: standard, 1: tab toolbar, 2: group toolbar */
	    oEdit<?php echo $i;?>.toolbarMode = 0;
	    oEdit<?php echo $i;?>.features=[
	    "Cut","Copy","Paste","PasteWord","PasteText","Undo","Redo","Hyperlink","Image", "Table","Guidelines","Absolute", "Flash","Media","Characters", "Numbering","Bullets","Indent","Outdent", "RemoveFormat","Preview","XHTMLSource","ClearAll","BRK",
	    "StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","CustomTag","Paragraph","FontName","FontSize","Bold","Italic","Underline","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","Strikethrough", "Superscript","Subscript",
	    "ForeColor","BackColor"
	    ];
		oEdit<?php echo $i;?>.css="../estilos/contenido.css";//Specify external css file here
		oEdit<?php echo $i;?>.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors
		oEdit<?php echo $i;?>.mode="HTMLBody"; //Editing mode. Possible values: "HTMLBody" (default), "XHTMLBody", "HTML", "XHTML"
		oEdit<?php echo $i;?>.useDIV=false;
	    oEdit<?php echo $i;?>.useBR=true;

		oEdit<?php echo $i;?>.REPLACE("contenido_<?php echo $row_contenido['ccodseccion'];?>");//Specify the id of the textarea here
		</script>

	</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2" align="center">
		<a id="img" href="<?=$row_contenido['cimgcontenido']?>">
        Imagen Principal : </a><input type="text" name="imagen" id="imagen" size="60"  maxlength="150" value='<?=$row_contenido['cimgcontenido']?>'><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" >
	</td>
</tr>
<!--<tr>
	<td class='titlehome' colspan="2">Estilo de Presentaci�n del Contenido</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2">
        <div id="estilos">
	    <ul class="stylos">
		  <?php
		     /*$estilo_query = db_query("select * from estilocontenido where ccodmodulo='".$modulo."' and cestestcontenido = '1' order by ccodestcontenido");
			 while ($estilo = db_fetch_array($estilo_query))
			 {
				if ($estilo['ccodestcontenido'] == $row_contenido['ccodestcontenido'])
					echo "<li><img src='estilos/images/".$estilo['cimgestcontenido']."'><br><input name='selectestilo' type='radio' value='".$estilo['ccodestcontenido']."' checked>".$estilo['cnomestcontenido']."</li>";
				else
					echo "<li><img src='estilos/images/".$estilo['cimgestcontenido']."'><br><input name='selectestilo' type='radio' value='".$estilo['ccodestcontenido']."' >".$estilo['cnomestcontenido']."</li>";
			}*/
		  ?>
        </ul>
        </div>
	</td>
</tr>-->
<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>
<tr>
	<td colspan="2"  class='formpie' align="center" >
        <input type="hidden" name="selectmodulo" id="selectmodulo" value="<?=$modulo?>" />
        <input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">
	    <input type="hidden" id="descripcion" name="descripcion" />
		<input type="button" value="Aceptar"   class='cssboton' onclick="document.getElementById('descripcion').value = oEdit<?php echo $i;?>.getHTMLBody(); xajax_procesar_formulario(xajax.getFormValues('form'))" />
		<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	</td>
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
<?php $i++;
} ?>
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
