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
$sql_contenido = db_query("SELECT * FROM seccion c, secciondetalle d WHERE c.ccodseccion=d.ccodseccion and c.ccodseccion = '" . $idedit . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
	$pageweb =	$row_contenido['ccodpage'];
//	$fechaurl = substr(ereg_replace('-','',$row_contenido['dfeccontenido']),0,6);
//	$_SESSION['rutaimages']="webfiles/fotos".$fechaurl;
?>
<div id="capaformulario">
<form name="form" id="form"> 
<table border="0"   cellpadding="0" cellspacing="0" class="tablebordernew" >
<tr>
	<td colspan='2' class='titulo' >
        <div class="formtitulo">Detalles de una sección</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
	</td>
</tr>
<tr>
	<td class='colgrishome' width="150"  align="right">Titulo </td>
    <td class='colgrisend'>
	<input type="text" name="titulo" id="titulo" maxlength="150"  class="box500" value='<?=$row_contenido['cnombre']?>' >
    </td>
</tr>        
<tr>
	<td class='titlehome' colspan="2">Contenido</td>
</tr>
<tr>
	<td class='colgrishome' colspan="2">
		<?php  $sContent = $row_contenido['cdetseccion']; ?>
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
	<td colspan="2"  class='formpie' align="center" >
        <input type="hidden" name="ids" id="ids" value="<?=$_GET['ids']?>">
	    <input type="hidden" id="descripcion" name="descripcion" />
		<input type="button" value="Aceptar"   class='cssboton' onclick="document.getElementById('descripcion').value = oEdit1.getHTMLBody(); xajax_procesar_formulario(xajax.getFormValues('form'))" />
		<input type="Button" value="Cancelar" onclick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>	
	</td>
</tr>
</table>


</form>
</div>
<?php  } ?>
