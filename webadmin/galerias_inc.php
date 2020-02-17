<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/
$sqlitem = db_query("SELECT ccodcontenido,cnomcontenido FROM contenido  WHERE ccodcontenido ='" .$_GET['IDpro'] . "'");
$rowitem = db_fetch_array($sqlitem);

?>
<form name="form" method="post" action="contenido.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<input type="hidden" name="idcodigo" id="idcodigo" value="<?=$_GET['IDpro']?>" />

<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td  class='titulo' >
        <div class="formtitulo">Galerias</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
	<tr>
    	<td  class='titlehome' >
		 ITEM : <?=$rowitem['cnomcontenido'];?>
        </td>
	</tr>
    
	<tr>
    	<td align="center">
        <div id="listado">
        <?php  include "galerias_listado.php";?>
        </div>
		</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#selectmodulo").change(function(){
		$.post("galerias_listado.php",{ idbuscar:'1',idpagina:'1',modulo:$("#selectmodulo").val(),idpro:$('#idcodigo').val(), iditems:$("#nroitems").val() },function(data){$("#listado").html(data);})
	});
						   
});

function elimina(id)
{
	var confirma = confirm('Desea eliminar este item?');
	
	if(confirma){
		$.post("galerias_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),idpro:$('#idcodigo').val(),modulo:$("#selectmodulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),iddel: id },function(data){$("#listado").html(data);});
		location.reload();
	}
}
function estado(id)
{
	$.post("galeria_listado.php",{ idbuscar:'1', idpagina:$("#pg").val(),modulo:$("#selectmodulo").val(),page:$('#selectpage').val(),idpalabra:$("#palabra").val(),codigo:$("#codigo").val(),idfecha:$("#fecha").val(),idseccion:$("#selectseccion").val(),iditems:$("#nroitems").val(),idest: id },function(data){$("#listado").html(data);})
}

</script>