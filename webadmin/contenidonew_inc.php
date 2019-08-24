<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
include "panel_html.php";
//$_SESSION['rutaimages']="webfiles/fotos".date('Ym');
$pageweb =	$_SESSION['page'];
?>
<div id="capaformulario">
<form name="form" id="form"> 
<table border="0"  align="center" cellpadding="0" cellspacing="0"  width="980" >
<tr>
   	<td align="left" >


<table border="0"   cellpadding="0" cellspacing="0" class="tablebordernew" >
<tr>
   	<td class='titulo' colspan="2" >
        <div class="formtitulo">Nuevo Articulo</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>  	   
<tr>
	<td class='colgrishome' width="150"  align="right">Titulo </td>
    <td class='colgrisend'>
    <input type="text" name="titulo" id="titulo" maxlength="150"  class="box500" >
    </td>
</tr>        
<tr>
	<td class='colgrishome' align="right">Titulo Amigable </td>
    <td class='colgrisend'>
    <input type="text" name="amigable" id="amigable"  maxlength="150" class="box500">
    </td>
</tr>        
<tr>
	<td class='colgrishome' align="right" valign="top">Resumen </td>
	<td class='colgrisend'>
        <textarea name="resumen"  rows="3" class="area500"></textarea>
	</td>
</tr>
<tr>
	<td class='titlehome' colspan="2">Contenido</td>
</tr>        
<tr>
	<td class='colgrishome' colspan="2">
		<?php  $sContent=""; ?>
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
<tr>
	<td class='colgrishome' align="right">Imagen Principal </td>
	<td class='colblancoend' >
        <input type="text" name="imagen" id="imagen" size="80"  maxlength="150" class="box400" style="vertical-align:middle;"><input type="button" value="Seleccionar" onClick="openAsset('imagen')" id="btnAsset" name="btnAsset"  style="height:30px;vertical-align:middle;"> 
	</td>
</tr>
<tr>
	<td class='titlehome' colspan="2">Estilo de Presentación del Contenido</td>
</tr>        
<tr>
	<td class='colgrishome' colspan="2">
        <div id="estilos">
	    <ul class="stylos">
		  <?php  
			$i='1';
			$estilo_query = db_query("select * from estilocontenido where ccodmodulo='".$modulo."' and cestestcontenido = '1' order by ccodestcontenido"); 
			while ($estilo = db_fetch_array($estilo_query))
			 {
				if ($i=='1') 
					echo "<li><img src='estilos/images/".$estilo['cimgestcontenido']."'><br><input name='selectestilo' type='radio' value='".$estilo['ccodestcontenido']."' checked>".$estilo['cnomestcontenido']."</li>";
				else
					echo "<li><img src='estilos/images/".$estilo['cimgestcontenido']."'><br><input name='selectestilo' type='radio' value='".$estilo['ccodestcontenido']."' >".$estilo['cnomestcontenido']."</li>";
				$i++ ;
			}
		  ?>
        </ul>
        </div>
	</td>
</tr>
<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   
<tr>
	<td colspan="2" align="center" class='formpie' >
        <input type="hidden" name="selectmodulo" id="selectmodulo" value="<?=$modulo?>" />
        <input type="hidden" name="IDpro" id="IDpro" value="">
	    <input type="hidden" id="descripcion" name="descripcion" />
		<input type="button" value="Aceptar"   class='cssboton' onclick="document.getElementById('descripcion').value = oEdit1.getHTMLBody(); xajax_procesar_formulario(xajax.getFormValues('form'))" />
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
