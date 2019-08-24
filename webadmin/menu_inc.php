<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/

?>
<form name="form" method="post" action="home.php">
<input type="hidden" name="nroitems" id="nroitems" value="<?=VAR_NROITEMS?>" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder" >
	<tr>
    	<td class='titulo' >
        <div class="formtitulo">Ordenacion de Menus</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        
        </td>
	</tr>
	<tr>
    	<td  class='titlehome'  align="right">
			<input type="button" name="new" value="Nuevo Menu"  onclick="javascript:window.location = 'menunew.php'"> 
        </td>
	</tr>
    
	<tr>
	<td   align="center">
        <div id="listado">
        <?php  include "menu_listado.php";?>
        </div>
	</td>
	</tr>            
</table>
</form>
<script>
$(document).ready(function(){
	$("#selectp").change(function(){
		$.post("menu_listado.php",{ idopera:'1',codigo:$('#selectp').val() },function(data){$("#listado").html(data);})
	});
						   
});
</script>
