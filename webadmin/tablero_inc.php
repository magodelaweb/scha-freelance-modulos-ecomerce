<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/

?>
<form name="form" method="post" action="home.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td  class='titulo' >
        <div class="formtitulo">Tablero de contenidos</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
    <tr>        
		<td class='colblancohome'  align="right">
            <input type="button" name="new" value="Nuevo"       onclick="javascript:window.location = 'tablero_new.php'">
		</td>
	</tr>        
	<tr>
	<td  align="center">
        <div id="listado">
        <?php  include "tablero_listado.php";?>
        </div>
	</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("tablero_listado.php",{ idbuscar:'1',idpagina:'1',idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idweb:$("#selectpage").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
	$("#selectpage").change(function(){
		$.post("tablero_listado.php",{ idbuscar:'1',idpagina:'1',idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idweb:$("#selectpage").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
});

function elimina(id)
{
	var confirma = confirm('Desea eliminar este articulo?');
	
	if(confirma){
		$.post("tablero_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(), idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idweb:$("#selectpage").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}
function estado(id)
{
	$.post("tablero_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(), idpalabra:$("#palabra").val(), idfecha:$("#fecha").val(),idweb:$("#selectpage").val(),iditems:$("#nroitems").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>
