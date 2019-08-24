<?php  include "modulos/seccion_ruta.php"; ?>
<style type="text/css">	
	div#flashgaleria {
		margin:24px auto;
	}
</style>
<script type="text/javascript">
function flashPutHref(href) { location.href = href; }
var flashvars = {
	paramXMLPath: "/webfiles/xml/<?=$codsecc?>.xml",
	initialURL: escape(document.location)
}
var params = { 
	base: ".",
	quality: "best",
	bgcolor: "#121212",
	allowfullscreen: "true"
}                
var attributes = {}
swfobject.embedSWF("/include/gallery/slideshowpro.swf", "flashgaleria", "<?=$columnacenancho-40?>", "400", "9.0.0", false, flashvars, params, attributes);
</script>
<div id="flashgaleria">
	requires the Flash Player plugin and a web browser with JavaScript enabled.
</div>
