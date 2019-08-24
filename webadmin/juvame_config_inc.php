<?php
/*****************************************/
include "include/config_seguro.php";
/****************************************/
include "panel_html.php";
?>
<form name='myconfig' id="myconfig" method='post' action='juvame_config.php'>
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder">
	<tr>
    	<td class='titulo' >
        <div class="formtitulo">Editar Configuracion</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a>
        </div>
        </td>
	</tr>
    <tr>
    	<td>
        <div id="listado">        
		<?php include "juvame_config_edit.php"; ?>
        </div>
        <div id="mensajes"></div>
        </td>
	</tr>
</table> 
</form>
<script>
$(document).ready(function(){
	$("#selectpage").change(function(){
		$.post("juvame_config_edit.php",{ idopera:'1',page:$('#selectpage').val() },function(data){$("#listado").html(data);})
	});


});

</script>
