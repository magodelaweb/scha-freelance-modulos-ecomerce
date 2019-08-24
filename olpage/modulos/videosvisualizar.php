<?php 
$sqlcontenido = db_query("SELECT * FROM  contenido  WHERE ccodcontenido='".$codcont ."'");
while ($row=db_fetch_array($sqlcontenido))
 { 
?>
	<h1><?=$row['cnomcontenido']?></h1>
    <h5>Huaraz: <?=traducefecha($row['dfeccontenido'],'S')?></h5>
	<div id="flvplayer" align="center"></div>
	<script type="text/javascript">
	$(document).ready(function(){
	var html = swf("gsplayer","/include/video/mpw_player.swf","560","349",{path:"/webfiles/videos/<?=$row['curlcontenido']?>",type:"flv",thumbnail:"<?=$row['cimgcontenido']?>",fullscreen:'true'},{allowfullscreen:"true"});
	$("#flvplayer").html(html);
	});
	</script>            
	<div id="articulo"><?=$row['cdetcontenido']?></div>
<?php  } ?>
