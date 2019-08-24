<?php 
/*****************************************/
include "include/config_seguro.php";
/*****************************************/

$sql   = db_query("SELECT * FROM persona   WHERE ccodpersona='".$_GET['IDpro']."'");
while($row = db_fetch_array($sql))
{
?>
<div id="capaformulario">
<form id="formpersona" >
<input type="hidden" name="codigo" value="<?=$_GET['IDpro']?>" >
<table border='0' align='center' cellpadding='0' cellspacing='0' class="tableborderfull" >
	<tr>
		<td colspan='2' align="left" class='titulo'>
		<div class="formtitulo">Clientes</div>
        <div class="formcerrar"><a href="<?=$retorno?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
        </td>
	</tr>
<tr>
	<td colspan='2' class='titlehome'>Datos basicos </td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Correo electronico</td>
	<td class='colblancoend'><input type="text" name="email" maxlength="100"  size="50"  readonly value="<?=$row['cemapersona']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Nombres y Apellidos </td>
	<td class='colblancoend'><input type="text" name="nombre" maxlength="100" size="50" value="<?=$row['cnompersona']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Sexo</td>
	<td class='colblancoend'>
	<select name="selectsexo" style="width:330px">
<?php  	$sql_sex       = "SELECT * FROM webparametros where ccodparametro='0006' and ctipparametro='1'";
	$querysex     = db_query($sql_sex);
	while($filasex = db_fetch_array($querysex))
	{	if($filasex['cvalparametro']==$row['csexpersona'])
			echo "<option value=".$filasex['cvalparametro']." selected>".$filasex['cdesparametro']."</option>";
		else
			echo "<option value=".$filasex['cvalparametro'].">".$filasex['cdesparametro']."</option>";
	}
?>
	</select></td>
</tr>

<tr>
	<td class='colgrishome' align='right'>Documento Identidad</td>
	<td class='colblancoend'><input type="text" name="numerodoc" maxlength="20"  size="20" value="<?=$row['cdnipersona']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Fecha Nacimiento</td>
	<td class='colblancoend'>
	<input type="text" name="fechanac" id="fechanac" maxlength="10" size="15" value="<?=fechadmy($row['dnacpersona'])?>"/>
	<input type="button" id="fechabus" value="..." class="cssboton">
			<script type="text/javascript"> 
			   Calendar.setup({ 
			    inputField	:    "fechanac",     // id del campo de texto 
			    ifFormat	:     "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
		  	    button	    :    "fechabus"     // el id del botón que lanzará el calendario 
				}); 
			</script> 		
	</td>
</tr>


<tr>
	<td colspan='2' class='titlehome'>Datos de Contactos</td>
</tr>


<tr>
	<td class='colgrishome'  height='30' align='right'>Pais</td>
    <td class='colblancoend'>
	<select name='pais' id="pais"  style="width:320px">
	<?php 
	$pais = substr($row['ccodubigeo'],0,2);
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
	<td class='colgrishome'  height='30' align='right'>Region</td>
    <td class='colblancoend'>
	<select name='dpto' id="dpto"  style="width:320px">
    <option value='00000000'>Seleccione</option>
	<?php 
	$dpto = substr($row['ccodubigeo'],0,4);
	$sqldpto = db_query("SELECT * FROM webubigeo WHERE ccodubigeo like '".$pais."%' and cnivubigeo='2' ORDER BY cnomubigeo");
	while($rowdpto = db_fetch_array($sqldpto))
	{
			if (substr($rowdpto['ccodubigeo'],0,4) == $dpto) 
				echo "<option value=".$rowdpto['ccodubigeo']." selected>".$rowdpto['cnomubigeo']."</option>";
			else
				echo "<option value=".$rowdpto['ccodubigeo']." >".$rowdpto['cnomubigeo']."</option>";
	} 
	?>
	</select>

	</td>
</tr>
<tr>
	<td class='colgrishome'  height='30' align='right'>Ciudad</td>
    <td class='colblancoend'>
	<select name='city' id="city"  style="width:320px"">
    <option value='00000000'>Seleccione</option>
	<?php 
	$city = $row['ccodubigeo'];
	$sqlcity = db_query("SELECT * FROM webubigeo WHERE  ccodubigeo like '".$dpto."%' and cnivubigeo='3' ORDER BY cnomubigeo");
	while($rowcity = db_fetch_array($sqlcity))
	{
			if ($rowcity['ccodubigeo'] == $city) 
				echo "<option value=".$rowcity['ccodubigeo']." selected>".$rowcity['cnomubigeo']."</option>";
			else
				echo "<option value=".$rowcity['ccodubigeo']." >".$rowcity['cnomubigeo']."</option>";
	} 
	?>
	</select>

	</td>
</tr>

<tr>
	<td class='colgrishome' align='right'>Ciudad /Zona</td>
	<td class='colblancoend'><input type="text" name="lugar" maxlength="20"  size="50" value="<?=$row['cciudad']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Direccion</td>
	<td class='colblancoend'><input type="text" name="direccion" maxlength="80"  size="50" value="<?=$row['cdireccion']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Codigo Postal</td>
	<td class='colblancoend'><input type="text" name="postal" maxlength="20"  size="20" value="<?=$row['ccodpostal']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Telefono</td>
	<td class='colblancoend'><input type="text" name="telefono" maxlength="20"  size="20" value="<?=$row['ntelefono']?>"/></td>
</tr>
<tr>
	<td class='colgrishome' align='right'>Movil</td>
	<td class='colblancoend'><input type="text" name="movil" maxlength="20"  size="20" value="<?=$row['nmovil']?>"/></td>
</tr>

<tr><td class='colgrishome'  colspan="2"><div id="mensaje"></div></td></tr>  	   
<tr>
	<td colspan="2" align="center" class='formpie' >
	<input type="button" value="Grabar"   class='cssboton' onclick="xajax_procesar_formulario(xajax.getFormValues('formpersona'))" />
	<input type="Button" value="Cancelar" onClick ="javascript:window.location = 'personas.php'" class='cssboton'>
	</td>
</tr>
</table>
</form>
</div>
<?php  } ?>
<script>
$(document).ready(function(){

	$("#pais").change(function(){
		$.post("jquery_ubigeo.php",{ pais:$('#pais').val() },function(data){$("#dpto").html(data);$("#city").html("");$("<option value='00000000'>Seleccione</option>").appendTo("#city");})
		
	});
	$("#dpto").change(function(){
		$.post("jquery_ubigeo.php",{ dpto:$('#dpto').val() },function(data){$("#city").html(data);})
	});
})
</script>
