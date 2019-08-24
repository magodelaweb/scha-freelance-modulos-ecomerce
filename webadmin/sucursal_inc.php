<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
?>
<form name="form" method="post" action="sucursal.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td colspan='4' class='titulo' >
        <div class="formtitulo">Sucursales</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
	<tr>
    	<td colspan='4' class='titlehome'  align="right">
			<input type="button" name="new" value="Nuevo Sucursal"  onclick="javascript:window.location = 'sucursal_new.php'"> 
        </td>
	</tr>
	<tr>
    	<td colspan='4'   align="center">
        <div id="listado">
        <?php  include "sucursal_listado.php";?>
        </div>
		</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("sucursal_listado.php",{ idbuscar:'1',idpagina:'1',idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idpage:$("#selectpage").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
	$("#selectpage").change(function(){
		$.post("sucursal_listado.php",{ idbuscar:'1',idpagina:'1',idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idpage:$("#selectpage").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
});

function elimina(id)
{
	var confirma = confirm('Desea eliminar esta sucursal?');
	
	if(confirma){
		$.post("sucursal_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idpage:$("#selectpage").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}
function estado(id)
{
	$.post("sucursal_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idpalabra:$("#palabra").val(),idfecha:$("#fecha").val(),idpage:$("#selectpage").val(),iditems:$("#nroitems").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>
