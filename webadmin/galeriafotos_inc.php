<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
?>
<form name="form" method="post" action="contenido.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<input type="hidden" name="modulo" id="modulo" value="<?=$modulo?>" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td  class='titulo' >
        <div class="formtitulo">Fotos</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
	<tr>
    	<td  class='titlehome'  align="right">
			<input type="button" name="new" value="Subir Fotos"  onclick="javascript:window.location = 'galeriafotosnew.php'"> 
        
        </td>
	</tr>
    
	<tr>
    	<td align="center">
        <div id="listado">
        <?php  include "galeriafotos_listado.php";?>
        </div>
		</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#buscar").click(function(){
		$.post("galeriafotos_listado.php",{ idbuscar:'1',idpagina:'1',modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(), idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
	$("#selectseccion").change(function(){
		$.post("galeriafotos_listado.php",{ idbuscar:'1',idpagina:'1',modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(), codigo:$("#codigo").val(), idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
	$("#selectpage").change(function(){
		$.post("panel_buscador_inc.php",{ idbuscar:'1', modulo:$("#modulo").val(), page:$('#selectpage').val() },function(data){$("#selectseccion").html(data);})
		$.post("galeriafotos_listado.php",{ idbuscar:'1',idpagina:'1',modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(), codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:'SS', iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});

});

function elimina(id)
{
	var confirma = confirm('Desea eliminar esta foto?');
	if(confirma){
	$.post("galeriafotos_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);})
	}
}

function categorizar(id)
{
	$.post("galeriafotos_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),modulo:$("#modulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),idcat: id },function(data){$("#listado").html(data);})
}

</script>