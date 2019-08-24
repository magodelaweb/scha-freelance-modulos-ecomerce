<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
?>
<form name="form" method="post" action="personas.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td class='titulo' >
        <div class="formtitulo">Clientes</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
		</td>
	</tr>
	<tr>
    	<td class='titlehome'  align="right">
			<input type="button" name="new" value="Nuevo Cliente"  onclick="javascript:window.location = 'personasnew.php'"> 
        </td>
	</tr>
	<tr>
    	<td  align="center">
        <div id="listado">
        <?php  include "personas_listado.php";?>
        </div>
		</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("personas_listado.php",{ idbuscar:'1',idpagina:'1',iditems:$("#nroitems").val(),page:$('#selectpage').val(),idfecha:$("#fecha").val(),nombre:$("#nombre").val(),correo:$("#correo").val(),documento:$("#documento").val(),nick:$("#nick").val(),pais:$("#pais").val()},function(data){$("#listado").html(data);})
	});
	$("#selectpage").change(function(){
		$.post("personas_listado.php",{ idbuscar:'1',idpagina:'1',iditems:$("#nroitems").val(),page:$('#selectpage').val(),idfecha:$("#fecha").val(),nombre:$("#nombre").val(),correo:$("#correo").val(),documento:$("#documento").val(),nick:$("#nick").val(),pais:$("#pais").val()},function(data){$("#listado").html(data);})
	});
});

function elimina(id)
{
	var confirma = confirm('Desea eliminar este cliente?');
	
	if(confirma){
		$.post("personas_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),iditems:$("#nroitems").val(),page:$('#selectpage').val(),idfecha:$("#fecha").val(),nombre:$("#nombre").val(),correo:$("#correo").val(),documento:$("#documento").val(),nick:$("#nick").val(),pais:$("#pais").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}
function estado(id)
{
	$.post("personas_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),iditems:$("#nroitems").val(),page:$('#selectpage').val(),idfecha:$("#fecha").val(),nombre:$("#nombre").val(),correo:$("#correo").val(),documento:$("#documento").val(),nick:$("#nick").val(),pais:$("#pais").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>
