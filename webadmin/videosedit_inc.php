<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
$sql_contenido = db_query("SELECT * FROM contenido c, contenidodetalle d WHERE c.ccodcontenido=d.ccodcontenido and c.ccodcontenido = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
	$pageweb =	$row_contenido['ccodpage'];
	$fechaurl = substr(ereg_replace('-','',$row_contenido['dfeccontenido']),0,6);
	$_SESSION['rutaimages']="webfiles/fotos".$fechaurl;
	
?>
<div id="capaformulario">
<form name="form" id="form"> 
<table border="0"  align="center" cellpadding="0" cellspacing="0"  width="980" >
<tr>
   	<td align="left" >

<table border="0"   cellpadding="0" cellspacing="0" class="tablebordernew" >
<tr>
	<td colspan='2' class='titulo' >
        <div class="formtitulo">Editar Video</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
	</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2" align="right">Titulo : <input type="text" name="titulo" id="titulo" maxlength="150"  style="width:80%;" value="<?=$row_contenido['cnomcontenido']?>" ></td>
</tr>        
<tr>
	<td class='colgrishome' colspan="2" align="right">Titulo Amigable :<input type="text" name="amigable" id="amigable"  maxlength="150" style="width:80%;" value='<?=$row_contenido['camicontenido']?>'></td>
</tr>        
<tr>
	<td class='titlehome' colspan="2">Resumen</td>
</tr>        
<tr>
	<td class='colgrishome' colspan="2">
        <textarea name="resumen"  rows="5" style="width:100%;"><?=$row_contenido['crescontenido']?></textarea>
	</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2" align="center">
        Imagen Video : <input type="text" name="imagen" id="imagen" size="60"  maxlength="150" value='<?=$row_contenido['cimgcontenido']?>'><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset" > 
	</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2" align="center">
        Video : <input type="text" name="video" id="video" size="60"  maxlength="150" value='<?=$row_contenido['curlcontenido']?>'>
        <a href="javascript:subir_imagen('video','../webfiles/videos','v')"><img src='estilos/images/subir_img.gif'  border='0' align='absmiddle' onMouseMove="javascript:window.status=''"></a>
	</td>
</tr>

<tr>
	<td class='titlehome' colspan="2">Descripcion</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2">
		<?php  $sContent = $row_contenido['cdetcontenido']; ?>
		<textarea id="contenido" name="contenido" >
		<?php 
		function encodeHTML($sHTML)
			{
			$sHTML=ereg_replace("&","&amp;",$sHTML);
			$sHTML=ereg_replace("<","&lt;",$sHTML);
			$sHTML=ereg_replace(">","&gt;",$sHTML);
			return $sHTML;
			}
		if(isset($sContent)) echo encodeHTML($sContent);
		?>
		</textarea>
		<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	    oEdit1.cmdAssetManager = "modalDialogShow('/webadmin/editor/assetmanager/assetmanager.php',640,465)";
		oEdit1.width=680;
		oEdit1.height=400;

	    /*Set toolbar mode: 0: standard, 1: tab toolbar, 2: group toolbar */
	    oEdit1.toolbarMode = 0;
	    oEdit1.features=[
	    "Cut","Copy","Paste","PasteWord","PasteText","Undo","Redo","Hyperlink","Image", "Table","Guidelines","Absolute", "Flash","Media","Characters", "Numbering","Bullets","Indent","Outdent", "RemoveFormat","Preview","XHTMLSource","ClearAll","BRK",
	    "StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","CustomTag","Paragraph","FontName","FontSize","Bold","Italic","Underline","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","Strikethrough", "Superscript","Subscript",
	    "ForeColor","BackColor"
	    ];
		oEdit1.css="../estilos/contenido.css";//Specify external css file here
		oEdit1.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors
		oEdit1.mode="HTMLBody"; //Editing mode. Possible values: "HTMLBody" (default), "XHTMLBody", "HTML", "XHTML"
		oEdit1.useDIV=false;
	    oEdit1.useBR=true;

		oEdit1.REPLACE("contenido");//Specify the id of the textarea here
		</script>
        
	</td>
</tr>
<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   
<tr>
	<td colspan="2"  class='formpie' align="center" >
        <input type="hidden" name="selectmodulo" id="selectmodulo" value="<?=$modulo?>" />
        <input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">
	    <input type="hidden" id="descripcion" name="descripcion" />
		<input type="button" value="Aceptar"   class='cssboton' onclick="document.getElementById('descripcion').value = oEdit1.getHTMLBody(); xajax_procesar_formulario(xajax.getFormValues('form'))" />
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
