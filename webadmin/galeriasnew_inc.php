<?php 
include "include/config_seguro.php";
$sql_contenido = db_query("SELECT * FROM contenido c, contenidodetalle d WHERE c.ccodcontenido=d.ccodcontenido and c.ccodcontenido = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
	$pageweb =	$row_contenido['ccodpage'];
}
?>
<link href="include/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="include/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="include/uploadify/swfobject.js"></script>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
	$('#fileInput').uploadify({
		'uploader'  : 'include/uploadify/uploadify.swf',
		'script'    : 'galeriasupload.php',
		'cancelImg' : 'include/uploadify/cancel.png',
		'auto'      : false,
		'folder'    : '../web/<?=$pageweb?>/fotos',
		'fileExt'   : '*.jpg;',
		'fileDesc'  : 'Archivos de Imagen',
		'sizeLimit' : 10485760,//10mb,		
		'multi'   : true,
		'onComplete': function(event, queueID, fileObj, response, data) {
 		    $('#fotosWrapper').append(response);
		}
	});
	$('#enviar').click(function () {
		$('#fileInput').uploadifySettings('scriptData',{'item': $("#IDpro").val(),'pagina':$("#selectpage").val()});
		$('#fileInput').uploadifyUpload();
	}); 	
});


// ]]>
</script>



<form name="frm_galeria_new" method="post"  action="galeriafotos_new.php" enctype="multipart/form-data">
<input type="hidden" name="selectpage" id="selectpage" value="<?=$pageweb?>" />
<input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">

<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborderfull" >
<tr>
   	<td class='titulo'  colspan="2">
        <div class="formtitulo">Subir Fotos</div>
        <div class="formcerrar"><a href="<?=$retorno?>?IDpro=<?=$_GET['IDpro']?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr >
	<td class='colgrishome'  valign="top" align="right">Item</td>
    <td class='colgrisend' >&nbsp;
    </td>
</tr>
  	   
<tr>
	<td class='colgrishome'   valign="top" align="right">Archivos</td>
    <td class='colgrisend' valign="top">
	<input type="file" name="fileInput" id="fileInput" />
	<div id="fotosWrapper"></div>
      </td>
	</tr>
	<td  colspan="2" class='formpie' align="center" >
   	<input type="button" name="enviar" id="enviar"  value="enviar"/>
	<input type="Button" value="Cerrar" onclick="javascript:window.location = '<?=$retorno?>?IDpro=<?=$_GET['IDpro']?>'" >	
	</td>
	</tr>
</table>
</form>
