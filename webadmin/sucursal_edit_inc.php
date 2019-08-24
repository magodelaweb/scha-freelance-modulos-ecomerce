<?php  	
$sql_api=db_query("SELECT cmapgoogle FROM page where ccodpage='00000001' ");
while($rowapi=db_fetch_array($sql_api))
{  
?>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=$rowapi['cmapgoogle']?>"   type="text/javascript"></script>
<?php 
}

if($_POST['Aceptar'])
{	
	if($_POST['pais'])					$ccodubigeo=$_POST['pais'];	
	if($_POST['dpto']!='00000000')		$ccodubigeo=$_POST['dpto'];	
	if($_POST['city']!='00000000')		$ccodubigeo=$_POST['city'];

	$save_contenido= "UPDATE pagesucursal SET
							ccodpage     = '" . $_POST['selectpage'] . "',
							cnomsucursal = '" . $_POST['titulo'] . "', 
							ccodubigeo   = '" . $ccodubigeo . "', 
							cdiroficina  = '" . $_POST['direccion'] . "', 
							clatsucursal = '" . $_POST['ylati'] . "', 
							clonsucursal = '" . $_POST['xlong'] . "', 
							ctelsucursal = '" . $_POST['tfijo'] . "', 
							cfaxsucursal = '" . $_POST['tfax'] . "', 
							cmovsucursal = '" . $_POST['tmovil'] . "', 
							cnexsucursal = '" . $_POST['nextel'] . "', 
							cemasucursal = '" . $_POST['email'] . "', 
							curlsucursal = '" . $_POST['web'] . "', 
							dfecmodifica = now()
							where ccodsucursal ='".$_POST['cod']."'	";		
		db_query($save_contenido);
	tep_redirect('sucursal.php');
}

$sqlp    = db_query("SELECT * FROM pagesucursal WHERE ccodsucursal = '". $_GET['IDpro'] ."'");
while ($rowp = db_fetch_array($sqlp))
{
?>

<script type="text/javascript">
    //<![CDATA[

	// Inicialización de variables.
    var map      = null;
    var geocoder = null;

    function load() {                                      // Abre LLAVE 1.
      if (GBrowserIsCompatible()) {						   // Abre LLAVE 2.
        map = new GMap2(document.getElementById("map"));

        map.setCenter(new GLatLng(<?=$rowp['clatsucursal']?>,<?=$rowp['clonsucursal']?>), 15);
        map.addControl(new GSmallMapControl());
	   	map.addControl(new GMapTypeControl());
		var point1  = new GLatLng(<?=$rowp['clatsucursal']?>,<?=$rowp['clonsucursal']?>);
		map.addOverlay(createMarker(point1, 1,"aqui estoy"));

        geocoder = new GClientGeocoder();

		GEvent.addListener(map, "click",
			function(marker, point) {
 		 		if (marker) {
               		null;
              		} else {
          			map.clearOverlays();
					var marcador = new GMarker(point);
					map.addOverlay(marcador);
					//marcador.openInfoWindowHtml("<b>Coordenadas:</b> "+point.y+","+point.x);
       			      document.form_mapa.ylati.value = point.y;
       			      document.form_mapa.xlong.value = point.x;
					}
  			}
			);
      } // Cierra LLAVE 1.
    }   // Cierra LLAVE 2.

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

	function centrarip(ip1,ip2,xzoom) {
		map.setCenter(new GLatLng(ip1,ip2), xzoom);
	}

    function showAddress(address, zoom) {
    	if (geocoder) {
        	geocoder.getLatLng(address,
          		function(point) {
            		if (!point) {
            			alert(address + " Direccion no existe");
            		} else {
            			map.setCenter(point, zoom);
            			var marker = new GMarker(point);
            			map.addOverlay(marker);
       			      document.form_mapa.ylati.value = point.y;
       			      document.form_mapa.xlong.value = point.x;

               		}
               	}
        	);
      	}}

    //]]>
     </script>

<body onLoad="load();"  onunload="GUnload();">
<form  name="form_mapa" method="post" action="sucursal_edit.php">
<input type="hidden" name="cod" id="cod" value="<?=$_GET['IDpro']?>">
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder" >
<tr>
	<td colspan='2' class='titulo' >
		<div class="formtitulo">Editar Sucursal</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr>
	<td class='titlesub'  colspan="2">Datos de Basicos</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right' width="180">Pagina</td>
	<td class='colblancoend'>
  <select name="selectpage" id="selectpage" style="width:320px">
  <?php   $sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnompage");
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		if( $row_page['ccodpage']==$rowp['ccodpage'])
			echo '<option value="' . $row_page['ccodpage'] .'" selected>' . $row_page['cnompage'] . '</option>';
		 else
			echo '<option value="' . $row_page['ccodpage'] .'">' . $row_page['cnompage'] . '</option>';
	 }
  ?>
  </select>

	</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right' width="180">Nombre </td>
	<td class='colblancoend'><input type="text" name="titulo"  size="85" maxlength="150" value="<?=$rowp['cnomsucursal']?>"></td>
</tr>

<tr>
	<td class='titlesub'  colspan="2">
	Contactos de la Sucursal
    </td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Email </td>
	<td class='colblancoend'><input type="text" name="email"  size="85" maxlength="150" value="<?=$rowp['cemasucursal']?>"></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Pagina Web</td>
	<td class='colblancoend'><input type="text" name="web"  size="85" maxlength="150" value="<?=$rowp['curlsucursal']?>"></td>
</tr>

<tr>
	<td class='colgrishome'  height='30' align='right' >Telefono Fijo </td>
	<td class='colblancoend'><input type="text" name="tfijo"  size="30" maxlength="30" value="<?=$rowp['ctelsucursal']?>" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Nro Fax </td>
	<td class='colblancoend'><input type="text" name="tfax"  size="30" maxlength="30" value="<?=$rowp['cfaxsucursal']?>"></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Telefono Movil </td>
	<td class='colblancoend'><input type="text" name="tmovil"  size="30" maxlength="30" value="<?=$rowp['cmovsucursal']?>"></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Nextel</td>
	<td class='colblancoend'><input type="text" name="nextel"  size="30" maxlength="30" value="<?=$rowp['cnexsucursal']?>"></td>
</tr>


<tr>
	<td class='titlesub'  colspan="2">
	Google Maps : Ubique coordenadas
    </td>
</tr>
<tr>
      <td align='right' class='colgrishome' height='25'>Pais </td>
      <td class='colblancoend'>
<select name='pais' id="pais"  style="width:320px">
<?php   
	$pais    = substr($rowp['ccodubigeo'],0,2);
	$sqlpais = db_query("SELECT * FROM webubigeo WHERE  cnivubigeo='1' ORDER BY cnomubigeo");
	while($rowpais = db_fetch_array($sqlpais))
	{
			if (substr($rowpais['ccodubigeo'],0,2) == $pais) 
				echo "<option value=".$rowpais['ccodubigeo']." selected>".$rowpais['cnomubigeo']."</option>";
			else
				echo "<option value=".$rowpais['ccodubigeo']." >".$rowpais['cnomubigeo']."</option>";
	} 
?>
</select>
			
	  </td>
	</tr>
    <tr>
      <td align='right' class='colgrishome' height='25'>Region / Estado</td>
      <td class='colblancoend'>

	<select name='dpto' id="dpto" style='width:320px;'>
	<option value='00000000'>Seleccione</option>
	<?php 
	$dpto = substr($rowp['ccodubigeo'],0,4);
	$sqldpto = db_query("SELECT * FROM webubigeo WHERE ccodubigeo like '".$pais."%' and cnivubigeo='2' ORDER BY cnomubigeo");
	while($rowdpto = db_fetch_array($sqldpto))
	{
		if (substr($rowdpto['ccodubigeo'],0,4) == $dpto) 
			echo "<option value='".$rowdpto['ccodubigeo']."' selected>".$rowdpto['cnomubigeo']."</option>";
		else
			echo "<option value='".$rowdpto['ccodubigeo']."' >".$rowdpto['cnomubigeo']."</option>";
	} 
	?>
	</select>
			
	  </td>
	</tr>
    <tr>
      <td align='right' class='colgrishome' height='25'>Ciudad / Distrito</td>
      <td class='colblancoend'>
	<select name='city' id="city"  style="width:320px"" >
    <option value='00000000' >Seleccione</option>
	<?php 
	$city = $rowp['ccodubigeo'];
	$sqlcity = db_query("SELECT * FROM webubigeo WHERE ccodubigeo like '".$dpto."%' and cnivubigeo='3' ORDER BY cnomubigeo");
	while($rowcity = db_fetch_array($sqlcity))
	{
		if ($rowcity['ccodubigeo'] == $city) 
			echo "<option value='".$rowcity['ccodubigeo']."' selected>".$rowcity['cnomubigeo']."</option>";
		else
			echo "<option value='".$rowcity['ccodubigeo']."' >".$rowcity['cnomubigeo']."</option>";
	} 
	?>
	</select>

	  </td>
</tr>

<tr>
	<td class='colgrishome'  height='30' align='right' width="180">Direccion </td>
	<td class='colblancoend'><input type="text" name="direccion"  size="85" maxlength="150" value="<?=$rowp['cdiroficina']?>"></td>
</tr>

<tr>
	<td class='colblancohome'  colspan="2" align="center">
	<div id="map" style="width: 740px; height: 400px"></div>
    </td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Latitud </td>
	<td class='colblancoend'><input type="text"  name="ylati" value="<?=$rowp['clatsucursal']?>"  /></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Longitud</td>
	<td class='colblancoend'><input type="text" name="xlong" value="<?=$rowp['clonsucursal']?>"  /></td>
</tr>
<tr>
	<td colspan="2" align="center" class='formpie' >
	<input name="Aceptar" type="submit" value="Aceptar" class="cssboton"/>
	<input type="Button" value="Cancelar" onClick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>
	</td>
</tr>
</table>
</form>
<?php  } ?>
<script>
$(document).ready(function(){

	$("#pais").change(function(){
		 var npais = $('#pais').val();
		 var vpais = $("#pais option[value="+npais+"]").text();
		
		$.post("jquery_ubigeo.php",{ pais:$('#pais').val() },function(data){$("#dpto").html(data);$("#city").html("");$("<option value='00000000'>Seleccione</option>").appendTo("#city");})
		showAddress(vpais,6);
	});
	$("#dpto").change(function(){
		 var npais = $('#pais').val();
		 var vpais = $("#pais option[value="+npais+"]").text();
							   
		 var ndepa = $('#dpto').val();
		 var vdepa = $("#dpto option[value="+ndepa+"]").text();
		 if (ndepa =='PE150000') vdepa='LIMA';
		 if (ndepa =='PE160000') vdepa='LIMA';
		 midepa = 	vpais+", "+	vdepa;			   
		$.post("jquery_ubigeo.php",{ dpto:$('#dpto').val() },function(data){$("#city").html(data);})
		showAddress(midepa,8);
	});
	$("#city").change(function(){
		 var npais = $('#pais').val();
		 var vpais = $("#pais option[value="+npais+"]").text();
							   
		 var ndepa = $('#dpto').val();
		 var vdepa = $("#dpto option[value="+ndepa+"]").text();
		 if (ndepa =='PE150000') vdepa='LIMA';
		 if (ndepa =='PE160000') vdepa='LIMA';

		 var ncasa = $('#city').val();
		 var vcasa = $("#city option[value="+ncasa+"]").text();

		 micasa = 	vpais+", "+	vdepa+", "+ vcasa;			   
		 showAddress(micasa,14);
	});
})
</script>
