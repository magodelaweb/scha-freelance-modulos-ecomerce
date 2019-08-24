<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=$webgooglemaps?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var map;
    var geocoder;
    function initialize() {
		map = new GMap2(document.getElementById("mapgoogle"));
		map.addControl(new GLargeMapControl());
		map.addMapType(G_PHYSICAL_MAP);
		map.addControl(new GMapTypeControl());
		map.addControl(new GScaleControl());
		map.disableDoubleClickZoom();

	  
		<?php 
		$i=1;
		$sqlsucursal=db_query("SELECT * FROM pagesucursal WHERE ccodpage='".$codpage."' and  cestsucursal='1' ORDER BY ccodsucursal");
		while($rowsucursal=db_fetch_array($sqlsucursal))
		{
		 if ($i==1)
		 {
		?>
	      map.setCenter(new GLatLng(<?=$rowsucursal['clatsucursal']?>,<?=$rowsucursal['clonsucursal']?>), 16);
		<?php 
		}
		$mapsmensaje="<div class='mapscontenido'><b>".$rowsucursal['cnomsucursal']."</b><br>".$rowsucursal['cdiroficina']."<br>Telefono :".$rowsucursal['ctelsucursal']."<br>Movil :".$rowsucursal['cmovsucursal']."<br>Email:".$rowsucursal['cemasucursal']."<br>Web :".$rowsucursal['curlsucursal']."</div><br><br><br>";
		?>
			var point<?=$i?>  = new GLatLng(<?=$rowsucursal['clatsucursal']?>,<?=$rowsucursal['clonsucursal']?>);
			map.addOverlay(createMarker(point<?=$i?>, <?=$i?>,"<?=$mapsmensaje?>"));
			
			<?php  $i= $i+1; ?>
		<?php  } ?>
      geocoder = new GClientGeocoder();
    }
	function createMarker(point, number,texto) {
		var blueIcon = new GIcon(G_DEFAULT_ICON);
		blueIcon.image = "http://www.google.com/help/hc/images/maps_human.png";

		markerOptions = { icon:blueIcon };
          var marker = new GMarker(point,markerOptions);
          GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(texto);
          });
          return marker;
        }


	function centrarip(ip1,ip2) {
		map.setCenter(new GLatLng(ip1,ip2), 17);	
	}
	
    </script>

<body onLoad="initialize()">
	<br />
	<p><?=$webdesc?></p>
    <br />
	<div id="articulo">
    <ul>
    <?php 
		$sqlsucursal=db_query("SELECT * FROM pagesucursal WHERE ccodpage='".$codpage."' and cestsucursal='1' ORDER BY ccodsucursal");
		while($rowsucursal=db_fetch_array($sqlsucursal))
		{
	?>
		<li><?=$rowsucursal['cnomsucursal']." : "?><a href="javascript:void(0)" onClick="centrarip('<?=$rowsucursal['clatsucursal']?>','<?=$rowsucursal['clonsucursal']?>')"><?=$rowsucursal['cdiroficina']?></a></li>
	<?php  } ?>        
	</ul>            
   </div>
	<div id="mapgoogle" style="width: <?=columnacenancho-50?>px; height: 500px; border:#000000 solid 1px"></div>
	<br>

