<br>
<form id="cale"  action="#" method="post">
<input type="button" id='ant' value='anterior'>
<input type="button" id='sig' value='siguiente'>
<input type="button" id='hoy' value='Hoy'>
</form>

<div id="ver">
<?php  include "eventos_calendario.php" ?>
</div>
<script>
$(document).ready(function(){
	$("#ant").click(function(){
		$.post("/modulos/eventos_calendario.php",{ idfecha:$("#inicio").val()},function(data){$("#ver").html(data);})
	});
	$("#sig").click(function(){
		$.post("/modulos/eventos_calendario.php",{ idfecha:$("#final").val()},function(data){$("#ver").html(data);})
	});
	$("#hoy").click(function(){
		$.post("/modulos/eventos_calendario.php",{ idfecha:'<?=date('d-m-Y')?>'},function(data){$("#ver").html(data);})
	});
	

});
</script>

