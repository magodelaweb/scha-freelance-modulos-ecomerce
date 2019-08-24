<?php 
include "include/config_seguro.php";
$retorno ="galeriafotos.php";
?>
<link href="include/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="include/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src="include/uploadify/swfobject.js"></script>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
	$('#fileInput').uploadify({
		'uploader'  : 'include/uploadify/uploadify.swf',
		'script'    : 'galeriafotosup.php',
		'cancelImg' : 'include/uploadify/cancel.png',
		'auto'      : false,
		'folder'    : '../web/12172806/fotos',
		'fileExt'   : '*.jpg;',
		'fileDesc'  : 'Archivos de Imagen',
		'sizeLimit' : 10485760,//10mb,		
		'multi'   : true,
		'onComplete': function(event, queueID, fileObj, response, data) {
 		    $('#fotosWrapper').append(response);
		}
	});
	$('#enviar').click(function () {
		$('#fileInput').uploadifySettings('scriptData',{'seccion': $("#selectseccion").val(),'pagina':$("#selectpage").val()});
		$('#fileInput').uploadifyUpload();
	}); 	
});


// ]]>
</script>



<form name="frm_galeria_new" method="post"  action="galeriafotos_new.php" enctype="multipart/form-data">
<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborderfull" >
<tr>
   	<td class='titulo'  colspan="2">
        <div class="formtitulo">Subir Fotos</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr >
	<td class='colgrishome'  valign="top" align="right">Pagina</td>
    <td class='colgrisend' >
  <?php  
		$sql_page = db_query("select * from page  where ccodpage='".$_SESSION['page']."' and cestpage='1' and credpage='' order by cnompage");
	while($row_page = db_fetch_array($sql_page)) 
	 {
		echo '<input type="hidden" name="selectpage" id="selectpage" value="' . $row_page['ccodpage'] .'">' . $row_page['cnompage'];
	 }
  ?>
    </td>
</tr>
  	   
<tr>
	<td class='colgrishome'  valign="top" align="right">Album</td>
    <td class='colgrisend' >
<select name='selectseccion' id='selectseccion' style='width:190px;' class="box" >";
<?php 
$sqlsec1 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodpage= '".$_SESSION['page']."' and ccodmodulo='".$modulo."' and cnivseccion='1' and ctipseccion='1'  order by cnomseccion");
while($row1 = db_fetch_array($sqlsec1)) 
		{
			$cod1 = substr($row1['ccodseccion'],0,12);
			echo '<option value="' . $row1['ccodseccion'] . '">'.$row1['cnomseccion'] . '</option>';
			$sqlsec2 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod1."%' and ccodmodulo='".$modulo."' and cnivseccion='2'  and ctipseccion='1'  order by cnomseccion");
			while($row2 = db_fetch_array($sqlsec2)) 
			{
				$cod2 = substr($row2['ccodseccion'],0,16);
				echo '<option value="' . $row2['ccodseccion'] . '">&nbsp;- ' . $row2['cnomseccion'] . '</option>';
				$sqlsec3 = db_query("SELECT ccodseccion, cnomseccion, cnivseccion FROM seccion WHERE ccodseccion like '".$cod2."%' and ccodmodulo='".$modulo."' and cnivseccion='3'  and ctipseccion='1'  order by cnomseccion");
				while($row3 = db_fetch_array($sqlsec3)) 
				{
					$cod3 = substr($row3['ccodseccion'],0,20);
					echo '<option value="' . $row3['ccodseccion'] . '">&nbsp;&nbsp;&nbsp;- ' . $row3['cnomseccion'] . '</option>';
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
<tr>
	<td class='colgrishome'   valign="top" align="right">Archivos</td>
    <td class='colgrisend' valign="top">
	<input type="file" name="fileInput" id="fileInput" />
	<div id="fotosWrapper"></div>
      </td>
	</tr>
	<td  colspan="2" class='formpie' align="center" >
   	<input type="button" name="enviar" id="enviar"  value="enviar"/>
	<input type="Button" value="Cerrar" onclick="javascript:window.location = '<?=$retorno?>'" >	
	</td>
	</tr>
</table>
</form>
