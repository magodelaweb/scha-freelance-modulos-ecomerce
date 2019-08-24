<?php
/*****************************************/
include "include/config_seguro.php";
/*****************************************/

?>
<form name="form" method="post" action="seccion.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder" >
	<tr>
		<td class="titulo">
        <div class="formtitulo">Secciones</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        </td>
	</tr>
	<tr>
		<td class='titlehome'  align="right" >
			<input type="button" name="new" value="Nueva Seccion" onclick="javascript:window.location = 'seccionnew.php'"> 
		</td>
	</tr>        
	<tr>
    	<td align="center">
        <div id="listado">
        <?php  include "seccion_listado.php";?>
        </div>
		</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("seccion_listado.php",{ idbuscar:'1',idpagina:'1',idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
	$("#selectpage").change(function(){
		$.post("seccion_listado.php",{ idbuscar:'1',idpagina:'1',idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});

});

function elimina(id)
{
	var confirma = confirm('Desea eliminar esta seccion?');
	
	if(confirma){
		$.post("seccion_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}
function estado(id)
{
	$.post("seccion_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idweb:$("#selectpage").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),iditems:$("#nroitems").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>
