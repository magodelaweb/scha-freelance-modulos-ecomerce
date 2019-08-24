<?php  	
$sql_api=db_query("SELECT cmapgoogle FROM page where ccodpage='".$_SESSION['page']."' ");
while($rowapi=db_fetch_array($sql_api))
{  
?>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=$rowapi['cmapgoogle']?>"   type="text/javascript"></script>
<?php 
}
?>

<script type="text/javascript">
    //<![CDATA[

	// Inicialización de variables.
    var map      = null;
    var geocoder = null;

    function load() {                                      // Abre LLAVE 1.
      if (GBrowserIsCompatible()) {						   // Abre LLAVE 2.
        map = new GMap2(document.getElementById("map"));

        map.setCenter(new GLatLng(-12.046413631796211,-77.03072547912598), 15);
        map.addControl(new GSmallMapControl());
	   	map.addControl(new GMapTypeControl());

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

<?php 
include "include/config_seguro.php";
if($_POST['Aceptar'])
{	
		if($_POST['pais'])					$ccodubigeo=$_POST['pais'];	
		if($_POST['dpto']!='00000000')		$ccodubigeo=$_POST['dpto'];	
		if($_POST['city']!='00000000')		$ccodubigeo=$_POST['city'];

		$save_contenido= "INSERT INTO pagesucursal
					(
					ccodpage,cnomsucursal,ccodubigeo,
					cdiroficina,clatsucursal,clonsucursal,ctelsucursal,cfaxsucursal,cmovsucursal,cnexsucursal,
					cemasucursal,curlsucursal,cestsucursal,dfecsucursal,dfecmodifica,ccodusuario 
					)
						values(
							'" . $_POST['selectpage'] ."',
							'" . $_POST['titulo'] . "', 
							'" . $ccodubigeo . "', 
							'" . $_POST['direccion'] . "', 
							'" . $_POST['ylati'] . "', 
							'" . $_POST['xlong'] . "', 
							'" . $_POST['tfijo'] . "', 
							'" . $_POST['tfax'] . "', 
							'" . $_POST['tmovil'] . "', 
							'" . $_POST['nextel'] . "', 
							'" . $_POST['email'] . "', 
							'" . $_POST['web'] . "', 
							'1', 						
							now(),
							now(),
							'" .$_SESSION['webuser_id']. "'
							)";		
		db_query($save_contenido);
	tep_redirect('sucursal.php');
}
/* ///////////////////////////////////////// */
?>
<body onLoad="load();"  onunload="GUnload();">
<form  name="form_mapa" method="post" action="sucursal_new.php">
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborder" >
<tr>
	<td colspan='2' class='titulo' >
		<div class="formtitulo">Nueva Sucursal</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
    
    </td>
</tr>
<tr>
	<td class='titlesub'  colspan="2">Datos de Basicos</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right' width="180">Pagina</td>
	<td class='colblancoend'>
  <select name="selectpage" id="selectpage" style="width:250px">
  <?php 
	if ($_SESSION['webuser_nivel'] == '9')
	  	$sql_page = db_query("select * from page  where  cestpage='1' and credpage='' order by cnompage");
	else
	  	$sql_page = db_query("select * from page p, personapage pp  where p.ccodpage=pp.ccodpage and pp.ccodpersona='".$_SESSION['webuser_id']."' and p.cestpage='1' and p.credpage='' order by p.cnompage");
  
	 while($row_page = db_fetch_array($sql_page)) 
	 {
		 if( $row_page['ccodpage']==$_SESSION['page'])
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
	<td class='colblancoend'><input type="text" name="titulo"  size="85" maxlength="150" ></td>
</tr>
<tr>
	<td class='titlesub'  colspan="2">
	Contactos
    </td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right' >Telefono Fijo </td>
	<td class='colblancoend'><input type="text" name="tfijo"  size="30" maxlength="15" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Fax </td>
	<td class='colblancoend'><input type="text" name="tfax"  size="30" maxlength="15" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Movil </td>
	<td class='colblancoend'><input type="text" name="tmovil"  size="30" maxlength="15" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Nextel </td>
	<td class='colblancoend'><input type="text" name="nextel"  size="30" maxlength="15" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Email </td>
	<td class='colblancoend'><input type="text" name="email"  size="85" maxlength="150" ></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Pagina Web</td>
	<td class='colblancoend'><input type="text" name="web"  size="85" maxlength="150" ></td>
</tr>


<tr>
	<td class='titlesub'  colspan="2">
	Google Maps : Ubique Direccion
    </td>
</tr>
<tr>
      <td align='right' class='colgrishome' height='25'>Pais </td>
      <td class='colblancoend'>
<select name='pais' id="pais"  style="width:320px">
<?php   
	$pais    = substr($_SESSION['pais'],0,2);
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
	<option value='00000000' selected="selected">Seleccione</option>
	<?php 
	$dpto = substr($_SESSION['pais'],0,4);
	$sqldpto = db_query("SELECT * FROM webubigeo WHERE ccodubigeo like '".$pais."%' and cnivubigeo='2' ORDER BY cnomubigeo");
	while($rowdpto = db_fetch_array($sqldpto))
	{
		echo "<option value=".$rowdpto['ccodubigeo']." >".$rowdpto['cnomubigeo']."</option>";
	} 
	?>
	</select>
			
	  </td>
	</tr>
    <tr>
      <td align='right' class='colgrishome' height='25'>Ciudad / Distrito</td>
      <td class='colblancoend'>
	<select name='city' id="city"  style="width:320px"">
    <option value='00000000'>Seleccione</option>
	</select>

	  </td>
</tr>

<tr>
	<td class='colgrishome'  height='30' align='right' width="180">Direccion </td>
	<td class='colblancoend'><input type="text" name="direccion"  size="85" maxlength="150" ></td>
</tr>

<tr>
	<td class='colgrishome'  colspan="2" align="center">
	<div id="map" style="width: 740px; height: 400px"></div>
    </td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Latitud </td>
	<td class='colblancoend'><input type="text"  name="ylati" value=""  /></td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Longitud</td>
	<td class='colblancoend'><input type="text" name="xlong" value=""  /></td>
</tr>

<tr>
	<td colspan="2" align="center" class='formpie' >
	<input name="Aceptar" type="submit" value="Aceptar" class="cssboton"/>
	<input type="Button" value="Cancelar" onClick="javascript:window.location = '<?=$retorno?>'" class='cssboton'>
	</td>
</tr>
</table>
</form>
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
